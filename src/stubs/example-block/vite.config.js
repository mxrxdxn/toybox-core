import { defineConfig } from 'vite';
import fg from 'fast-glob';
import path from 'node:path';

const rootDir = process.cwd();

function makeInputKey(file) {
    // Rollup input names cannot use path separators, so normalize paths into stable keys.
    return file
        .replace(/\\/g, '/')
        .replace(/\.[^/.]+$/, '')
        .replace(/\//g, '-');
}

function getInputs() {
    const inputs = {};

    // Treat JS/CSS files as Vite entrypoints.
    const patterns = [
        'resources/scss/**/*.{scss,css}',
        'resources/js/**/*.{js,ts}'
    ];

    const files = fg.sync(patterns, {
        cwd: rootDir,
        onlyFiles: true,
        absolute: false
    });

    files.forEach((file) => {
        // Store absolute paths for Rollup while keeping readable manifest keys.
        inputs[makeInputKey(file)] = path.resolve(rootDir, file);
    });

    return inputs;
}

function getAssetOutputPath(assetInfo) {
    // Vite passes the source file path here; use it to mirror the source structure in public/build.
    const originalName = assetInfo.name ? assetInfo.name.replace(/\\/g, '/') : '';

    if (originalName.startsWith('resources/scss/')) {
        return 'css/[name]-[hash][extname]';
    }

    if (originalName.startsWith('resources/js/')) {
        return 'js/[name]-[hash][extname]';
    }

    return 'assets/[name]-[hash][extname]';
}

function getChunkOutputPath(chunkInfo) {
    // JS entries expose a facade module, which lets us route block/shortcode output beside its source.
    const facade = chunkInfo.facadeModuleId
        ? path.relative(rootDir, chunkInfo.facadeModuleId).replace(/\\/g, '/')
        : '';

    if (facade.startsWith('resources/js/')) {
        return 'js/[name]-[hash].js';
    }

    return 'js/[name]-[hash].js';
}

export default defineConfig(({ command }) => {
    const isDev = command === 'serve';

    return {
        // Production asset URLs are resolved by WordPress, so keep the built paths relative.
        base: isDev ? '/' : '',
        publicDir: false,
        resolve: {
            alias: {
                '@': path.resolve(rootDir, 'resources'),
                '@js': path.resolve(rootDir, 'resources/js'),
                '@scss': path.resolve(rootDir, 'resources/scss')
            }
        },
        server: {
            host: 'localhost',
            port: 5173,
            strictPort: true,
            cors: true,
            origin: 'https://localhost:5173',
            https: false,
            hmr: {
                host: 'localhost',
            },
            watch: {
                // Polling is more reliable in local/containerized WordPress environments.
                usePolling: true,
                interval: 100,
                ignored: [
                    '**/node_modules/**',
                    '**/.git/**',
                    '**/public/build/**'
                ]
            }
        },
        css: {
            devSourcemap: true
        },
        build: {
            outDir: 'public/build',
            emptyOutDir: true,
            manifest: true,
            sourcemap: true,
            rollupOptions: {
                input: getInputs(),
                output: {
                    // Keep emitted files grouped by their theme, block, or shortcode source folder.
                    entryFileNames: (chunkInfo) => getChunkOutputPath(chunkInfo),
                    chunkFileNames: 'js/chunks/[name]-[hash].js',
                    assetFileNames: (assetInfo) => getAssetOutputPath(assetInfo)
                }
            }
        }
    };
});

<?php

namespace Toybox\Core\Components;

class Assets
{
    /**
     * Checks whether the development server is running by making a request to a specific URL.
     *
     * This method verifies the availability of the Vite development server by sending an HTTP
     * GET request to the server's URL. If the server responds with a valid response code, it is
     * considered to be running.
     *
     * @return bool|null Returns true if the development server is running, false otherwise.
     */
    public static function devIsRunning(): ?bool
    {
        static $running = null;

        if ($running !== null) {
            return $running;
        }

        $viteURL = 'http://localhost:5173/@vite/client';

        $response = wp_remote_get($viteURL, [
            'timeout'   => 0.5,
            'sslverify' => false,
        ]);

        $running = ! is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200;

        return $running;
    }

    /**
     * Retrieves the Vite manifest file as an associative array.
     * This function caches the manifest to avoid redundant file reads
     * and parsing during subsequent calls.
     *
     * @return array|null The decoded contents of the manifest file as an associative array.
     *               Returns an empty array if the file does not exist or cannot be
     *               decoded into a valid array.
     */
    public static function manifest(): ?array
    {
        static $manifest = null;

        if ($manifest !== null) {
            return $manifest;
        }

        $manifestPath = get_stylesheet_directory() . '/public/build/.vite/manifest.json';

        if (! file_exists($manifestPath)) {
            $manifest = [];
            return $manifest;
        }

        $contents = file_get_contents($manifestPath);
        $decoded  = json_decode($contents, true);

        $manifest = is_array($decoded) ? $decoded : [];

        return $manifest;
    }

    /**
     * Generates a URL for the specified entry point by appending it to the Vite development server URL.
     *
     * @param string $entry The entry point path, typically a file path relative to the root.
     *
     * @return string The full URL for the entry point on the Vite development server.
     */
    public static function entry(string $entry): string
    {
        return 'http://localhost:5173/' . ltrim($entry, '/');
    }

    /**
     * Enqueues a script or style asset for use in WordPress.
     *
     * This method handles both development and production environments by determining
     * the appropriate file paths, prefixes, and asset registration logic. In development mode,
     * assets are directly loaded, whereas in production, a manifest file is used to fetch
     * the correct file references.
     *
     * @param string $entry          The name of the asset file (e.g., 'main.js', 'styles.scss').
     * @param string $handle_prefix  An optional string used as a prefix for the generated
     *                               WordPress handle. Defaults to 'theme'.
     *
     * @return void
     */
    public static function enqueue(string $entry, string $handle_prefix = 'theme'): void
    {
        $handle = $handle_prefix . '-' . sanitize_title(str_replace(['/', '.'], '-', $entry));

        if (static::devIsRunning()) {
            if (substr($entry, -5) === '.scss' || substr($entry, -4) === '.css') {
                wp_enqueue_style(
                    $handle,
                    static::entry($entry),
                    [],
                    null
                );
            } else {
                wp_enqueue_script(
                    $handle,
                    static::entry($entry),
                    [],
                    null,
                    true
                );
            }

            return;
        }

        $manifest = static::manifest();

        if (empty($manifest[$entry])) {
            return;
        }

        $asset    = $manifest[$entry];
        $base_uri = get_stylesheet_directory_uri() . '/public/build/';

        if (! empty($asset['css']) && is_array($asset['css'])) {
            foreach ($asset['css'] as $index => $css_file) {
                wp_enqueue_style(
                    "{$handle}-css-{$index}",
                    $base_uri . ltrim($css_file, '/'),
                    [],
                    null
                );
            }
        }

        if (! empty($asset['file']) && preg_match('/\.js$/', $asset['file'])) {
            wp_enqueue_script(
                $handle,
                $base_uri . ltrim($asset['file'], '/'),
                [],
                null,
                true
            );
        } elseif (! empty($asset['file']) && preg_match('/\.css$/', $asset['file'])) {
            wp_enqueue_style(
                $handle,
                $base_uri . ltrim($asset['file'], '/'),
                [],
                null
            );
        }
    }

    /**
     * Outputs a script tag for the Vite development client.
     *
     * This method ensures the Vite client script is only printed once during execution,
     * and only in development mode. It serves to load the Vite development server's
     * client script, which is responsible for hot module replacement (HMR).
     *
     * @return void
     */
    public static function printClient(): void
    {
        static $printed = false;

        if ($printed || ! static::devIsRunning()) {
            return;
        }

        $printed = true;

        echo '<script type="module" src="http://localhost:5173/@vite/client"></script>' . "\n";
    }

    /**
     * Retrieves the relative file path for a Vite asset based on its entry name in the manifest.
     *
     * This method looks up the specified entry in the Vite manifest and returns the relative
     * file path if found. Returns null if the entry does not exist in the manifest or if the
     * manifest file cannot be loaded.
     *
     * @param string $entry The name of the asset entry (e.g., 'main.js', 'styles.scss').
     *
     * @return string|null The relative file path of the asset, or null if not found.
     */
    public static function getPath(string $entry): ?string
    {
        $entry    = ltrim($entry, '/');
        $manifest = static::manifest();

        if (empty($manifest[$entry]) || empty($manifest[$entry]['file'])) {
            return null;
        }

        return URI::stylesheetDirectory() . "/public/build/{$manifest[$entry]['file']}";
    }
}

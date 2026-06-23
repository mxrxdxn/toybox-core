<?php

use Highlight\Highlighter;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Toybox\Core\Docs\HighlightedCodeRenderer;
use Toybox\Core\Theme;

$packageAutoloader = dirname(__DIR__, 2) . '/vendor/autoload.php';

if (
    (! class_exists(GithubFlavoredMarkdownConverter::class) || ! class_exists(Highlighter::class))
    && is_file($packageAutoloader)
) {
    require_once $packageAutoloader;
}

// Load all MD files from the `docs` directory.
$docsDir = TOYBOX_DIR . '/vendor/toybox/core/src/Docs/Components';
$mdFiles = [];

$converter = new GithubFlavoredMarkdownConverter([
    'html_input' => 'escape',
    'allow_unsafe_links' => false,
]);
$converter->getEnvironment()->addRenderer(
    FencedCode::class,
    new HighlightedCodeRenderer(new Highlighter()),
    10
);

$highlightStyles = HighlightUtilities\getStyleSheet('foundation');

if (is_dir($docsDir)) {
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($docsDir, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($files as $file) {
        if (! $file->isFile() || strtolower($file->getExtension()) !== 'md') {
            continue;
        }

        $relativePath       = substr($file->getPathname(), strlen($docsDir) + 1);
        $fileName           = substr($relativePath, 0, -3);
        $mdFiles[$fileName] = $converter->convert(file_get_contents($file->getPathname()))->getContent();
    }

    ksort($mdFiles, SORT_NATURAL | SORT_FLAG_CASE);
}

$initialDocument = reset($mdFiles);

?>
<div class="wrap">
    <h1><?= esc_html__('Toybox Developer', 'toybox') ?></h1>

    <div class="toybox-dev-container">
        <div class="docs-list">
            <div class="card">
                <h2>Components</h2>

                <ul>
                    <?php if (! empty($mdFiles)): ?>
                        <?php foreach (array_keys($mdFiles) as $index => $fileName): ?>
                            <li>
                                <a href="#" class="doc-link" data-doc="<?= esc_attr($fileName) ?>" <?= $index === 0 ? 'data-active="true"' : '' ?>>
                                    <?= esc_html(ucwords(str_replace(['-', '_'], ' ', $fileName))) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><?= esc_html__('No documentation files found', 'toybox') ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="docs-body">
            <div class="card">
                <div id="docs-content">
                    <?php if (! empty($mdFiles)): ?>
                        <?= $initialDocument ?>
                    <?php else: ?>
                        <?= esc_html__('No documentation available', 'toybox') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        <?= $highlightStyles ?>

        .install-info {
            margin-bottom: 1rem;
        }

        .toybox-dev-container {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 4fr);
            gap: 1rem;
        }

        .docs-list .card, .docs-body .card {
            width: 100%;
            max-width: unset;
            min-width: unset;
        }

        .docs-list .card ul {
            list-style: none;
            padding: 0;
        }

        .docs-list .card ul li {
            margin-bottom: 0.5rem;
        }

        .docs-list .card ul li a {
            text-decoration: none;
            color: #007bff;
        }

        .docs-list .card ul li a[data-active="true"] {
            font-weight: bold;
            color: #0056b3;
        }

        #docs-content {
            line-height: 1.6;
        }

        #docs-content h1, #docs-content h2, #docs-content h3, #docs-content h4, #docs-content h5, #docs-content h6 {
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }

        #docs-content pre {
            background: #f5f5f5;
            padding: 1rem;
            border-radius: 4px;
            overflow-x: auto;
        }

        #docs-content code {
            background: #f5f5f5;
            padding: 0.2rem 0.4rem;
            border-radius: 3px;
            font-family: monospace;
        }

        #docs-content pre code {
            background: none;
            padding: 0;
        }

        #docs-content ul, #docs-content ol {
            margin-left: 2em;
        }

        #docs-content blockquote {
            border-left: 4px solid #ddd;
            padding-left: 1rem;
            margin-left: 0;
            color: #666;
        }
    </style>

    <script>
        (function () {
            const docs        = <?= wp_json_encode($mdFiles) ?>;
            const docLinks    = document.querySelectorAll('.doc-link');
            const docsContent = document.getElementById('docs-content');

            docLinks.forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();

                    const docName = this.getAttribute('data-doc');

                    docLinks.forEach(function (l) {
                        l.removeAttribute('data-active');
                    });
                    this.setAttribute('data-active', 'true');

                    if (docs[docName]) {
                        docsContent.innerHTML = docs[docName];
                    }
                });
            });
        })();
    </script>

    <?php do_action('toybox_developer_page'); ?>
</div>

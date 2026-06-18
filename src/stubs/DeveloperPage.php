<?php

use Toybox\Core\Theme;

// Load all MD files from the `docs` directory.
$docsDir = TOYBOX_DIR . '/vendor/toybox/core/src/Docs/Components';
$mdFiles = [];

if (is_dir($docsDir)) {
    $files = glob($docsDir . '/*.md');

    foreach ($files as $file) {
        $fileName           = basename($file, '.md');
        $mdFiles[$fileName] = file_get_contents($file);
    }
}

?>
<div class="wrap">
    <h1><?= esc_html__('Toybox Developer', 'toybox') ?></h1>

    <div class="card install-info">
        <h2><?= esc_html__('Core', 'toybox') ?></h2>

        <table class="widefat striped">
            <tbody>
                <tr>
                    <th scope="row"><?= esc_html__('Version', 'toybox') ?></th>
                    <td><?= esc_html(Theme::VERSION) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= esc_html__('Core path', 'toybox') ?></th>
                    <td><code><?= esc_html(Theme::CORE) ?></code></td>
                </tr>
                <tr>
                    <th scope="row"><?= esc_html__('Theme path', 'toybox') ?></th>
                    <td><code><?= esc_html(get_template_directory()) ?></code></td>
                </tr>
            </tbody>
        </table>
    </div>

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
                        <?= esc_html__('Select a document from the list', 'toybox') ?>
                    <?php else: ?>
                        <?= esc_html__('No documentation available', 'toybox') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <style>
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

            function escapeHtml(text) {
                const div       = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            function simpleMarkdownToHtml(markdown) {
                let html = escapeHtml(markdown);

                // Headers
                html = html.replace(/^######\s+(.+)$/gm, '<h6>$1</h6>');
                html = html.replace(/^#####\s+(.+)$/gm, '<h5>$1</h5>');
                html = html.replace(/^####\s+(.+)$/gm, '<h4>$1</h4>');
                html = html.replace(/^###\s+(.+)$/gm, '<h3>$1</h3>');
                html = html.replace(/^##\s+(.+)$/gm, '<h2>$1</h2>');
                html = html.replace(/^#\s+(.+)$/gm, '<h1>$1</h1>');

                // Code blocks
                html = html.replace(/```([^`]+)```/g, '<pre><code>$1</code></pre>');

                // Inline code
                html = html.replace(/`([^`]+)`/g, '<code>$1</code>');

                // Bold
                html = html.replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>');

                // Italic
                html = html.replace(/\*([^*]+)\*/g, '<em>$1</em>');

                // Links
                html = html.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2">$1</a>');

                // Line breaks
                html = html.replace(/\n\n/g, '</p><p>');
                html = '<p>' + html + '</p>';

                return html;
            }

            docLinks.forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();

                    const docName = this.getAttribute('data-doc');

                    docLinks.forEach(function (l) {
                        l.removeAttribute('data-active');
                    });
                    this.setAttribute('data-active', 'true');

                    if (docs[docName]) {
                        docsContent.innerHTML = simpleMarkdownToHtml(docs[docName]);
                    }
                });

                if (link.getAttribute('data-active') === 'true') {
                    link.click();
                }
            });
        })();
    </script>

    <?php do_action('toybox_developer_page'); ?>
</div>
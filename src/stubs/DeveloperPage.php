<?php

use Toybox\Core\Theme;

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
            </div>
        </div>

        <div class="docs-body">
            <div class="card">
                hello world
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
    </style>

    <?php do_action('toybox_developer_page'); ?>
</div>
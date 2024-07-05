<?php

namespace Toybox\Core\Components;

class Customizer
{
    /**
     * Adds a section to the WP Customizer.
     *
     * @param string $id       The ID for the new section.
     * @param string $title    The title for the new section.
     * @param int    $priority The priority for the new section.
     *
     * @return void
     */
    public static function section(string $id, string $title, int $priority = 30): void
    {
        add_action("customize_register", function ($customizer) use ($id, $title, $priority) {
            $customizer->add_section($id, [
                "title"    => $title,
                "priority" => $priority,
            ]);
        });
    }

    /**
     * Adds a setting to a WP Customizer section.
     *
     * @param string                $id               A specific ID of the setting.
     * @param string                $title            Label for the control.
     * @param string                $description      Description for the control.
     * @param string                $type             Control type. Core controls include 'text', 'checkbox', 'textarea',
     *                                                'radio', 'select', and 'dropdown-pages'. Additional input types such as
     *                                                'email', 'url', 'number', 'hidden', and 'date' are supported implicitly.
     *                                                Default 'text'.
     * @param string|int|bool       $default          Default value for the setting. Default is empty string.
     * @param string                $sectionID        Section the control belongs to.
     * @param array                 $inputAttrs       Attributes to pass into the input.
     * @param string|callable|false $sanitizeCallback Callback to filter a Customize setting value in un-slashed form.
     * @param int                   $priority         Order priority to load the control. Default 10.
     *
     * @return void
     */
    public static function setting(string $id, string $title, string $description, string $type, string|int|bool $default, string $sectionID, array $inputAttrs = [], string|\callable|false $sanitizeCallback = false, int $priority = 10): void
    {
        add_action("customize_register", function ($customizer) use ($id, $title, $description, $type, $default, $sectionID, $inputAttrs, $sanitizeCallback, $priority) {
            $customizer->add_setting($id, [
                "default"           => $default,
                "sanitize_callback" => $sanitizeCallback,
            ]);

            $customizer->add_control($id, [
                "label"       => $title,
                "description" => $description,
                "section"     => $sectionID,
                "type"        => $type,
                "priority"    => $priority,
                "input_attrs" => $inputAttrs,
            ]);
        });
    }

    public static function colorPicker(string $id, string $title, string $description, string|int|bool $default, string $sectionID, string|\callable|false $sanitizeCallback = false, int $priority = 10): void
    {
        add_action("customize_register", function ($customizer) use ($id, $title, $description, $default, $sectionID, $sanitizeCallback, $priority) {
            $customizer->add_setting($id, [
                "default"           => $default,
                "sanitize_callback" => $sanitizeCallback,
            ]);

            $customizer->add_control(new \WP_Customize_Color_Control($customizer, $id, [
                'label'       => $title,
                'section'     => $sectionID,
                'settings'    => $id,
                "description" => $description,
                "priority"    => $priority,
            ]));
        });
    }

    public static function boot()
    {
        foreach (["primary", "secondary", "tertiary", "quaternary"] as $type) {
            $upperType = ucwords($type);

            // Section
            self::section("toybox_color_{$type}", "Toybox {$upperType} Colours");

            // Options
            for ($i = 1; $i <= 4; $i++) {
                if ($i === 1) {
                    self::colorPicker("toybox_color_{$type}_{$i}", "{$upperType} Colour", "The {$type} colour used on the website.", "", "toybox_color_{$type}");
                } else {
                    $varNo = $i - 1;
                    self::colorPicker("toybox_color_{$type}_{$i}", "{$upperType} Colour (Variation {$varNo})", "A variation of the {$type} colour.", "", "toybox_color_{$type}");
                }
            }
        }

        // H1-H6
        for ($i = 1; $i <= 6; $i++) {
            // Heading
            self::section("toybox_headings_h{$i}", "Toybox Headings (H{$i})");

            switch ($i) {
                case 1:
                    $sizeFull   = "2.5";
                    $sizeMedium = "2.25";
                    $sizeSmall  = "2";
                    break;

                default:
                case 2:
                    $sizeFull   = "2.25";
                    $sizeMedium = "2";
                    $sizeSmall  = "1.75";
                    break;

                case 3:
                    $sizeFull   = "2";
                    $sizeMedium = "1.75";
                    $sizeSmall  = "1.5";
                    break;

                case 4:
                    $sizeFull   = "1.75";
                    $sizeMedium = "1.5";
                    $sizeSmall  = "1.25";
                    break;

                case 5:
                    $sizeFull   = "1.5";
                    $sizeMedium = "1.25";
                    $sizeSmall  = "1";
                    break;

                case 6:
                    $sizeFull   = "1.25";
                    $sizeMedium = "1";
                    $sizeSmall  = "0.75";
                    break;
            }

            $weight = 600;

            self::setting("toybox_headings_h{$i}_size_full", "Font Size (REM) - Full", "The size of H{$i} text in REM units.", "text", $sizeFull, "toybox_headings_h{$i}");
            self::setting("toybox_headings_h{$i}_size_medium", "Font Size (REM) - Medium", "The size of H{$i} text in REM units.", "text", $sizeMedium, "toybox_headings_h{$i}");
            self::setting("toybox_headings_h{$i}_size_small", "Font Size (REM) - Small", "The size of H{$i} text in REM units.", "text", $sizeSmall, "toybox_headings_h{$i}");
            self::setting("toybox_headings_h{$i}_weight", "Font Weight", "The weight of H{$i} text.", "number", $weight, "toybox_headings_h{$i}");
        }

        // Title/Body Text
        foreach (["title", "body"] as $text) {
            $upperText = ucwords($text);

            // Section
            self::section("toybox_text_settings_{$text}", "Toybox Text Settings ({$upperText})");
            self::setting("toybox_text_settings_{$text}_family", "Family", "The family for {$text} text.", "text", "system-ui, -apple-system, \"Segoe UI\", Roboto, \"Helvetica Neue\", \"Noto Sans\", \"Liberation Sans\", Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\", \"Noto Color Emoji\"", "toybox_text_settings_{$text}");
            self::setting("toybox_text_settings_{$text}_size_full", "Font Size (REM) - Full", "The size of {$text} text in REM units.", "text", 1, "toybox_text_settings_{$text}");
            self::setting("toybox_text_settings_{$text}_size_medium", "Font Size (REM) - Medium", "The size of {$text} text in REM units.", "text", 1, "toybox_text_settings_{$text}");
            self::setting("toybox_text_settings_{$text}_size_small", "Font Size (REM) - Small", "The size of {$text} text in REM units.", "text", 1, "toybox_text_settings_{$text}");
            self::setting("toybox_text_settings_{$text}_weight", "Font Weight", "The weight of {$text} text.", "number", 400, "toybox_text_settings_{$text}");
        }

        // Other
        self::section("toybox_additional_settings", "Toybox Additional Settings");
        self::colorPicker("toybox_additional_settings_theme_color", "Theme Colour", "The theme colour.", "", "toybox_additional_settings");
    }

    /**
     * Return a value from the customizer.
     *
     * @param string $key
     *
     * @return mixed
     */
    public static function get(string $key)
    {
        return get_theme_mod($key);
    }
}

# Changelog

## v3.0.7 - 2026-04-24

- Bump theme version to 3.0.7 and update ACF field key handling to ensure uniqueness. (92fe77d)

## v3.0.6 - 2026-04-23

- Update default value of `automatic_content_lazy_loading` to `false` and bump theme version. (c67ce28)
- Refactor `ACF::setSavePoint` to implement dynamic save path and filename logic. (c0f5460)
- Bump theme version to 3.0.6. (7b02bab)

## v3.0.5 - 2026-04-23

- Add `$args` parameter to `Theme::boot` and pass to `setup`, adjust file upload support logic formatting, and bump theme version to 3.0.5. (34200ce)

## v3.0.4 - 2026-04-23

- Update `Header` and `Footer` components to return arrays in `settings` method, ensure default value handling, and bump theme version to 3.0.4. (39e1540)

## v3.0.3 - 2026-04-23

- Refactor `Header` and `Footer` components to introduce `settings` method for improved code reuse, optimize caching logic, streamline retrieval of include code, and bump theme version to 3.0.3. (6b6856b)

## v3.0.2 - 2026-04-22

- Refactor asset handling by replacing `mix` with `Assets::getPath`, update block resource paths for better structure, and bump theme version to 3.0.2. (8c69930)

## v3.0.1 - 2026-04-22

- Bump theme version to 3.0.1 and update `editor_styles` to use SCSS path for better asset handling. (a566abb)

## v3.0.0 - 2026-04-22

- Refactor `Theme::setup` to support custom parameters and conditional actions, update `lazy` function for block editor compatibility, and improve example block template. (705e462)
- Refactor example block to streamline asset handling, enhance ACF configuration, and improve template rendering logic. (2e21402)
- Refactor components to improve asset handling, streamline ACF configuration, optimize performance, and add new methods for header, footer, and frontend behavior enhancements. (0ae8701)
- Add custom login page styles to enhance appearance and user experience. (04a0641)
- Remove `MakePostTypeCommand` and post type stub to clean up unused functionality. (ca776d1)
- Remove `Log` and `Query` components to clean up unused code. (405036d)
- Refactor SCSS import syntax in example shortcode for improved maintainability. (557f8a2)
- Deprecate `mix`-based asset handling in favor of Vite and update `lazy` function to support preview rendering, add a `block` helper for streamlined block asset and attribute handling. (87b3f01)
- Refactor `Theme` to introduce `safeDefaults` method, enhance modularity, improve asset handling, add new arguments for `setup`, and bump theme version to 3.0.0. (8315647)

## v2.26.2 - 2025-11-26

- Bump theme version to 2.26.2 and append `rem` units to font size CSS variables in `StyleVars`. (8c63441)

## v2.26.1 - 2025-10-27

- Bump theme version to 2.26.1 and improve image resizing logic to handle smaller original files. (96c7dba)

## v2.26.0 - 2025-10-14

- Refactor example block template for improved readability and comment clarity. (cb5a258)
- Bump theme version to 2.26.0 in preparation for release. (89c3504)

## v2.25.0 - 2025-10-14

- Disable XML-RPC pingback URL in headers. (2d70d0f)
- Add method to hide default WordPress dashboard widgets. (7feec30)
- Update PHP version requirement to ^8.4 in composer.json. (09d0e64)
- Add `disableSelfPingbacks` method to prevent self-referencing pingbacks. (e2e6e05)
- Add `Dashboard::hideWidgets` to `Theme` setup. (7ec6e95)
- Add `Author::removeFrontUrl` method to clean author permalinks. (f76ccb6)
- Bump theme version to 2.25.0 in preparation for release. (4673af4)

## v2.24.0 - 2025-10-09

- Update ACF block JSON to use consistent indentation and blockVersion property. (fcf4c8d)
- Update theme version to 2.24.0. (05a5a1a)

## v2.23.2 - 2025-10-06

- Refactor Login component styles for better layout consistency. (1563e9e)
- Add image upload format conversion and exception handling. (49c433f)
- Integrate Vite for asset management and refactor related functions. (c118ad2)
- Revert "Integrate Vite for asset management and refactor related functions". (b764e4c)
- Replace `mix` with `vite` for asset management, update related functions and constants, add unique ACF field IDs, and introduce critical asset loading functionality. (e23f85f)
- Update calculateReadingSpeed method for flexible input handling and bump theme version. (cb73fd6)

## v2.23.1 - 2025-06-02

- Remove unused code and migrate to Vite and Laravel packages. (7f593a4)
- Update lazy load helper and bump theme version. (fdf1867)

## v2.23.0 - 2025-04-22

- Add method to generate responsive images from thumbnails. (4eaa3eb)

## v2.22.0 - 2025-04-14

- Add Transient::remember method for cached value retrieval. (63cd1dc)
- Update theme version to 2.22.0. (087bc43)

## v2.21.0 - 2025-04-08

- Refactor namespace and update docblock in Lighthouse. (b72a934)

## v2.20.0 - 2025-04-08

- Enhance image utilities and add array merge helper function. (869e413)

## v2.19.2 - 2025-04-07

- Handle false images in makeResponsiveFromACF method. (8d93179)

## v2.19.1 - 2025-04-07

- Update Reviews component and bump theme version. (d48fcbf)

## v2.19.0 - 2025-04-07

- Add Google Reviews component with database and cron integration. (36c2b32)

## v2.18.5 - 2025-02-21

- Update makeResponsive to always use 'full' size for srcset. (3b621f3)
- Update theme version to 2.18.5. (a2fe791)

## v2.18.4 - 2025-02-21

- Add `$size` parameter for more flexible image generation. (49b2256)
- Bump theme version to 2.18.4. (fe6464b)

## v2.18.3 - 2025-02-14

- Update dependencies in composer.json and composer.lock. (f2c140f)
- Update theme version to 2.18.3. (66e9c42)

## v2.18.2 - 2024-11-28

- Lock Monolog to 3.5. (d6e8a4c)

## v2.18.1 - 2024-11-22

- Make `for()` a static method. (475996a)

## v2.18.0 - 2024-11-22

- Add new `for()` method to the Term component to fetch all terms for a given post and taxonomy or taxonomies. (8790c6f)

## v2.17.0 - 2024-09-27

- Add Lighthouse component and detection. (9fb32e2)

## v2.16.0 - 2024-09-26

- Add the Cron component. (57aef50)
- Block stub now ships with a version number in the `block.json` file. (6775d38)
- Increment version number. (4406080)

## v2.15.0 - 2024-09-11

- Add new colour fields for text properties. (55f2e07)

## v2.14.0 - 2024-09-06

- Add feedback and changes for v2.13. (638b2c2)

## v2.13.0 - 2024-09-06

- Add feedback and changes for v2.13. (638b2c2)

## v2.12.4 - 2024-07-26

- Add new login screen styling and load CSS variables in admin. (21644f2)

## v2.12.3 - 2024-07-08

- Add typed return. (056e456)

## v2.12.2 - 2024-07-08

- Add new Term component. (182e698)

## v2.12.1 - 2024-07-05

- Fix TypeError issue with shortcodes. (6052028)

## v2.12.0 - 2024-07-05

- Release 2.12. (b1d359f)

## v2.11.1 - 2024-03-08

- Fix pathing issues so child themes can load and save to the correct locations. (4171adb)

## v2.11.0 - 2024-01-22

- Add `make:pattern` command. (0b75af9)

## v2.10.5 - 2024-01-10

- Create path if it does not exist already. (cac2b86)

## v2.10.4 - 2024-01-05

- Improve login page detection functionality. (3a0a3a9)

## v2.10.3 - 2024-01-05

- Add new `isLoginPage()` method to the Login component. (ffb28e5)

## v2.10.2 - 2024-01-05

- Add new Frontend component. (6bc1eef)

## v2.10.1 - 2023-12-22

- Allow override of the `setup()` method with a hook. (2d383c6)

## v2.10.0 - 2023-12-22

- Add setup hooks and fluent query builder, and move snippets to boot first. (dadbe84)

## v2.9.14 - 2023-12-22

- Fix return type. (e7ad650)

## v2.9.13 - 2023-12-22

- False launch. (8953b33)

## v2.9.12 - 2023-12-22

- False launch. (fbc76b0)

## v2.9.11 - 2023-12-22

- Add Post component with `get()` method. (97785f5)

## v2.9.10 - 2023-12-22

- Change Blocks `parse()` method to parse blocks without rendering an HTML string. (75fc09c)

## v2.9.9 - 2023-12-20

- Add global lazyloaded blocks list for better performance. (28e6db4)

## v2.9.8 - 2023-12-20

- Add `allowedBlocks()` method to the Blocks component. (010aa87)

## v2.9.7 - 2023-12-20

- Update ACF component's `setSavePoint()` method to handle saved field groups where `location` is not an applicable key in `$post`, such as when creating a CPT via ACF. (c74dc66)

## v2.9.6 - 2023-12-19

- Rename the MakeBlockCommand argument from `--without-styles` to `--without-css` for consistency. (4cf07cd)

## v2.9.5 - 2023-12-19

- Add `$disableCritical` parameter to `Theme::boot()`. (0b1a5fc)

## v2.9.4 - 2023-12-18

- Add caching to Globals `headerCode()` and `footerCode()` methods. (dc4d005)

## v2.9.2 - 2023-12-18

- Add new Globals component with `headerCode()` and `footerCode()` methods. (9faf51c)

## v2.9.1 - 2023-12-13

- Add an extra parameter to the Image component's `makeResponsive()` and `makeResponsiveFromACF()` methods so classes can be passed in an array and applied to the image. (8428346)

## v2.9.0 - 2023-12-13

- Change Image `makeResponsive()` to take an attachment ID only, while `makeResponsiveFromACF()` keeps the same arguments and falls back to `makeResponsive()` after fetching the attachment ID. (3333d48)
- Add new CSS component with an `inline()` method for inlining CSS when required. (03de8c3)
- Update theme version to 2.9.0. (59b743c)

## v2.8.8 - 2023-12-13

- Fix return value not being set. (7407127)

## v2.8.7 - 2023-12-13

- Add a more reliable way to save block settings to the correct folder. (4c3e72d)

## v2.8.6 - 2023-12-13

- Add `parse()` method to Blocks component. (023ea34)

## v2.8.5 - 2023-12-13

- Add `get()` method to Excerpts component. (7886901)

## v2.8.4 - 2023-12-05

- Add `makeResponsiveFromACF` method to Image component for adding srcset values to image fields in ACF. (84892d7)

## v2.8.3 - 2023-11-28

- Add third `$isPreview` parameter to the `lazy()` helper. (e54235a)

## v2.8.2 - 2023-11-14

- Allow `error_reporting` to be set outside of the `WP_DEBUG` environment. (c87c3a9)

## v2.8.1 - 2023-11-14

- Add WooCommerce component. (3c5c933)

## v2.8.0 - 2023-11-13

- Add new Archive component. (903be1d)
- Increment version number. (7478dda)

## v2.7.3 - 2023-11-09

- Match image conversion extensions case-insensitively. (7ea54f3)
- Update version number. (1430d51)

## v2.7.2 - 2023-10-16

- Add `permission_callback` to API component registration. (77e6d06)
- Update version number. (1074542)

## v2.7.1 - 2023-09-28

- Fix static calls to the Image component's `makeResponsive()` function. (ce92766)

## v2.7.0 - 2023-09-26

- Update ACF paths. (121e3be)
- Update dependencies. (da91265)

## v2.6.1 - 2023-09-25

- Populate Maps API key from a field. (640c71b)

## v2.6.0 - 2023-09-18

- Add Device component. (108c06e)

## v2.5.2 - 2023-09-13

- Fix menu echo bug. (69a62b7)

## v2.5.1 - 2023-09-13

- Add new menu getter function. (47865c7)
- Increment version number. (7288494)

## v2.5.0 - 2023-09-13

- Add block render method. (54ac699)
- Add deprecation notice to the block export command. (53eca80)
- Increment version number. (62dca12)
- Update dependencies. (2fa8abc)

## v2.4.0 - 2023-09-03

- Add pattern support. (ec10880)

## v2.3.1 - 2023-08-25

- Add new Image component. (13898e8)
- Update version. (537d850)

## v2.3.0 - 2023-08-25

- Add lazyloading attribute helper function. (c3d822f)
- Add new ACF save point logic. (005e3d6)
- Update version number. (ed148e6)

## v2.2.0 - 2023-07-03

- Add new preloading method. (97c08de)
- Add new API component. (40a3f34)
- Only load the required block assets for a page. (fed401d)
- Set version number. (cbb25f9)

## v2.1.7 - 2023-06-27

- Fix directory separators. (b3ae6b6)

## v2.1.6 - 2023-06-27

- Fix an issue with connection to WordPress. (9981df5)

## v2.1.5 - 2023-06-27

- Fix an issue with connection to WordPress. (48e1593)

## v2.1.4 - 2023-06-27

- Comment out style and script registrations by default, and add a console command comment explaining when to uncomment them. (00f105d)

## v2.1.3 - 2023-05-28

- Add Google Maps API key register function. (d957b81)

## v2.1.2 - 2023-05-26

- Fix editor style path not being found. (9892f63)

## v2.1.1 - 2023-05-25

- Add `disableWrap` method to stop inner block wrapping. (d126e80)

## v2.1.0 - 2023-05-22

- Release 2.1.0. (ab26123)

## v2.0.1 - 2023-05-15

- Update core version. (f0cfd62)

## v2.0.0 - 2023-05-15

- Initial commit. (8d28fcc)
- Remove media regenerate command for now. (0eac108)

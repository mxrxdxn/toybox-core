# Blocks

The `Blocks` component registers, renders, parses, and configures WordPress blocks.

```php
use Toybox\Core\Components\Blocks;
```

## Methods

### `boot()`

Autoload blocks from the /blocks directory.

```php
public static function boot(): void
```

**Returns:** void

### `registerAssets()`

Registers block assets for use in WordPress.

```php
public static function registerAssets(array $assets): void
```

| Parameter | Description |
| --- | --- |
| `$assets` | Map of block names to script and style asset definitions. |

**Returns:** void

### `disableWrap()`

Disable inner block wrapping on the frontend.

```php
public static function disableWrap(array $blockNames): void
```

| Parameter | Description |
| --- | --- |
| `$blockNames` | Block names whose frontend wrapper elements should be removed. |

**Returns:** void

### `render()`

Render a block, outside of Gutenberg.

```php
public static function render(string $blockName, array $data = []): void
```

| Parameter | Description |
| --- | --- |
| `$blockName` | The namespace/name of the block. Toybox blocks are usually prefixed as toybox/{name}. |
| `$data` | An array of data to load into the block, which will be used by all get_field calls. |

**Returns:** void

### `renderContentString()`

Parses blocks from a content string into HTML.

```php
public static function renderContentString(string $content): string
```

| Parameter | Description |
| --- | --- |
| `$content` | Serialized WordPress block content to render. |

**Returns:** string

### `parse()`

Parses blocks from a content string.

```php
public static function parse(string $content): array
```

| Parameter | Description |
| --- | --- |
| `$content` | Serialized WordPress block content to parse. |

**Returns:** array

### `allowedBlocks()`

Returns a formatted string for use inside the `allowedBlocks` attribute on an <InnerBlocks> element.

```php
public static function allowedBlocks(array $allowedBlocks): string
```

| Parameter | Description |
| --- | --- |
| `$allowedBlocks` | An array of block names, including namespaces. |

**Returns:** string

### `isPreview()`

Detect if the block is in preview mode or not.

```php
public static function isPreview(array $block): bool
```

| Parameter | Description |
| --- | --- |
| `$block` | Block data supplied by the block render callback. |

**Returns:** bool

### `preview()`

Render a block preview.

```php
public static function preview(array $block, string $path): string
```

| Parameter | Description |
| --- | --- |
| `$block` | The block settings. |
| `$path` | The path to the preview image. |

**Returns:** string

### `disableBlockLibraryAssets()`

Disables the loading of block library styles on the front-end. This method removes the default block library CSS, block library theme CSS, and global styles to reduce unnecessary CSS loading when blocks are not required.

```php
public static function disableBlockLibraryAssets(): void
```

**Returns:** void


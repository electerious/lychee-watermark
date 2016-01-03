> WARNING: This module has been deprecated.

# Watermark

Watermark is a plugin for [Lychee](https://github.com/electerious/Lychee). It adds a second watermarked photo when uploading images.

## Installation

This extension requires a working [Lychee](https://github.com/electerious/Lychee) **v2.6.2 (or newer)** on your computer or server.

#### 1. Download

Navigate to the plugin-folder (`plugins/`) of your Lychee and run the following command:

	git clone --recursive https://github.com/electerious/lychee-watermark.git watermark
	
GitHub doesn't support submodules when you hit the download button on their site. This means that **you must use the command above** to get the full code.

#### 2. Activate Plugin
	
Open the MySQL database and select the table `lychee_settings`. Set the value of `plugins` to the path of your plugin: `watermark/index.php`.

You can find more information about plugins in the documentation of [Lychee](https://github.com/electerious/Lychee).

#### 3. Upload

Open your browser and upload photos to Lychee. A second watermarked-photo will appear next to your uploaded one.

## Configuration

The watermarks are specified in the table `lychee_watermarks` of your database.

- You can add as many configurations as you want
- Lychee will always use the first row where `active` is 1
- Paths are relative starting from the watermark directory

| Field | Description |
|:-----------|:------------|
| `id` |  |
| `active` | `0` = Inactive, `1` = Active |
| `description` | Optional text for your purpose |
| `type` | `text` or `image` |
| `text` | The text which should be placed on your photo |
| `font_path` | Relative path to the `*.ttf` for the font of your text |
| `font_size` | Size of the font |
| `font_color` | Hex-color of your font starting with a `#` |
| `font_bgcolor` | Hex-color for the background of your text (starting with a `#`) |
| `image_path` | Relative path to the watermarks-image |
| `position_align` | `topleft`, `topcenter`, `topright`, `centerleft`, `center` … |
| `position_x` | x-offset in px |
| `position_y` | y-offset in px |

## FAQ

#### What do I need to run this plugin on my server?
This plugin has the same dependencies as Lychee. Depending on the size of the photos, the plugin (and php) may need a higher memory_limit. More below.

#### I can't upload photos
We recommend to increase the values of the following properties in your `php.ini`:

	max_execution_time = 200
	memory_limit = 512M

## License

(MIT License)

Copyright (C) 2014 [Tobias Reich](http://electerious.com)

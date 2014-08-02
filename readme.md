# Watermark

Watermark is a plugin for [Lychee](https://github.com/electerious/Lychee), which adds a second watermarked photo when uploading photos.

## Installation

This extension requires a working [Lychee](https://github.com/electerious/Lychee) v2.5 (or newer) on your computer or server.

Navigate to the plugin-folder (`plugins/`) of your Lychee and run the following command:

	git clone https://github.com/electerious/lychee-watermark.git watermark
	
Open the MySQL database and select the table `lychee_settings`. Set the value of `plugins` to the path of your plugin: `watermark/index.php`.

You can find more information about plugins in the documentation of [Lychee](https://github.com/electerious/Lychee).

## Configuration

1. Open Lychee (It will create the watermark-table in the background)
2. Open the MySQL database and select the table `lychee_watermarks`. Add a new row to specify a watermark.
3. Open your browser and upload photos to Lychee. A second watermarked-photo will appear next to your uploaded one.

## License

(MIT License)

Copyright (C) 2014 [Tobias Reich](http://electerious.com)
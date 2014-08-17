<?php

###
# @name			Watermark Plugin
# @author		Tobias Reich
# @copyright	2014 by Tobias Reich
###

if (!defined('LYCHEE')) exit('Error: Direct access is not allowed!');

use gdenhancer\GDEnhancer;
include_once('gdenhancer/src/gdenhancer/GDEnhancer.php');

class Watermark implements SplObserver {

	private $database = null;
	private $settings = null;

	public function __construct($database, $settings) {

		# Init vars
		$this->database = $database;
		$this->settings = $settings;

		# Check tables
		if (!$this->database->query('SELECT * FROM lychee_watermarks LIMIT 0;'))
			if (!$this->createTable()) exit('Error: Could not create table for watermarks!');

		# Check content
		if ($this->database->query('SELECT * FROM lychee_watermarks;')->num_rows===0)
			if (!$this->createRow()) exit('Error: Could not add a new watermark to the watermarks table!');

		return true;

	}

	private function createTable() {

		if (!isset($this->database)) return false;

		# Create watermarks
		if (!$this->database->query('SELECT * FROM lychee_watermarks LIMIT 0;')) {

			# Read file
			$file	= __DIR__ . '/watermarks_table.sql';
			$query	= file_get_contents($file);

			# Create table
			if (!isset($query)||$query===false) {
				Log::error($this->database, __METHOD__, __LINE__, 'Could not read .sql file for watermarks-table');
				return false;
			}
			if (!$this->database->query($query)) {
				Log::error($this->database, __METHOD__, __LINE__, 'Could not create table watermarks in database');
				return false;
			}

		}

		return true;

	}

	private function createRow() {

		if (!isset($this->database)) return false;

		$query = "INSERT INTO `lychee_watermarks` (`active`, `description`, `type`, `text`, `font_path`, `font_size`, `font_color`, `position_align`, `position_x`, `position_y`) VALUES (1, 'Default', 'text', 'Lorem ipsum', 'SourceSansPro.ttf', '42', '#ffffff', 'center', '0', '0');";

		if (!$this->database->query($query)) {
			Log::error($this->database, __METHOD__, __LINE__, 'Could not add a new watermark to the watermarks table');
			return false;
		}

		return true;

	}

	public function update(\SplSubject $subject) {

		if ($subject->action!=='Photo::add:before') return false;
		if (!isset($subject->args[0][0]['tmp_name'])) return false;

		# Get watermark info
		$watermark = $this->get();
		if ($watermark===false) {
			Log::error($this->database, __METHOD__, __LINE__, 'Specified watermark not found in database');
			return false;
		}

		# Set watermark info
		$old_path	= null;
		$new_path	= LYCHEE_DATA . 'watermark_temp.jpeg';

		# Set text
		$text		= $watermark->text;
		$font_path	= __DIR__ . '/' . $watermark->font_path;
		$font_size	= $watermark->font_size;
		$font_color	= $watermark->font_color;

		# Set position
		$position	= array('align' => $watermark->position_align, 'x' => $watermark->position_x, 'y' => $watermark->position_y);

		# Set import info
		$albumID		= @$subject->args[1];
		$description	= @$subject->args[2];
		$tags			= @$subject->args[3];

		# Add tag
		if (!isset($tags)||$tags==='') $tags = 'watermarked';
		else $tags .= ',watermarked';

		# For each file
		foreach ($subject->args[0] as $file) {

			# Set watermark info
			$old_path = $file['tmp_name'];

			# Import if uploaded via web
			if (is_uploaded_file($old_path)) {
				$move_path = LYCHEE_DATA . 'watermark_moved.jpeg';
				if (!@copy($old_path, $move_path)) {
					Log::error($this->database, __METHOD__, __LINE__, 'Could not temporary copy photo to data');
					return false;
				}
				$old_path = $move_path;
			}

			# Create watermark image
			$return = $this->addText($old_path, $new_path, $text, $font_path, $font_size, $font_color, $position);
			if ($return!==true) {
				Log::error($this->database, __METHOD__, __LINE__, 'Failed to add watermark text to photo. Function returned: ' . $return);
				return false;
			}

			# Import new image
			$return = Import::photo($this->database, null, $this->settings, $new_path, $albumID, $description, $tags);
			if ($return!==true) {
				Log::error($this->database, __METHOD__, __LINE__, 'Failed to import watermarked photo. Import returned: ' . $return);
				return false;
			}

		}

		return true;

	}

	private function get() {

		if (!isset($this->database)) return false;

		$watermarks	= $this->database->query("SELECT * FROM lychee_watermarks WHERE active = '1' LIMIT 1;");
		if ($watermarks->num_rows===0) return false;

		return $watermarks->fetch_object();

	}

	private function addText($old_path, $new_path, $text, $font_path, $font_size, $font_color, $position) {

		if (!isset($this->database, $old_path, $new_path, $text, $font_path, $font_size, $font_color, $position)) return 'Missing parameters';

		$image = new GDEnhancer($old_path);
		$image->layerText($text, $font_path, $font_size, $font_color, 0, 0.7);
		$image->layerMove(0, $position['align'], $position['x'], $position['y']);

		$save = $image->save();
		file_put_contents($new_path, $save['contents']);

		return true;

	}

}

$plugins->attach(new Watermark($database, $settings));
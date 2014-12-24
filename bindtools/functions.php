<?php

require_once(__DIR__ . '/infrastructure.php');

class CairoFunctions {
	static public function get() {
		$surface = type('cairo_surface_t', 'cairo_surface_destroy');
		$format = enum_type('cairo_format_t');
		$status = enum_type('cairo_status_t');
		$int = prim_prim_type('int', 'int');
		$string = prim_prim_type('string', 'const char*');

		$bytePointer = prim_type(
			'unsigned char*',
			'unsigned char*',
			function($v) { return "{ buffer temp = val_to_buffer($v); if (!temp) hx_failure(\"invalid source buffer\");}"; },
			function($v) { return "(unsigned char*)buffer_data(val_to_buffer($v))"; },
			function($v) { return "-----"; }
		);

		return [
			'abstracts' => [ $surface ],
			'functions' => [
				func($string, 'cairo_version_string', []),
				func($surface, 'cairo_image_surface_create', [arg($format, 'format'), arg($int, 'width'), arg($int, 'height')]),
				func($surface, 'cairo_image_surface_create_for_data', [arg($bytePointer, 'data'), arg($format, 'format'), arg($int, 'width'), arg($int, 'height'), arg($int, 'stride')]),
				func($surface, 'cairo_image_surface_create_from_png', [arg($string, 'filename')]),
				func($status, 'cairo_surface_write_to_png', [arg($surface, 'surface'), arg($string, 'filename')]),
				func($format, 'cairo_image_surface_get_format', [arg($surface, 'surface')]),
				func($int, 'cairo_image_surface_get_width', [arg($surface, 'surface')]),
				func($int, 'cairo_image_surface_get_height', [arg($surface, 'surface')]),
				func($int, 'cairo_image_surface_get_stride', [arg($surface, 'surface')]),
			]
		];
	}
}

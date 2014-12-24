<?php

require_once(__DIR__ . '/infrastructure.php');

class CairoFunctions {
	static public function get() {
		$surface = type('cairo_surface_t', 'cairo_surface_destroy');
		$cairo = type('cairo_t', 'free');
		$matrix = type('cairo_matrix_t', 'free');

		$format = enum_type('cairo_format_t');
		$status = enum_type('cairo_status_t');
		$int = prim_prim_type('int', 'int');
		$double = prim_prim_type('float', 'float');
		$void = prim_prim_type('void', 'void');
		$string = prim_prim_type('string', 'const char*');

		$bytePointer = prim_type(
			'unsigned char*',
			'unsigned char*',
			function($v) { return "{ buffer temp = val_to_buffer($v); if (!temp) hx_failure(\"invalid source buffer\");}"; },
			function($v) { return "(unsigned char*)buffer_data(val_to_buffer($v))"; },
			function($v) { return "-----"; }
		);

		return [
			'abstracts' => [ $surface, $cairo, $matrix ],
			'functions' => [
				func($string, 'cairo_version_string', []),

				func($surface, 'cairo_image_surface_create', [arg($format, 'format'), arg($int, 'width'), arg($int, 'height')]),
				func($surface, 'cairo_image_surface_create_for_data', [arg($bytePointer, 'data'), arg($format, 'format'), arg($int, 'width'), arg($int, 'height'), arg($int, 'stride')]),
				
				func($format, 'cairo_image_surface_get_format', [arg($surface, 'surface')]),
				func($int, 'cairo_image_surface_get_width', [arg($surface, 'surface')]),
				func($int, 'cairo_image_surface_get_height', [arg($surface, 'surface')]),
				func($int, 'cairo_image_surface_get_stride', [arg($surface, 'surface')]),

				// Transformations: http://cairographics.org/manual/cairo-Transformations.html
				func($void, 'cairo_translate', [arg($cairo, 'cr'), arg($double, 'tx'), arg($double, 'ty')]),
				func($void, 'cairo_scale', [arg($cairo, 'cr'), arg($double, 'sx'), arg($double, 'sy')]),
				func($void, 'cairo_rotate', [arg($cairo, 'cr'), arg($double, 'angle')]),
				func($void, 'cairo_transform', [arg($cairo, 'cr'), arg($matrix, 'matrix')]),
				func($void, 'cairo_set_matrix', [arg($cairo, 'cr'), arg($matrix, 'matrix')]),
				func($void, 'cairo_get_matrix', [arg($cairo, 'cr'), arg($matrix, 'matrix')]),
				func($void, 'cairo_identity_matrix', [arg($cairo, 'cr')]),

				// void cairo_user_to_device                (cairo_t *cr, double *x, double *y);
				// void cairo_user_to_device_distance       (cairo_t *cr, double *dx, double *dy);
				// void cairo_device_to_user                (cairo_t *cr, double *x, double *y);
				// void cairo_device_to_user_distance       (cairo_t *cr, double *dx, double *dy);

				// PNG Support : http://cairographics.org/manual/cairo-PNG-Support.html
				func($surface, 'cairo_image_surface_create_from_png', [arg($string, 'filename')]),
				func($status, 'cairo_surface_write_to_png', [arg($surface, 'surface'), arg($string, 'filename')]),
			]
		];
	}
}

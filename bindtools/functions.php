<?php

require_once(__DIR__ . '/infrastructure.php');

class CairoFunctions {
	static public function get() {
		$surface = type('cairo_surface_t', 'cairo_surface_destroy');
		$cairo = type('cairo_t', 'cairo_destroy');
		$pattern = type('cairo_pattern_t', 'cairo_pattern_destroy');
		$matrix = type('cairo_matrix_t', 'cairo_matrix_destroy');
		$path = type('cairo_path_t', 'cairo_path_destroy');
		

		$format = enum_type('cairo_format_t');
		$status = enum_type('cairo_status_t');
		$antialias = enum_type('cairo_antialias_t');
		$operator = enum_type('cairo_operator_t');
		$fillrule = enum_type('cairo_fill_rule_t');
		$content = enum_type('cairo_content_t');
		$linecap = enum_type('cairo_line_cap_t');
		$linejoin = enum_type('cairo_line_join_t');
		
		$int = prim_prim_type('int', 'int');
		$bool = prim_prim_type('bool', 'bool');
		$void = prim_prim_type('void', 'void');
		$string = prim_prim_type('string', 'const char*');

		$double = prim_type(
			'double',
			'double',
			function($v) { return "val_check($v, number);"; },
			function($v) { return ""; },
			function($v) { return "val_get_double($v)"; },
			function($v) { return "alloc_float($v)"; }
		);

		$bytePointer = prim_type(
			'unsigned char*',
			'unsigned char*',
			function($v) { return "{ buffer temp = val_to_buffer($v); if (!temp) hx_failure(\"invalid source buffer\");}"; },
			function($v) { return ""; },
			function($v) { return "(unsigned char*)buffer_data(val_to_buffer($v))"; },
			function($v) { return "-----"; }
		);

		$pointRef = prim_type(
			'unsigned char*',
			'unsigned char*',
			function($v) { return "val_check({$v}, array); double {$v}_x = val_number(val_array_i({$v}, 0)), {$v}_y = val_number(val_array_i({$v}, 1))"; },
			function($v) { return "val_array_set_i($v, 0, alloc_float({$v}_x)); val_array_set_i($v, 1, alloc_float({$v}_y));"; },
			function($v) { return "&{$v}_x, &{$v}_y"; },
			function($v) { return "-----"; }
		);

		return [
			'abstracts' => [ $surface, $cairo, $pattern, $matrix, $path ],
			'functions' => [
				func($string, 'cairo_version_string', []),

				// Cairo
				func($cairo, 'cairo_create', [arg($surface, 'target')]),
				//func($cairo, 'cairo_reference', [arg($cairo, 'cr')]),
				//func($cairo, 'cairo_destroy', [arg($cairo, 'cr')]),
				//func($int, 'cairo_get_reference_count', [arg($cairo, 'cr')]),
				func($void, 'cairo_save', [arg($cairo, 'cr')]),
				func($void, 'cairo_restore', [arg($cairo, 'cr')]),
				func($void, 'cairo_set_source', [arg($cairo, 'cr'), arg($pattern, 'source')]),
				func($void, 'cairo_set_source_rgb', [arg($cairo, 'cr'), arg($double, 'red'), arg($double, 'green'), arg($double, 'blue')]),
				func($void, 'cairo_set_source_rgba', [arg($cairo, 'cr'), arg($double, 'red'), arg($double, 'green'), arg($double, 'blue'), arg($double, 'alpha')]),
				func($void, 'cairo_set_source_surface', [arg($cairo, 'cr'), arg($surface, 'surface'), arg($double, 'x'), arg($double, 'y')]),
				func($pattern, 'cairo_get_source', [arg($cairo, 'cr')]),


				func($void, 'cairo_fill', [arg($cairo, 'cr')]),
				func($void, 'cairo_stroke', [arg($cairo, 'cr')]),
				func($status, 'cairo_status', [arg($cairo, 'cr')]),
				func($surface, 'cairo_get_target', [arg($cairo, 'cr')]),

				func($void, 'cairo_set_antialias', [arg($cairo, 'cr'), arg($antialias, 'value')]),
				func($antialias, 'cairo_get_antialias', [arg($cairo, 'cr')]),

				func($void, 'cairo_set_fill_rule', [arg($cairo, 'cr'), arg($fillrule, 'value')]),
				func($fillrule, 'cairo_get_fill_rule', [arg($cairo, 'cr')]),

				func($void, 'cairo_set_line_cap', [arg($cairo, 'cr'), arg($linecap, 'value')]),
				func($linecap, 'cairo_get_line_cap', [arg($cairo, 'cr')]),

				func($void, 'cairo_set_line_join', [arg($cairo, 'cr'), arg($linejoin, 'value')]),
				func($linejoin, 'cairo_get_line_join', [arg($cairo, 'cr')]),

				func($void, 'cairo_set_line_width', [arg($cairo, 'cr'), arg($double, 'value')]),
				func($void, 'cairo_set_miter_limit', [arg($cairo, 'cr'), arg($double, 'value')]),
				func($void, 'cairo_set_tolerance', [arg($cairo, 'cr'), arg($double, 'value')]),

				func($double, 'cairo_get_line_width', [arg($cairo, 'cr')]),
				func($double, 'cairo_get_miter_limit', [arg($cairo, 'cr')]),
				func($double, 'cairo_get_tolerance', [arg($cairo, 'cr')]),

				func($void, 'cairo_set_operator', [arg($cairo, 'cr'), arg($operator, 'op')]),
				func($operator, 'cairo_get_operator', [arg($cairo, 'cr')]),

				func($void, 'cairo_copy_page', [arg($cairo, 'cr')]),
				func($void, 'cairo_show_page', [arg($cairo, 'cr')]),

				func($void, 'cairo_push_group', [arg($cairo, 'cr')]),
				func($void, 'cairo_push_group_with_content', [arg($cairo, 'cr'), arg($content, 'content')]),

				func($pattern, 'cairo_pop_group', [arg($cairo, 'cr')]),
				func($void, 'cairo_pop_group_to_source', [arg($cairo, 'cr')]),
				func($surface, 'cairo_get_group_target', [arg($cairo, 'cr')]),

				func($void, 'cairo_clip_extents', [arg($cairo, 'cr'), arg($pointRef, 'p1'), arg($pointRef, 'p2')]),

				func($void, 'cairo_clip', [arg($cairo, 'cr')]),
				func($void, 'cairo_clip_preserve', [arg($cairo, 'cr')]),
				func($bool, 'cairo_in_clip', [arg($cairo, 'cr'), arg($double, 'x'), arg($double, 'y')]),
				func($void, 'cairo_reset_clip', [arg($cairo, 'cr')]),

/*
void                cairo_set_dash                      (cairo_t *cr, const double *dashes, int num_dashes, double offset);
int                 cairo_get_dash_count                (cairo_t *cr);
void                cairo_get_dash                      (cairo_t *cr, double *dashes, double *offset);
cairo_rectangle_t;
cairo_rectangle_list_t;
void                cairo_rectangle_list_destroy        (cairo_rectangle_list_t *rectangle_list);
cairo_rectangle_list_t * cairo_copy_clip_rectangle_list (cairo_t *cr);
void                cairo_fill_preserve                 (cairo_t *cr);
void                cairo_fill_extents                  (cairo_t *cr, double *x1, double *y1, double *x2, double *y2);
cairo_bool_t        cairo_in_fill                       (cairo_t *cr, double x, double y);
void                cairo_mask                          (cairo_t *cr, cairo_pattern_t *pattern);
void                cairo_mask_surface                  (cairo_t *cr, cairo_surface_t *surface, double surface_x, double surface_y);
void                cairo_paint                         (cairo_t *cr);
void                cairo_paint_with_alpha              (cairo_t *cr, double alpha);
void                cairo_stroke_preserve               (cairo_t *cr);
void                cairo_stroke_extents                (cairo_t *cr, double *x1, double *y1, double *x2, double *y2);
cairo_bool_t        cairo_in_stroke                     (cairo_t *cr, double x, double y);
cairo_status_t      cairo_set_user_data                 (cairo_t *cr, const cairo_user_data_key_t *key, void *user_data, cairo_destroy_func_t destroy);
void *              cairo_get_user_data                 (cairo_t *cr, const cairo_user_data_key_t *key);
*/
				// Matrix - http://cairographics.org/manual/cairo-cairo-matrix-t.html
				func($matrix, 'cairo_matrix_create', []),
				func($void, 'cairo_matrix_init', [arg($matrix, 'matrix'), arg($double, 'xx'), arg($double, 'yx'), arg($double, 'xy'), arg($double, 'yy'), arg($double, 'x0'), arg($double, 'y0')]),
				func($void, 'cairo_matrix_init_identity', [arg($matrix, 'matrix')]),
				func($void, 'cairo_matrix_init_translate', [arg($matrix, 'matrix'), arg($double, 'tx'), arg($double, 'ty')]),
				func($void, 'cairo_matrix_init_scale', [arg($matrix, 'matrix'), arg($double, 'sx'), arg($double, 'sy')]),
				func($void, 'cairo_matrix_init_rotate', [arg($matrix, 'matrix'), arg($double, 'radians')]),

				func($void, 'cairo_matrix_translate', [arg($matrix, 'matrix'), arg($double, 'tx'), arg($double, 'ty')]),
				func($void, 'cairo_matrix_scale', [arg($matrix, 'matrix'), arg($double, 'sx'), arg($double, 'sy')]),
				func($void, 'cairo_matrix_rotate', [arg($matrix, 'matrix'), arg($double, 'radians')]),
				func($status, 'cairo_matrix_invert', [arg($matrix, 'matrix')]),
				func($void, 'cairo_matrix_multiply', [arg($matrix, 'result'), arg($matrix, 'a'), arg($matrix, 'b')]),

				func($void, 'cairo_matrix_transform_distance', [arg($matrix, 'matrix'), arg($pointRef, 'point')]),
				func($void, 'cairo_matrix_transform_point', [arg($matrix, 'matrix'), arg($pointRef, 'point')]),
				
				// Surface: http://cairographics.org/manual/cairo-Image-Surfaces.html
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

				// Paths: http://cairographics.org/manual/cairo-Paths.html
				func($path, 'cairo_copy_path', [arg($cairo, 'cr')]),
				func($path, 'cairo_copy_path_flat', [arg($cairo, 'cr')]),
				func($void, 'cairo_append_path', [arg($cairo, 'cr'), arg($path, 'path')]),
				func($void, 'cairo_line_to', [arg($cairo, 'cr'), arg($double, 'x'), arg($double, 'y')]),
				func($void, 'cairo_move_to', [arg($cairo, 'cr'), arg($double, 'x'), arg($double, 'y')]),
				func($void, 'cairo_new_path', [arg($cairo, 'cr')]),
				func($void, 'cairo_new_sub_path', [arg($cairo, 'cr')]),
				func($void, 'cairo_close_path', [arg($cairo, 'cr')]),
				func($void, 'cairo_arc', [arg($cairo, 'cr'), arg($double, 'xc'), arg($double, 'yc'), arg($double, 'radius'), arg($double, 'angle1'), arg($double, 'angle2')]),
				func($void, 'cairo_arc_negative', [arg($cairo, 'cr'), arg($double, 'xc'), arg($double, 'yc'), arg($double, 'radius'), arg($double, 'angle1'), arg($double, 'angle2')]),
				func($void, 'cairo_curve_to', [arg($cairo, 'cr'), arg($double, 'x1'), arg($double, 'y1'), arg($double, 'x2'), arg($double, 'y2'), arg($double, 'x3'), arg($double, 'y3')]),

				func($void, 'cairo_rel_curve_to', [arg($cairo, 'cr'), arg($double, 'dx1'), arg($double, 'dy1'), arg($double, 'dx2'), arg($double, 'dy2'), arg($double, 'dx3'), arg($double, 'dy3')]),
				func($void, 'cairo_rel_line_to', [arg($cairo, 'cr'), arg($double, 'dx'), arg($double, 'dy')]),
				func($void, 'cairo_rel_move_to', [arg($cairo, 'cr'), arg($double, 'dx'), arg($double, 'dy')]),

				func($void, 'cairo_rectangle', [arg($cairo, 'cr'), arg($double, 'x'), arg($double, 'y'), arg($double, 'width'), arg($double, 'height')]),

				func($bool, 'cairo_has_current_point', [arg($cairo, 'cr')]),
				func($void, 'cairo_get_current_point', [arg($cairo, 'cr'), arg($pointRef, 'point')]),

				func($void, 'cairo_path_extents', [arg($cairo, 'cr'), arg($pointRef, 'p1'), arg($pointRef, 'p2')]),

				func($void, 'cairo_user_to_device', [arg($cairo, 'cr'), arg($pointRef, 'point')]);
				func($void, 'cairo_user_to_device_distance', [arg($cairo, 'cr'), arg($pointRef, 'point')]);
				func($void, 'cairo_device_to_user', [arg($cairo, 'cr'), arg($pointRef, 'point')]);
				func($void, 'cairo_device_to_user_distance', [arg($cairo, 'cr'), arg($pointRef, 'point')]);

/*
union               cairo_path_data_t;
enum                cairo_path_data_type_t;

void                cairo_glyph_path                    (cairo_t *cr, const cairo_glyph_t *glyphs, int num_glyphs);
void                cairo_text_path                     (cairo_t *cr, const char *utf8);
*/

				// Patterns: http://cairographics.org/manual/cairo-cairo-pattern-t.html
				func($pattern, 'cairo_pattern_create_rgba', [arg($double, 'red'), arg($double, 'green'), arg($double, 'blue'), arg($double, 'alpha')]),
				/*
				typedef             cairo_pattern_t;
void                cairo_pattern_add_color_stop_rgb    (cairo_pattern_t *pattern, double offset, double red, double green, double blue);
void                cairo_pattern_add_color_stop_rgba   (cairo_pattern_t *pattern, double offset, double red, double green, double blue, double alpha);
cairo_status_t      cairo_pattern_get_color_stop_count  (cairo_pattern_t *pattern, int *count);
cairo_status_t      cairo_pattern_get_color_stop_rgba   (cairo_pattern_t *pattern, int index, double *offset, double *red, double *green, double *blue, double *alpha);
cairo_pattern_t *   cairo_pattern_create_rgb            (double red, double green, double blue);
cairo_pattern_t *   cairo_pattern_create_rgba           (double red, double green, double blue, double alpha);
cairo_status_t      cairo_pattern_get_rgba              (cairo_pattern_t *pattern, double *red, double *green, double *blue, double *alpha);
cairo_pattern_t *   cairo_pattern_create_for_surface    (cairo_surface_t *surface);
cairo_status_t      cairo_pattern_get_surface           (cairo_pattern_t *pattern, cairo_surface_t **surface);
cairo_pattern_t *   cairo_pattern_create_linear         (double x0, double y0, double x1, double y1);
cairo_status_t      cairo_pattern_get_linear_points     (cairo_pattern_t *pattern, double *x0, double *y0, double *x1, double *y1);
cairo_pattern_t *   cairo_pattern_create_radial         (double cx0, double cy0, double radius0, double cx1, double cy1, double radius1);
cairo_status_t      cairo_pattern_get_radial_circles    (cairo_pattern_t *pattern, double *x0, double *y0, double *r0, double *x1, double *y1, double *r1);
cairo_pattern_t *   cairo_pattern_create_mesh           (void);
void                cairo_mesh_pattern_begin_patch      (cairo_pattern_t *pattern);
void                cairo_mesh_pattern_end_patch        (cairo_pattern_t *pattern);
void                cairo_mesh_pattern_move_to          (cairo_pattern_t *pattern, double x, double y);
void                cairo_mesh_pattern_line_to          (cairo_pattern_t *pattern, double x, double y);
void                cairo_mesh_pattern_curve_to         (cairo_pattern_t *pattern, double x1, double y1, double x2, double y2, double x3, double y3);
void                cairo_mesh_pattern_set_control_point(cairo_pattern_t *pattern, unsigned int point_num, double x, double y);
void                cairo_mesh_pattern_set_corner_color_rgb(cairo_pattern_t *pattern, unsigned int corner_num, double red, double green, double blue);
void                cairo_mesh_pattern_set_corner_color_rgba(cairo_pattern_t *pattern, unsigned int corner_num, double red, double green, double blue, double alpha);
cairo_status_t      cairo_mesh_pattern_get_patch_count  (cairo_pattern_t *pattern, unsigned int *count);
cairo_path_t *      cairo_mesh_pattern_get_path         (cairo_pattern_t *pattern, unsigned int patch_num);
cairo_status_t      cairo_mesh_pattern_get_control_point(cairo_pattern_t *pattern, unsigned int patch_num, unsigned int point_num, double *x, double *y);
cairo_status_t      cairo_mesh_pattern_get_corner_color_rgba(cairo_pattern_t *pattern, unsigned int patch_num, unsigned int corner_num, double *red, double *green, double *blue, double *alpha);
cairo_pattern_t *   cairo_pattern_reference             (cairo_pattern_t *pattern);
void                cairo_pattern_destroy               (cairo_pattern_t *pattern);
cairo_status_t      cairo_pattern_status                (cairo_pattern_t *pattern);
enum                cairo_extend_t;
void                cairo_pattern_set_extend            (cairo_pattern_t *pattern, cairo_extend_t extend);
cairo_extend_t      cairo_pattern_get_extend            (cairo_pattern_t *pattern);
enum                cairo_filter_t;
void                cairo_pattern_set_filter            (cairo_pattern_t *pattern, cairo_filter_t filter);
cairo_filter_t      cairo_pattern_get_filter            (cairo_pattern_t *pattern);
void                cairo_pattern_set_matrix            (cairo_pattern_t *pattern, const cairo_matrix_t *matrix);
void                cairo_pattern_get_matrix            (cairo_pattern_t *pattern, cairo_matrix_t *matrix);
enum                cairo_pattern_type_t;
cairo_pattern_type_t cairo_pattern_get_type             (cairo_pattern_t *pattern);
unsigned int        cairo_pattern_get_reference_count   (cairo_pattern_t *pattern);
cairo_status_t      cairo_pattern_set_user_data         (cairo_pattern_t *pattern, const cairo_user_data_key_t *key, void *user_data, cairo_destroy_func_t destroy);
void *              cairo_pattern_get_user_data         (cairo_pattern_t *pattern, const cairo_user_data_key_t *key);
                    */

				// PNG Support : http://cairographics.org/manual/cairo-PNG-Support.html
				func($surface, 'cairo_image_surface_create_from_png', [arg($string, 'filename')]),
				func($status, 'cairo_surface_write_to_png', [arg($surface, 'surface'), arg($string, 'filename')]),
			]
		];
	}
}

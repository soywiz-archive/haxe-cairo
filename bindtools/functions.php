<?php

require_once(__DIR__ . '/infrastructure.php');

class CairoFunctions {
	static public function get() {
		$surface = type('cairo_surface_t', 'cairo_surface_destroy');
		$cairo = type('cairo_t', 'cairo_destroy');
		$pattern = type('cairo_pattern_t', 'cairo_pattern_destroy');
		$matrix = type('cairo_matrix_t', 'dummy_free');
		$path = type('cairo_path_t', 'cairo_path_destroy');
		

		$format = enum_type('cairo_format_t');
		$status = enum_type('cairo_status_t');
		$int = prim_prim_type('int', 'int');
		$void = prim_prim_type('void', 'void');
		$string = prim_prim_type('string', 'const char*');

		$double = prim_type(
			'double',
			'double',
			function($v) { return "val_check($v, number);"; },
			function($v) { return "val_get_double($v)"; },
			function($v) { return "alloc_float($v)"; }
		);

		$bytePointer = prim_type(
			'unsigned char*',
			'unsigned char*',
			function($v) { return "{ buffer temp = val_to_buffer($v); if (!temp) hx_failure(\"invalid source buffer\");}"; },
			function($v) { return "(unsigned char*)buffer_data(val_to_buffer($v))"; },
			function($v) { return "-----"; }
		);

		return [
			'abstracts' => [ $surface, $cairo, $pattern, $matrix, $path ],
			'functions' => [
				func($string, 'cairo_version_string', []),

				// Cairo
				func($cairo, 'cairo_create', [arg($surface, 'target')]),
				func($void, 'cairo_save', [arg($cairo, 'cr')]),
				func($void, 'cairo_restore', [arg($cairo, 'cr')]),
				func($void, 'cairo_set_source_rgba', [arg($cairo, 'cr'), arg($double, 'red'), arg($double, 'green'), arg($double, 'blue'), arg($double, 'alpha')]),
				func($void, 'cairo_fill', [arg($cairo, 'cr')]),
				func($void, 'cairo_stroke', [arg($cairo, 'cr')]),
/*
typedef             cairo_t;
cairo_t *           cairo_reference                     (cairo_t *cr);
void                cairo_destroy                       (cairo_t *cr);
cairo_status_t      cairo_status                        (cairo_t *cr);
cairo_surface_t *   cairo_get_target                    (cairo_t *cr);
void                cairo_push_group                    (cairo_t *cr);
void                cairo_push_group_with_content       (cairo_t *cr, cairo_content_t content);
cairo_pattern_t *   cairo_pop_group                     (cairo_t *cr);
void                cairo_pop_group_to_source           (cairo_t *cr);
cairo_surface_t *   cairo_get_group_target              (cairo_t *cr);
void                cairo_set_source_rgb                (cairo_t *cr, double red, double green, double blue);
void                cairo_set_source                    (cairo_t *cr, cairo_pattern_t *source);
void                cairo_set_source_surface            (cairo_t *cr, cairo_surface_t *surface, double x, double y);
cairo_pattern_t *   cairo_get_source                    (cairo_t *cr);
enum                cairo_antialias_t;
void                cairo_set_antialias                 (cairo_t *cr, cairo_antialias_t antialias);
cairo_antialias_t   cairo_get_antialias                 (cairo_t *cr);
void                cairo_set_dash                      (cairo_t *cr, const double *dashes, int num_dashes, double offset);
int                 cairo_get_dash_count                (cairo_t *cr);
void                cairo_get_dash                      (cairo_t *cr, double *dashes, double *offset);
enum                cairo_fill_rule_t;
void                cairo_set_fill_rule                 (cairo_t *cr, cairo_fill_rule_t fill_rule);
cairo_fill_rule_t   cairo_get_fill_rule                 (cairo_t *cr);
enum                cairo_line_cap_t;
void                cairo_set_line_cap                  (cairo_t *cr, cairo_line_cap_t line_cap);
cairo_line_cap_t    cairo_get_line_cap                  (cairo_t *cr);
enum                cairo_line_join_t;
void                cairo_set_line_join                 (cairo_t *cr, cairo_line_join_t line_join);
cairo_line_join_t   cairo_get_line_join                 (cairo_t *cr);
void                cairo_set_line_width                (cairo_t *cr, double width);
double              cairo_get_line_width                (cairo_t *cr);
void                cairo_set_miter_limit               (cairo_t *cr, double limit);
double              cairo_get_miter_limit               (cairo_t *cr);
enum                cairo_operator_t;
void                cairo_set_operator                  (cairo_t *cr, cairo_operator_t op);
cairo_operator_t    cairo_get_operator                  (cairo_t *cr);
void                cairo_set_tolerance                 (cairo_t *cr, double tolerance);
double              cairo_get_tolerance                 (cairo_t *cr);
void                cairo_clip                          (cairo_t *cr);
void                cairo_clip_preserve                 (cairo_t *cr);
void                cairo_clip_extents                  (cairo_t *cr, double *x1, double *y1, double *x2, double *y2);
cairo_bool_t        cairo_in_clip                       (cairo_t *cr, double x, double y);
void                cairo_reset_clip                    (cairo_t *cr);
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
void                cairo_copy_page                     (cairo_t *cr);
void                cairo_show_page                     (cairo_t *cr);
unsigned int        cairo_get_reference_count           (cairo_t *cr);
cairo_status_t      cairo_set_user_data                 (cairo_t *cr, const cairo_user_data_key_t *key, void *user_data, cairo_destroy_func_t destroy);
void *              cairo_get_user_data                 (cairo_t *cr, const cairo_user_data_key_t *key);
*/
				// Surface
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
				func($void, 'cairo_rectangle', [arg($cairo, 'cr'), arg($double, 'x'), arg($double, 'y'), arg($double, 'width'), arg($double, 'height')]),
/*
union               cairo_path_data_t;
enum                cairo_path_data_type_t;
cairo_bool_t        cairo_has_current_point             (cairo_t *cr);
void                cairo_get_current_point             (cairo_t *cr, double *x, double *y);

void                cairo_glyph_path                    (cairo_t *cr, const cairo_glyph_t *glyphs, int num_glyphs);
void                cairo_text_path                     (cairo_t *cr, const char *utf8);
void                cairo_rel_curve_to                  (cairo_t *cr, double dx1, double dy1, double dx2, double dy2, double dx3, double dy3);
void                cairo_rel_line_to                   (cairo_t *cr, double dx, double dy);
void                cairo_rel_move_to                   (cairo_t *cr, double dx, double dy);
void                cairo_path_extents                  (cairo_t *cr, double *x1, double *y1, double *x2, double *y2);
*/

				// void cairo_user_to_device                (cairo_t *cr, double *x, double *y);
				// void cairo_user_to_device_distance       (cairo_t *cr, double *dx, double *dy);
				// void cairo_device_to_user                (cairo_t *cr, double *x, double *y);
				// void cairo_device_to_user_distance       (cairo_t *cr, double *dx, double *dy);

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

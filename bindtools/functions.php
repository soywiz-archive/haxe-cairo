<?php

require_once(__DIR__ . '/infrastructure.php');

class CairoFunctions {
	static public function get() {
		$surface = type('cairo_surface_t', 'cairo_surface_destroy');
		$cairo = type('cairo_t', 'cairo_destroy');
		$pattern = type('cairo_pattern_t', 'cairo_pattern_destroy');
		$matrix = type('cairo_matrix_t', 'cairo_matrix_destroy');
		$path = type('cairo_path_t', 'cairo_path_destroy');
		$region = type('cairo_region_t', 'cairo_region_destroy');
		$fontoptions = type('cairo_font_options_t', 'cairo_font_options_destroy');
		

		$format = enum_type('cairo_format_t');
		$status = enum_type('cairo_status_t');
		$antialias = enum_type('cairo_antialias_t');
		$operator = enum_type('cairo_operator_t');
		$fillrule = enum_type('cairo_fill_rule_t');
		$content = enum_type('cairo_content_t');
		$linecap = enum_type('cairo_line_cap_t');
		$linejoin = enum_type('cairo_line_join_t');
		$filter = enum_type('cairo_filter_t');
		$extend = enum_type('cairo_extend_t');
		$patterntype = enum_type('cairo_pattern_type_t');
		$fontweight = enum_type('cairo_font_weight_t');
		$fontslant = enum_type('cairo_font_slant_t');
		$regionoverlap = enum_type('cairo_region_overlap_t');
		$subpixelorder = enum_type('cairo_subpixel_order_t');
		$hintstyle = enum_type('cairo_hint_style_t');
		$hintmetrics = enum_type('cairo_hint_metrics_t');
		$svgversion = enum_type('cairo_svg_version_t');


		$int = prim_prim_type('int', 'int');
		$bool = prim_prim_type('bool', 'bool');
		$void = prim_prim_type('void', 'void');
		$string = prim_prim_type('string', 'const char*');

		$cairo_read_stream = prim_type(
			'--',
			'--',
			function($v) { return ""; },
			function($v) { return ""; },
			function($v) { return "cairo_read_stream"; },
			function($v) { return ""; }
		);

		$cairo_write_stream = prim_type(
			'--',
			'--',
			function($v) { return ""; },
			function($v) { return ""; },
			function($v) { return "cairo_write_stream"; },
			function($v) { return ""; }
		);

		$value = prim_type(
			'value',
			'value',
			function($v) { return "value* root_{$v} = alloc_root(); *root_{$v} = {$v};"; },
			function($v) { return "free_root(root_{$v});"; },
			function($v) { return "(void*)$v"; },
			function($v) { return "$v"; }
		);

		//func($int, 'cairo_get_dash', [arg($cairo, 'cr'), arg($doubleVector, 'dashes'), arg($doubleRef, 'offset')]),

		$doublePtr = ptr_type('double', 'val_number', 'alloc_float');
		$intPtr = ptr_type('int', 'val_int', 'alloc_int');

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

		$rectangleIntRef = prim_type(
			'unsigned char*',
			'unsigned char*',
			function($v) { return "
				val_check({$v}, object);
				int field_x = val_id(\"x\");
				int field_y = val_id(\"y\");
				int field_width = val_id(\"width\");
				int field_height = val_id(\"height\");
				cairo_rectangle_int_t rect_{$v} = { 0 };
				rect_{$v}.x = val_number(val_field({$v}, field_x));
				rect_{$v}.y = val_number(val_field({$v}, field_y));
				rect_{$v}.width = val_number(val_field({$v}, field_width));
				rect_{$v}.height = val_number(val_field({$v}, field_height));
				";
			},
			function($v) { return "
				alloc_field($v, field_x, alloc_int(rect_{$v}.x));
				alloc_field($v, field_y, alloc_int(rect_{$v}.y));
				alloc_field($v, field_width, alloc_int(rect_{$v}.width));
				alloc_field($v, field_height, alloc_int(rect_{$v}.height));
			"; },
			function($v) { return "&rect_{$v}"; },
			function($v) { return "-----"; }
		);

		return [
			'abstracts' => [ $surface, $cairo, $pattern, $matrix, $path, $region, $fontoptions ],
			'functions' => [
				func($int, 'cairo_version', []),
				func($string, 'cairo_version_string', []),
				func($string, 'cairo_status_to_string', [arg($status, 'status')]),
				func($void, 'cairo_debug_reset_static_data', []),

				// Cairo
				func($cairo, 'cairo_create', [arg($surface, 'target')]),
				//func($cairo, 'cairo_reference', [arg($cairo, 'cr')]), // not required 
				//func($cairo, 'cairo_destroy', [arg($cairo, 'cr')]), // not required 
				//func($int, 'cairo_get_reference_count', [arg($cairo, 'cr')]), // not required 
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

				func($void, 'cairo_fill_preserve', [arg($cairo, 'cr')]),
				func($void, 'cairo_fill_extents', [arg($cairo, 'cr'), arg($pointRef, 'p1'), arg($pointRef, 'p2')]),
				func($bool, 'cairo_in_fill', [arg($cairo, 'cr'), arg($double, 'x'), arg($double, 'y')]),

				func($void, 'cairo_stroke_preserve', [arg($cairo, 'cr')]),
				func($void, 'cairo_stroke_extents', [arg($cairo, 'cr'), arg($pointRef, 'p1'), arg($pointRef, 'p2')]),
				func($bool, 'cairo_in_stroke', [arg($cairo, 'cr'), arg($double, 'x'), arg($double, 'y')]),

				func($void, 'cairo_mask', [arg($cairo, 'cr'), arg($pattern, 'value')]),
				func($void, 'cairo_mask_surface', [arg($cairo, 'cr'), arg($surface, 'surface'), arg($double, 'x'), arg($double, 'y')]),
				func($void, 'cairo_paint', [arg($cairo, 'cr')]),
				func($void, 'cairo_paint_with_alpha', [arg($cairo, 'cr'), arg($double, 'alpha')]),

				func($int, 'cairo_get_dash_count', [arg($cairo, 'cr')]),
				func($void, 'cairo_set_dash', [arg($cairo, 'cr'), arg($doublePtr, 'dashes'), arg($int, 'num_dashes'), arg($double, 'offset')]),
				func($void, 'cairo_get_dash', [arg($cairo, 'cr'), arg($doublePtr, 'dashes'), arg($doublePtr, 'offset')]),

				//func($void, 'cairo_set_user_data', [...]), // not required
				//func($void, 'cairo_get_user_data', [...]), // not required

/*
cairo_rectangle_t;
cairo_rectangle_list_t;
void                cairo_rectangle_list_destroy        (cairo_rectangle_list_t *rectangle_list);
cairo_rectangle_list_t * cairo_copy_clip_rectangle_list (cairo_t *cr);

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
				// http://cairographics.org/manual/cairo-cairo-surface-t.html
				func($surface, 'cairo_image_surface_create', [arg($format, 'format'), arg($int, 'width'), arg($int, 'height')]),
				func($surface, 'cairo_image_surface_create_for_data', [arg($bytePointer, 'data'), arg($format, 'format'), arg($int, 'width'), arg($int, 'height'), arg($int, 'stride')]),
				func($format, 'cairo_image_surface_get_format', [arg($surface, 'surface')]),
				func($int, 'cairo_image_surface_get_width', [arg($surface, 'surface')]),
				func($int, 'cairo_image_surface_get_height', [arg($surface, 'surface')]),
				func($int, 'cairo_image_surface_get_stride', [arg($surface, 'surface')]),

				//func($void, 'cairo_surface_destroy', [arg($surface, 'surface')]), // no used
				func($void, 'cairo_surface_finish', [arg($surface, 'surface')]),
				func($void, 'cairo_surface_flush', [arg($surface, 'surface')]),

				func($surface, 'cairo_surface_create_similar', [arg($surface, 'other'), arg($content, 'content'), arg($int, 'width'), arg($int, 'height')]),
				func($surface, 'cairo_surface_create_similar_image', [arg($surface, 'other'), arg($format, 'format'), arg($int, 'width'), arg($int, 'height')]),
				func($surface, 'cairo_surface_create_for_rectangle', [arg($surface, 'target'), arg($double, 'x'), arg($double, 'y'), arg($double, 'width'), arg($double, 'height')]),
				func($status, 'cairo_surface_status', [arg($surface, 'surface')]),
				func($void, 'cairo_surface_copy_page', [arg($surface, 'surface')]),
				func($void, 'cairo_surface_show_page', [arg($surface, 'surface')]),
				func($value, 'cairo_image_surface_get_data2', [arg($surface, 'surface')]),
				func($void, 'cairo_image_surface_set_data2', [arg($surface, 'surface'), arg($value, 'vv')]),

				func($content, 'cairo_surface_get_content', [arg($surface, 'surface')]),
				func($void, 'cairo_surface_mark_dirty', [arg($surface, 'surface')]),
				func($void, 'cairo_surface_mark_dirty_rectangle', [arg($surface, 'surface'), arg($int, 'x'), arg($int, 'y'), arg($int, 'width'), arg($int, 'height')]),
				//func($surfacetype, 'cairo_surface_get_type', [arg($surface, 'surface')]), // cairo_surface_type_t

				//cairo_surface_t *   cairo_surface_reference             (cairo_surface_t *surface);
				//unsigned int        cairo_surface_get_reference_count   (cairo_surface_t *surface);
				//void                cairo_surface_destroy               (cairo_surface_t *surface);
				//cairo_status_t      cairo_surface_set_user_data         (cairo_surface_t *surface, const cairo_user_data_key_t *key, void *user_data, cairo_destroy_func_t destroy);
				//void *              cairo_surface_get_user_data         (cairo_surface_t *surface, const cairo_user_data_key_t *key);

				/*
unsigned char *     cairo_image_surface_get_data        (cairo_surface_t *surface);

cairo_device_t *    cairo_surface_get_device            (cairo_surface_t *surface);
void                cairo_surface_get_font_options      (cairo_surface_t *surface, cairo_font_options_t *options);
void                cairo_surface_set_device_offset     (cairo_surface_t *surface, double x_offset, double y_offset);
void                cairo_surface_get_device_offset     (cairo_surface_t *surface, double *x_offset, double *y_offset);
void                cairo_surface_set_fallback_resolution(cairo_surface_t *surface, double x_pixels_per_inch, double y_pixels_per_inch);
void                cairo_surface_get_fallback_resolution(cairo_surface_t *surface, double *x_pixels_per_inch, double *y_pixels_per_inch);
enum                cairo_surface_type_t;
cairo_bool_t        cairo_surface_has_show_text_glyphs  (cairo_surface_t *surface);
cairo_status_t      cairo_surface_set_mime_data         (cairo_surface_t *surface, const char *mime_type, const unsigned char *data, unsigned long  length, cairo_destroy_func_t destroy, void *closure);
void                cairo_surface_get_mime_data         (cairo_surface_t *surface, const char *mime_type, const unsigned char **data, unsigned long *length);
cairo_bool_t        cairo_surface_supports_mime_type    (cairo_surface_t *surface, const char *mime_type);
cairo_surface_t *   cairo_surface_map_to_image          (cairo_surface_t *surface, const cairo_rectangle_int_t *extents);
void                cairo_surface_unmap_image           (cairo_surface_t *surface, cairo_surface_t *image);
				 */
				
				// Transformations: http://cairographics.org/manual/cairo-Transformations.html
				func($void, 'cairo_translate', [arg($cairo, 'cr'), arg($double, 'tx'), arg($double, 'ty')]),
				func($void, 'cairo_scale', [arg($cairo, 'cr'), arg($double, 'sx'), arg($double, 'sy')]),
				func($void, 'cairo_rotate', [arg($cairo, 'cr'), arg($double, 'angle')]),
				func($void, 'cairo_transform', [arg($cairo, 'cr'), arg($matrix, 'matrix')]),
				func($void, 'cairo_set_matrix', [arg($cairo, 'cr'), arg($matrix, 'matrix')]),
				func($void, 'cairo_get_matrix', [arg($cairo, 'cr'), arg($matrix, 'matrix')]),
				func($void, 'cairo_identity_matrix', [arg($cairo, 'cr')]),
				func($void, 'cairo_user_to_device', [arg($cairo, 'cr'), arg($pointRef, 'point')]),
				func($void, 'cairo_user_to_device_distance', [arg($cairo, 'cr'), arg($pointRef, 'point')]),
				func($void, 'cairo_device_to_user', [arg($cairo, 'cr'), arg($pointRef, 'point')]),
				func($void, 'cairo_device_to_user_distance', [arg($cairo, 'cr'), arg($pointRef, 'point')]),

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
				func($void, 'cairo_text_path', [arg($cairo, 'cr'), arg($string, 'utf8')]),

/*
void                cairo_glyph_path                    (cairo_t *cr, const cairo_glyph_t *glyphs, int num_glyphs);
*/

				// Regions: http://cairographics.org/manual/cairo-Regions.html
				func($region, 'cairo_region_create', []),
				//func($region, 'cairo_region_create_rectangle', [arg($rectangle, 'rectangle')]), // unused
				//func($region, 'cairo_region_create_rectangles', [arg($rectangle, 'rectangle')]), // unused
				//func($region, 'cairo_region_reference', [arg($region, 'region')]), // unused
				//func($void, 'cairo_region_destroy', [arg($region, 'region')]), // unused
				func($region, 'cairo_region_copy', [arg($region, 'region')]),
				func($status, 'cairo_region_status', [arg($region, 'region')]),
				func($bool, 'cairo_region_is_empty', [arg($region, 'region')]),
				func($bool, 'cairo_region_contains_point', [arg($region, 'region'), arg($int, 'x'), arg($int, 'y')]),
				func($bool, 'cairo_region_equal', [arg($region, 'a'), arg($region, 'b')]),
				func($void, 'cairo_region_translate', [arg($region, 'region'), arg($int, 'dx'), arg($int, 'dy')]),
				func($int, 'cairo_region_num_rectangles', [arg($region, 'region')]),

				func($status, 'cairo_region_intersect', [arg($region, 'dst'), arg($region, 'other')]),
				func($status, 'cairo_region_subtract', [arg($region, 'dst'), arg($region, 'other')]),
				func($status, 'cairo_region_union', [arg($region, 'dst'), arg($region, 'other')]),
				func($status, 'cairo_region_xor', [arg($region, 'dst'), arg($region, 'other')]),
				func($status, 'cairo_region_union_rectangle', [arg($region, 'dst'), arg($rectangleIntRef, 'rectangle')]),
				func($status, 'cairo_region_intersect_rectangle', [arg($region, 'dst'), arg($rectangleIntRef, 'rectangle')]),
				func($status, 'cairo_region_subtract_rectangle', [arg($region, 'dst'), arg($rectangleIntRef, 'rectangle')]),
				func($status, 'cairo_region_xor_rectangle', [arg($region, 'dst'), arg($rectangleIntRef, 'rectangle')]),

				func($regionoverlap, 'cairo_region_contains_rectangle', [arg($region, 'region'), arg($rectangleIntRef, 'rectangle')]),
				func($void, 'cairo_region_get_extents', [arg($region, 'region'), arg($rectangleIntRef, 'extents')]),
				func($void, 'cairo_region_get_rectangle', [arg($region, 'region'), arg($int, 'nth'), arg($rectangleIntRef, 'rectangle')]),

				// Text: http://cairographics.org/manual/cairo-text.html
				func($void, 'cairo_select_font_face', [arg($cairo, 'cr'), arg($string, 'family'), arg($fontslant, 'slant'), arg($fontweight, 'weight')]),
				func($void, 'cairo_set_font_size', [arg($cairo, 'cr'), arg($double, 'size')]),
				func($void, 'cairo_show_text', [arg($cairo, 'cr'), arg($string, 'text')]),
				func($void, 'cairo_set_font_matrix', [arg($cairo, 'cr'), arg($matrix, 'matrix')]),
				func($void, 'cairo_get_font_matrix', [arg($cairo, 'cr'), arg($matrix, 'matrix')]),

				func($void, 'cairo_set_font_options', [arg($cairo, 'cr'), arg($fontoptions, 'options')]),
				func($void, 'cairo_get_font_options', [arg($cairo, 'cr'), arg($fontoptions, 'options')]),
/*
void                cairo_set_font_face                 (cairo_t *cr, cairo_font_face_t *font_face);
cairo_font_face_t * cairo_get_font_face                 (cairo_t *cr);
void                cairo_set_scaled_font               (cairo_t *cr, const cairo_scaled_font_t *scaled_font);
cairo_scaled_font_t * cairo_get_scaled_font             (cairo_t *cr);
void                cairo_show_glyphs                   (cairo_t *cr, const cairo_glyph_t *glyphs, int num_glyphs);
void                cairo_show_text_glyphs              (cairo_t *cr, const char *utf8, int utf8_len, const cairo_glyph_t *glyphs, int num_glyphs, const cairo_text_cluster_t *clusters, int num_clusters, cairo_text_cluster_flags_t cluster_flags);
void                cairo_font_extents                  (cairo_t *cr, cairo_font_extents_t *extents);
void                cairo_text_extents                  (cairo_t *cr, const char *utf8, cairo_text_extents_t *extents);
void                cairo_glyph_extents                 (cairo_t *cr, const cairo_glyph_t *glyphs, int num_glyphs, cairo_text_extents_t *extents);
cairo_font_face_t * cairo_toy_font_face_create          (const char *family, cairo_font_slant_t slant, cairo_font_weight_t weight);
const char *        cairo_toy_font_face_get_family      (cairo_font_face_t *font_face);
cairo_font_slant_t  cairo_toy_font_face_get_slant       (cairo_font_face_t *font_face);
cairo_font_weight_t cairo_toy_font_face_get_weight      (cairo_font_face_t *font_face);
cairo_glyph_t *     cairo_glyph_allocate                (int num_glyphs);
void                cairo_glyph_free                    (cairo_glyph_t *glyphs);
cairo_text_cluster_t * cairo_text_cluster_allocate      (int num_clusters);
void                cairo_text_cluster_free             (cairo_text_cluster_t *clusters);
*/
				// FontOptions: http://cairographics.org/manual/cairo-cairo-font-options-t.html
				func($fontoptions, 'cairo_font_options_create', []),
				func($fontoptions, 'cairo_font_options_copy', [arg($fontoptions, 'original')]),
				func($status, 'cairo_font_options_status', [arg($fontoptions, 'options')]),
				func($void, 'cairo_font_options_merge', [arg($fontoptions, 'options'), arg($fontoptions, 'other')]),
				func($int, 'cairo_font_options_hash', [arg($fontoptions, 'options')]),
				func($bool, 'cairo_font_options_equal', [arg($fontoptions, 'a'), arg($fontoptions, 'b')]),
				func($void, 'cairo_font_options_set_antialias', [arg($fontoptions, 'options'), arg($antialias, 'antialias')]),
				func($void, 'cairo_font_options_set_subpixel_order', [arg($fontoptions, 'options'), arg($subpixelorder, 'subpixel_order')]),
				func($void, 'cairo_font_options_set_hint_style', [arg($fontoptions, 'options'), arg($hintstyle, 'hintstyle')]),
				func($void, 'cairo_font_options_set_hint_metrics', [arg($fontoptions, 'options'), arg($hintmetrics, 'hintmetrics')]),

				func($antialias, 'cairo_font_options_get_antialias', [arg($fontoptions, 'options')]),
				func($subpixelorder, 'cairo_font_options_get_subpixel_order', [arg($fontoptions, 'options')]),
				func($hintstyle, 'cairo_font_options_get_hint_style', [arg($fontoptions, 'options')]),
				func($hintmetrics, 'cairo_font_options_get_hint_metrics', [arg($fontoptions, 'options')]),

				// Patterns: http://cairographics.org/manual/cairo-cairo-pattern-t.html
				func($pattern, 'cairo_pattern_create_rgba', [arg($double, 'red'), arg($double, 'green'), arg($double, 'blue'), arg($double, 'alpha')]),
				func($pattern, 'cairo_pattern_create_rgb', [arg($double, 'red'), arg($double, 'green'), arg($double, 'blue')]),
				func($pattern, 'cairo_pattern_create_for_surface', [arg($surface, 'surface')]),
				func($pattern, 'cairo_pattern_create_mesh', []),
				func($pattern, 'cairo_pattern_create_linear', [arg($double, 'x0'), arg($double, 'y0'), arg($double, 'x1'), arg($double, 'y2')]),
				func($pattern, 'cairo_pattern_create_radial', [arg($double, 'cx0'), arg($double, 'cy0'), arg($double, 'radius0'), arg($double, 'cx1'), arg($double, 'cy2'), arg($double, 'radius1')]),
				func($void, 'cairo_pattern_set_filter', [arg($pattern, 'pattern'), arg($filter, 'filter')]),
				func($filter, 'cairo_pattern_get_filter', [arg($pattern, 'pattern')]),
				//func($pattern, 'cairo_pattern_reference', [arg($pattern, 'pattern')]), // no used
				//func($pattern, 'cairo_pattern_get_reference_count', [arg($pattern, 'pattern')]), // no used
				//func($void, 'cairo_pattern_destroy', [arg($pattern, 'pattern')]), // no used
				//func($void, 'cairo_pattern_set_user_data', [...]), // no used
				//func($void, 'cairo_pattern_get_user_data', [...]), // no used


				func($void, 'cairo_pattern_add_color_stop_rgb', [arg($pattern, 'pattern'), arg($double, 'offset'), arg($double, 'r'), arg($double, 'g'), arg($double, 'b')]),
				func($void, 'cairo_pattern_add_color_stop_rgba', [arg($pattern, 'pattern'), arg($double, 'offset'), arg($double, 'r'), arg($double, 'g'), arg($double, 'b'), arg($double, 'a')]),

				func($void, 'cairo_pattern_set_extend', [arg($pattern, 'pattern'), arg($extend, 'v')]),
				func($extend, 'cairo_pattern_get_extend', [arg($pattern, 'pattern')]),

				func($patterntype, 'cairo_pattern_get_type', [arg($pattern, 'pattern')]),
				func($status, 'cairo_pattern_status', [arg($pattern, 'pattern')]),

				func($void, 'cairo_mesh_pattern_begin_patch', [arg($pattern, 'pattern')]),
				func($void, 'cairo_mesh_pattern_end_patch', [arg($pattern, 'pattern')]),
				func($void, 'cairo_mesh_pattern_move_to', [arg($pattern, 'pattern'), arg($double, 'x'), arg($double, 'y')]),
				func($void, 'cairo_mesh_pattern_line_to', [arg($pattern, 'pattern'), arg($double, 'x'), arg($double, 'y')]),
				func($void, 'cairo_mesh_pattern_curve_to', [arg($pattern, 'pattern'), arg($double, 'x1'), arg($double, 'y1'), arg($double, 'x2'), arg($double, 'y2'), arg($double, 'x3'), arg($double, 'y3')]),
				func($void, 'cairo_mesh_pattern_set_control_point', [arg($pattern, 'pattern'), arg($int, 'point_num'), arg($double, 'x'), arg($double, 'y')]),
				func($void, 'cairo_mesh_pattern_set_corner_color_rgb', [arg($pattern, 'pattern'), arg($int, 'corner_num'), arg($double, 'r'), arg($double, 'g'), arg($double, 'b')]),
				func($void, 'cairo_mesh_pattern_set_corner_color_rgba', [arg($pattern, 'pattern'), arg($int, 'corner_num'), arg($double, 'r'), arg($double, 'g'), arg($double, 'b'), arg($double, 'a')]),

				func($void, 'cairo_pattern_set_matrix', [arg($pattern, 'pattern'), arg($matrix, 'matrix')]),
				func($void, 'cairo_pattern_get_matrix', [arg($pattern, 'pattern'), arg($matrix, 'matrix')]),

				func($status, 'cairo_pattern_get_color_stop_count', [arg($pattern, 'pattern'), arg($intPtr, 'countPtr')]),
				func($status, 'cairo_pattern_get_color_stop_rgba', [arg($pattern, 'pattern'), arg($int, 'index'), arg($doublePtr, 'offset'), arg($doublePtr, 'red'), arg($doublePtr, 'green'), arg($doublePtr, 'blue'), arg($doublePtr, 'alpha')]),
				func($status, 'cairo_pattern_get_rgba', [arg($pattern, 'pattern'), arg($doublePtr, 'red'), arg($doublePtr, 'green'), arg($doublePtr, 'blue'), arg($doublePtr, 'alpha')]),

				func($status, 'cairo_pattern_get_linear_points', [arg($pattern, 'pattern'), arg($doublePtr, 'x0'), arg($doublePtr, 'y0'), arg($doublePtr, 'x1'), arg($doublePtr, 'y1')]),
				func($status, 'cairo_pattern_get_radial_circles', [arg($pattern, 'pattern'), arg($doublePtr, 'x0'), arg($doublePtr, 'y0'), arg($doublePtr, 'r0'), arg($doublePtr, 'x1'), arg($doublePtr, 'y1'), arg($doublePtr, 'r1')]),

				/*
cairo_status_t      cairo_pattern_get_surface           (cairo_pattern_t *pattern, cairo_surface_t **surface);

cairo_status_t      cairo_mesh_pattern_get_patch_count  (cairo_pattern_t *pattern, unsigned int *count);
cairo_path_t *      cairo_mesh_pattern_get_path         (cairo_pattern_t *pattern, unsigned int patch_num);
cairo_status_t      cairo_mesh_pattern_get_control_point(cairo_pattern_t *pattern, unsigned int patch_num, unsigned int point_num, double *x, double *y);
cairo_status_t      cairo_mesh_pattern_get_corner_color_rgba(cairo_pattern_t *pattern, unsigned int patch_num, unsigned int corner_num, double *red, double *green, double *blue, double *alpha);
                    */

				// PNG Support : http://cairographics.org/manual/cairo-PNG-Support.html
				func($surface, 'cairo_image_surface_create_from_png', [arg($string, 'filename')]),
				func($surface, 'cairo_image_surface_create_from_png_stream', [arg($cairo_read_stream, '__'), arg($value, 'reader')]),
				func($status, 'cairo_surface_write_to_png', [arg($surface, 'surface'), arg($string, 'filename')]),
				func($status, 'cairo_surface_write_to_png_stream', [arg($surface, 'surface'), arg($cairo_write_stream, '__'), arg($value, 'writer')]),

				// SVG Support: http://cairographics.org/manual/cairo-SVG-Surfaces.html
				func($surface, 'cairo_svg_surface_create', [arg($string, 'filename'), arg($double, 'width_in_points'), arg($double, 'height_in_points')]),
				func($surface, 'cairo_svg_surface_create_for_stream', [arg($cairo_write_stream, '__'), arg($value, 'writer'), arg($double, 'width_in_points'), arg($double, 'height_in_points')]),
				func($void, 'cairo_svg_surface_restrict_to_version', [arg($surface, 'surface'), arg($svgversion, 'version')]),
				func($string, 'cairo_svg_version_to_string', [arg($svgversion, 'version')]),

/*
void                cairo_svg_get_versions              (cairo_svg_version_t const **versions, int *num_versions);
*/

				// PDF Support: http://cairographics.org/manual/cairo-PDF-Surfaces.html
				func($surface, 'cairo_pdf_surface_create', [arg($string, 'filename'), arg($double, 'width'), arg($double, 'height')]),
/*
cairo_surface_t *   cairo_pdf_surface_create            (const char *filename, double width_in_points, double height_in_points);
cairo_surface_t *   cairo_pdf_surface_create_for_stream (cairo_write_func_t write_func, void *closure, double width_in_points, double height_in_points);
void                cairo_pdf_surface_restrict_to_version(cairo_surface_t *surface, cairo_pdf_version_t version);
enum                cairo_pdf_version_t;
void                cairo_pdf_get_versions              (cairo_pdf_version_t const **versions, int *num_versions);
const char *        cairo_pdf_version_to_string         (cairo_pdf_version_t version);
void                cairo_pdf_surface_set_size          (cairo_surface_t *surface, double width_in_points, double height_in_points);
*/
			]
		];
	}
}

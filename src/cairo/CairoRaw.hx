package cairo;

#if neko
import neko.Lib;
#else
import cpp.Lib;
#end

class CairoRaw {
	static private inline function load(name:String, count:Int) return Lib.load('cairo', name, count);

	#if neko
	static private var laoded = hxcpp.NekoInit.nekoInit("cairo");
	#end

		static public var cairo_version_string = load('hx_cairo_version_string', 0);
		static public var cairo_create = load('hx_cairo_create', 1);
		static public var cairo_save = load('hx_cairo_save', 1);
		static public var cairo_restore = load('hx_cairo_restore', 1);
		static public var cairo_set_source = load('hx_cairo_set_source', 2);
		static public var cairo_set_source_rgb = load('hx_cairo_set_source_rgb', 4);
		static public var cairo_set_source_rgba = load('hx_cairo_set_source_rgba', 5);
		static public var cairo_set_source_surface = load('hx_cairo_set_source_surface', 4);
		static public var cairo_get_source = load('hx_cairo_get_source', 1);
		static public var cairo_fill = load('hx_cairo_fill', 1);
		static public var cairo_stroke = load('hx_cairo_stroke', 1);
		static public var cairo_status = load('hx_cairo_status', 1);
		static public var cairo_get_target = load('hx_cairo_get_target', 1);
		static public var cairo_set_antialias = load('hx_cairo_set_antialias', 2);
		static public var cairo_get_antialias = load('hx_cairo_get_antialias', 1);
		static public var cairo_set_fill_rule = load('hx_cairo_set_fill_rule', 2);
		static public var cairo_get_fill_rule = load('hx_cairo_get_fill_rule', 1);
		static public var cairo_set_line_cap = load('hx_cairo_set_line_cap', 2);
		static public var cairo_get_line_cap = load('hx_cairo_get_line_cap', 1);
		static public var cairo_set_line_join = load('hx_cairo_set_line_join', 2);
		static public var cairo_get_line_join = load('hx_cairo_get_line_join', 1);
		static public var cairo_set_line_width = load('hx_cairo_set_line_width', 2);
		static public var cairo_set_miter_limit = load('hx_cairo_set_miter_limit', 2);
		static public var cairo_set_tolerance = load('hx_cairo_set_tolerance', 2);
		static public var cairo_get_line_width = load('hx_cairo_get_line_width', 1);
		static public var cairo_get_miter_limit = load('hx_cairo_get_miter_limit', 1);
		static public var cairo_get_tolerance = load('hx_cairo_get_tolerance', 1);
		static public var cairo_set_operator = load('hx_cairo_set_operator', 2);
		static public var cairo_get_operator = load('hx_cairo_get_operator', 1);
		static public var cairo_copy_page = load('hx_cairo_copy_page', 1);
		static public var cairo_show_page = load('hx_cairo_show_page', 1);
		static public var cairo_push_group = load('hx_cairo_push_group', 1);
		static public var cairo_push_group_with_content = load('hx_cairo_push_group_with_content', 2);
		static public var cairo_pop_group = load('hx_cairo_pop_group', 1);
		static public var cairo_pop_group_to_source = load('hx_cairo_pop_group_to_source', 1);
		static public var cairo_get_group_target = load('hx_cairo_get_group_target', 1);
		static public var cairo_clip_extents = load('hx_cairo_clip_extents', 3);
		static public var cairo_clip = load('hx_cairo_clip', 1);
		static public var cairo_clip_preserve = load('hx_cairo_clip_preserve', 1);
		static public var cairo_in_clip = load('hx_cairo_in_clip', 3);
		static public var cairo_reset_clip = load('hx_cairo_reset_clip', 1);
		static public var cairo_matrix_create = load('hx_cairo_matrix_create', 0);
		static public var cairo_matrix_init = load('hx_cairo_matrix_init', 7);
		static public var cairo_matrix_init_identity = load('hx_cairo_matrix_init_identity', 1);
		static public var cairo_matrix_init_translate = load('hx_cairo_matrix_init_translate', 3);
		static public var cairo_matrix_init_scale = load('hx_cairo_matrix_init_scale', 3);
		static public var cairo_matrix_init_rotate = load('hx_cairo_matrix_init_rotate', 2);
		static public var cairo_matrix_translate = load('hx_cairo_matrix_translate', 3);
		static public var cairo_matrix_scale = load('hx_cairo_matrix_scale', 3);
		static public var cairo_matrix_rotate = load('hx_cairo_matrix_rotate', 2);
		static public var cairo_matrix_invert = load('hx_cairo_matrix_invert', 1);
		static public var cairo_matrix_multiply = load('hx_cairo_matrix_multiply', 3);
		static public var cairo_matrix_transform_distance = load('hx_cairo_matrix_transform_distance', 2);
		static public var cairo_matrix_transform_point = load('hx_cairo_matrix_transform_point', 2);
		static public var cairo_image_surface_create = load('hx_cairo_image_surface_create', 3);
		static public var cairo_image_surface_create_for_data = load('hx_cairo_image_surface_create_for_data', 5);
		static public var cairo_image_surface_get_format = load('hx_cairo_image_surface_get_format', 1);
		static public var cairo_image_surface_get_width = load('hx_cairo_image_surface_get_width', 1);
		static public var cairo_image_surface_get_height = load('hx_cairo_image_surface_get_height', 1);
		static public var cairo_image_surface_get_stride = load('hx_cairo_image_surface_get_stride', 1);
		static public var cairo_translate = load('hx_cairo_translate', 3);
		static public var cairo_scale = load('hx_cairo_scale', 3);
		static public var cairo_rotate = load('hx_cairo_rotate', 2);
		static public var cairo_transform = load('hx_cairo_transform', 2);
		static public var cairo_set_matrix = load('hx_cairo_set_matrix', 2);
		static public var cairo_get_matrix = load('hx_cairo_get_matrix', 2);
		static public var cairo_identity_matrix = load('hx_cairo_identity_matrix', 1);
		static public var cairo_copy_path = load('hx_cairo_copy_path', 1);
		static public var cairo_copy_path_flat = load('hx_cairo_copy_path_flat', 1);
		static public var cairo_append_path = load('hx_cairo_append_path', 2);
		static public var cairo_line_to = load('hx_cairo_line_to', 3);
		static public var cairo_move_to = load('hx_cairo_move_to', 3);
		static public var cairo_new_path = load('hx_cairo_new_path', 1);
		static public var cairo_new_sub_path = load('hx_cairo_new_sub_path', 1);
		static public var cairo_close_path = load('hx_cairo_close_path', 1);
		static public var cairo_arc = load('hx_cairo_arc', 6);
		static public var cairo_arc_negative = load('hx_cairo_arc_negative', 6);
		static public var cairo_curve_to = load('hx_cairo_curve_to', 7);
		static public var cairo_rectangle = load('hx_cairo_rectangle', 5);
		static public var cairo_has_current_point = load('hx_cairo_has_current_point', 1);
		static public var cairo_get_current_point = load('hx_cairo_get_current_point', 2);
		static public var cairo_pattern_create_rgba = load('hx_cairo_pattern_create_rgba', 4);
		static public var cairo_image_surface_create_from_png = load('hx_cairo_image_surface_create_from_png', 1);
		static public var cairo_surface_write_to_png = load('hx_cairo_surface_write_to_png', 2);
	}

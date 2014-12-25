package cairo;

#if neko
import neko.Lib;
#else
import cpp.Lib;
#end

class CairoRaw {
	static private inline function load(name:String, count:Int) return Lib.load('cairo', name, count);

	static private var laoded = hxcpp.NekoInit.nekoInit("cairo");

		static public var cairo_version_string = load('hx_cairo_version_string', 0);
		static public var cairo_create = load('hx_cairo_create', 1);
		static public var cairo_save = load('hx_cairo_save', 1);
		static public var cairo_restore = load('hx_cairo_restore', 1);
		static public var cairo_set_source_rgba = load('hx_cairo_set_source_rgba', 5);
		static public var cairo_fill = load('hx_cairo_fill', 1);
		static public var cairo_stroke = load('hx_cairo_stroke', 1);
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
		static public var cairo_pattern_create_rgba = load('hx_cairo_pattern_create_rgba', 4);
		static public var cairo_image_surface_create_from_png = load('hx_cairo_image_surface_create_from_png', 1);
		static public var cairo_surface_write_to_png = load('hx_cairo_surface_write_to_png', 2);
	}

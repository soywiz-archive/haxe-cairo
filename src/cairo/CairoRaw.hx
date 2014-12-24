package cairo;

#if neko
import neko.Lib;
#else
import cpp.Lib;
#end

class CairoRaw {
	static private inline function load(name:String, count:Int) return Lib.load('cairo', name, count);


		static public var hx_cairo_version_string = load('hx_cairo_version_string', 0);
		static public var hx_cairo_image_surface_create = load('hx_cairo_image_surface_create', 3);
		static public var hx_cairo_image_surface_create_for_data = load('hx_cairo_image_surface_create_for_data', 5);
		static public var hx_cairo_image_surface_create_from_png = load('hx_cairo_image_surface_create_from_png', 1);
		static public var hx_cairo_surface_write_to_png = load('hx_cairo_surface_write_to_png', 2);
		static public var hx_cairo_image_surface_get_format = load('hx_cairo_image_surface_get_format', 1);
		static public var hx_cairo_image_surface_get_width = load('hx_cairo_image_surface_get_width', 1);
		static public var hx_cairo_image_surface_get_height = load('hx_cairo_image_surface_get_height', 1);
		static public var hx_cairo_image_surface_get_stride = load('hx_cairo_image_surface_get_stride', 1);
	}

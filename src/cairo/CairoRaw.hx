package cairo;

class CairoRaw {
	static private inline var ndll = 'cairo';
	static public var hx_cairo_image_surface_create = neko.Lib.load(ndll, 'hx_cairo_image_surface_create', 3);
	static public var hx_cairo_surface_write_to_png = neko.Lib.load(ndll, 'hx_cairo_surface_write_to_png', 2);
	static public var hx_cairo_version_string = neko.Lib.load(ndll, 'hx_cairo_version_string', 0);
	static public var hx_cairo_test = neko.Lib.load(ndll, 'hx_cairo_test', 0);
}

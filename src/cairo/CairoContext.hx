package cairo;

class CairoContext {
	private var handle:Dynamic;

	public function new(handle:Dynamic) {
		this.handle = handle;
	}

	public function save() CairoRaw.hx_cairo_save(this.handle);
	public function restore() CairoRaw.hx_cairo_restore(this.handle);
	public function setSourceRgba(r:Float, g:Float, b:Float, a:Float) CairoRaw.hx_cairo_set_source_rgba(this.handle, r, g, b, a);
	public function fill() CairoRaw.hx_cairo_fill(this.handle);
	public function stroke() CairoRaw.hx_cairo_stroke(this.handle);
	public function translate(dx:Float, dy:Float) CairoRaw.hx_cairo_translate(this.handle, dx, dy);
	public function scale(sx:Float, sy:Float) CairoRaw.hx_cairo_scale(this.handle, sx, sy);
	public function rotate(angle:Float) CairoRaw.hx_cairo_rotate(this.handle, angle);
	public function identity() CairoRaw.hx_cairo_identity_matrix(this.handle);

	public function moveTo(x:Float, y:Float) CairoRaw.hx_cairo_move_to(this.handle, x, y);
	public function lineTo(x:Float, y:Float) CairoRaw.hx_cairo_line_to(this.handle, x, y);
	public function rectangle(x:Float, y:Float, width:Float, height:Float) CairoRaw.hx_cairo_rectangle(this.handle, x, y, width, height);
	
	/*
	static public var hx_cairo_transform = load('hx_cairo_transform', 2);
	static public var hx_cairo_set_matrix = load('hx_cairo_set_matrix', 2);
	static public var hx_cairo_get_matrix = load('hx_cairo_get_matrix', 2);
	static public var hx_cairo_copy_path = load('hx_cairo_copy_path', 1);
	static public var hx_cairo_copy_path_flat = load('hx_cairo_copy_path_flat', 1);
	static public var hx_cairo_append_path = load('hx_cairo_append_path', 2);
	static public var hx_cairo_new_path = load('hx_cairo_new_path', 1);
	static public var hx_cairo_new_sub_path = load('hx_cairo_new_sub_path', 1);
	static public var hx_cairo_close_path = load('hx_cairo_close_path', 1);
	static public var hx_cairo_arc = load('hx_cairo_arc', 6);
	static public var hx_cairo_arc_negative = load('hx_cairo_arc_negative', 6);
	static public var hx_cairo_curve_to = load('hx_cairo_curve_to', 7);
	*/
}

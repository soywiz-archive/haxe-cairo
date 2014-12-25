package cairo;

@:access(cairo.CairoMatrix.handle)
class CairoContext {
	private var handle:Dynamic;

	public function new(handle:Dynamic) {
		this.handle = handle;
	}

	public function save() CairoRaw.cairo_save(this.handle);
	public function restore() CairoRaw.cairo_restore(this.handle);
	public function saveRestore(callback: Void -> Void) {
		save();
		try {
			callback();
			restore();
		} catch (e:Dynamic) {
			restore();
			throw e;
		}
	}
	public function setSourceRgba(r:Float, g:Float, b:Float, a:Float) CairoRaw.cairo_set_source_rgba(this.handle, r, g, b, a);
	public function fill() CairoRaw.cairo_fill(this.handle);
	public function stroke() CairoRaw.cairo_stroke(this.handle);
	public function translate(dx:Float, dy:Float) CairoRaw.cairo_translate(this.handle, dx, dy);
	public function scale(sx:Float, sy:Float) CairoRaw.cairo_scale(this.handle, sx, sy);
	public function rotate(angle:Float) CairoRaw.cairo_rotate(this.handle, angle);
	public function identity() CairoRaw.cairo_identity_matrix(this.handle);

	public function moveTo(x:Float, y:Float) CairoRaw.cairo_move_to(this.handle, x, y);
	public function lineTo(x:Float, y:Float) CairoRaw.cairo_line_to(this.handle, x, y);
	public function rectangle(x:Float, y:Float, width:Float, height:Float) CairoRaw.cairo_rectangle(this.handle, x, y, width, height);
	public function transform(matrix:CairoMatrix) CairoRaw.cairo_transform(this.handle, matrix.handle);
	public function setMatrix(matrix:CairoMatrix) CairoRaw.cairo_set_matrix(this.handle, matrix.handle);
	public function getMatrix():CairoMatrix {
		var out = new CairoMatrix();
		CairoRaw.cairo_set_matrix(this.handle, out.handle);
		return out;
	}
	
	
	/*
	static public var cairo_copy_path = load('hx_cairo_copy_path', 1);
	static public var cairo_copy_path_flat = load('hx_cairo_copy_path_flat', 1);
	static public var cairo_append_path = load('hx_cairo_append_path', 2);
	static public var cairo_new_path = load('hx_cairo_new_path', 1);
	static public var cairo_new_sub_path = load('hx_cairo_new_sub_path', 1);
	static public var cairo_close_path = load('hx_cairo_close_path', 1);
	static public var cairo_arc = load('hx_cairo_arc', 6);
	static public var cairo_arc_negative = load('hx_cairo_arc_negative', 6);
	static public var cairo_curve_to = load('hx_cairo_curve_to', 7);
	*/
}

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
	
	public function setSource(source:CairoPattern) CairoRaw.cairo_set_source(this.handle, source.handle);
	public function setSourceRgb(r:Float, g:Float, b:Float) CairoRaw.cairo_set_source_rgb(this.handle, r, g, b);
	public function setSourceRgba(r:Float, g:Float, b:Float, a:Float) CairoRaw.cairo_set_source_rgba(this.handle, r, g, b, a);
	public function fill() CairoRaw.cairo_fill(this.handle);
	public function stroke() CairoRaw.cairo_stroke(this.handle);
	public function translate(dx:Float, dy:Float) CairoRaw.cairo_translate(this.handle, dx, dy);
	public function scale(sx:Float, sy:Float) CairoRaw.cairo_scale(this.handle, sx, sy);
	public function rotate(angle:Float) CairoRaw.cairo_rotate(this.handle, angle);
	public function identity() CairoRaw.cairo_identity_matrix(this.handle);

	public function moveTo(x:Float, y:Float) CairoRaw.cairo_move_to(this.handle, x, y);
	public function lineTo(x:Float, y:Float) CairoRaw.cairo_line_to(this.handle, x, y);

	public function arc(xc:Float, yc:Float, radius:Float, angle1:Float, angle2:Float) CairoRaw.cairo_arc(handle, xc, yc, radius, angle1, angle2);
	public function arcNegative(xc:Float, yc:Float, radius:Float, angle1:Float, angle2:Float) CairoRaw.cairo_arc_negative(handle, xc, yc, radius, angle1, angle2);
	public function curveTo(x1:Float, y1:Float, x2:Float, y2:Float, x3:Float, y3:Float) CairoRaw.cairo_curve_to(handle, x1, y1, x2, y2, x3, y3);

	public function rectangle(x:Float, y:Float, width:Float, height:Float) CairoRaw.cairo_rectangle(this.handle, x, y, width, height);
	public function transform(matrix:CairoMatrix) CairoRaw.cairo_transform(this.handle, matrix.handle);
	public function setMatrix(matrix:CairoMatrix) CairoRaw.cairo_set_matrix(this.handle, matrix.handle);
	public function getMatrix():CairoMatrix {
		var out = new CairoMatrix();
		CairoRaw.cairo_set_matrix(this.handle, out.handle);
		return out;
	}
	public function hasCurrentPoint() return CairoRaw.cairo_has_current_point(this.handle);
	public function getCurrentPoint():CairoPoint {
		var out = [0.0, 0.0];
		CairoRaw.cairo_get_current_point(this.handle, out);
		return new CairoPoint(out[0], out[1]);
	}
	public function getStatus() return cast(CairoRaw.cairo_status(handle), CairoStatus);
	public function getTarget():CairoSurface return new CairoSurface(CairoRaw.cairo_get_target(handle));

	public function setAntialias(value:CairoAntialias) CairoRaw.cairo_set_antialias(handle, value);
	public function getAntialias():CairoAntialias return cast(CairoRaw.cairo_get_antialias(handle), CairoAntialias);

	public function setFillRule(value:CairoFillRule) CairoRaw.cairo_set_fill_rule(handle, value);
	public function getFillRule():CairoFillRule return cast(CairoRaw.cairo_get_fill_rule(handle), CairoFillRule);

	public function setLineWidth(value:Float) CairoRaw.cairo_set_line_width(handle, value);
	public function getLineWidth():Float return CairoRaw.cairo_get_line_width(handle);

	public function setMiterLimit(value:Float) CairoRaw.cairo_set_miter_limit(handle, value);
	public function getMiterLimit():Float return CairoRaw.cairo_get_miter_limit(handle);

	public function setTolerance(value:Float) CairoRaw.cairo_set_tolerance(handle, value);
	public function getTolerance():Float return CairoRaw.cairo_get_tolerance(handle);

	public function setOperator(op:CairoOperator) CairoRaw.cairo_set_operator(handle, op);
	public function getOperator():CairoOperator return cast(CairoRaw.cairo_get_operator(handle), CairoOperator);

	public function copyPage() CairoRaw.cairo_copy_page(handle);
	public function showPage() CairoRaw.cairo_show_page(handle);

	public function pushGroup() CairoRaw.cairo_push_group(handle);
	public function pushGroupWithContent(content:CairoContent) CairoRaw.cairo_push_group_with_content(handle, content);

	public function copyPath():CairoPath return new CairoPath(CairoRaw.cairo_copy_path(handle));
	public function copyPathFlat():CairoPath return new CairoPath(CairoRaw.cairo_copy_path_flat(handle));

	public function appendPath(path:CairoPath) CairoRaw.cairo_append_path(handle, path.handle);
	public function newPath() CairoRaw.cairo_new_path(handle);
	public function newSubPath() CairoRaw.cairo_new_sub_path(handle);
	public function closePath() CairoRaw.cairo_new_path(handle);
}

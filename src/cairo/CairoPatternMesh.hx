package cairo;

class CairoPatternMesh extends CairoPattern {
	public function new(handle:Dynamic) super(handle);

	public function beginPatch() CairoRaw.cairo_mesh_pattern_begin_patch(handle);
	public function endPatch() CairoRaw.cairo_mesh_pattern_end_patch(handle);
	public function moveTo(x:Float, y:Float) CairoRaw.cairo_mesh_pattern_move_to(handle, x, y);
	public function lineTo(x:Float, y:Float) CairoRaw.cairo_mesh_pattern_line_to(handle, x, y);
	public function curveTo(x1:Float, y1:Float, x2:Float, y2:Float, x3:Float, y3:Float) CairoRaw.cairo_mesh_pattern_curve_to(handle, x1, y1, x2, y2, x3, y3);
	public function setControlPoint(pointNum:Int, x:Float, y:Float) CairoRaw.cairo_mesh_pattern_set_control_point(handle, pointNum, x, y);
	public function setCornerColorRgb(cornerNum:Int, r:Float, g:Float, b:Float) CairoRaw.cairo_mesh_pattern_set_corner_color_rgb(handle, cornerNum, r, g, b);
	public function setCornerColorRgba(cornerNum:Int, r:Float, g:Float, b:Float, a:Float) CairoRaw.cairo_mesh_pattern_set_corner_color_rgba(handle, cornerNum, r, g, b, a);
}
package cairo;

@:access(cairo.CairoMatrix.handle)
@:access(cairo.CairoSurface.handle)
@:access(cairo.CairoPath.handle)
class CairoPattern {
	private var handle:Dynamic;

	public function new(handle:Dynamic) {
		this.handle = handle;
	}

	static public function createRgba(r:Float, g:Float, b:Float, a:Float):CairoPattern {
		return new CairoPattern(CairoRaw.cairo_pattern_create_rgba(r, g, b, a));
	}

	static public function createRgb(r:Float, g:Float, b:Float):CairoPattern {
		return new CairoPattern(CairoRaw.cairo_pattern_create_rgb(r, g, b));
	}

	static public function forSurface(surface:CairoSurface):CairoPattern {
		return new CairoPattern(CairoRaw.cairo_pattern_create_for_surface(surface.handle));
	}

	static public function createMesh():CairoPatternMesh {
		return new CairoPatternMesh(CairoRaw.cairo_pattern_create_mesh());
	}

	static public function createLinear(x0:Float, y0:Float, x1:Float, y1:Float):CairoPatternGradient {
		return new CairoPatternGradient(CairoRaw.cairo_pattern_create_linear(x0, y0, x1, y1));
	}

	static public function createRadial(cx0:Float, cy0:Float, radius0:Float, cx1:Float, cy1:Float, radius1:Float):CairoPatternGradient {
		return new CairoPatternGradient(CairoRaw.cairo_pattern_create_radial(cx0, cy0, radius0, cx1, cy1, radius1));
	}

	public function setFilter(value:CairoFilter):CairoPattern {
		CairoRaw.cairo_pattern_set_filter(handle, value);
		return this;
	}
	public function getFilter():CairoFilter return cast(CairoRaw.cairo_pattern_get_filter(handle), CairoFilter);

	public function setExtend(value:CairoExtend):CairoPattern {
		CairoRaw.cairo_pattern_set_extend(handle, value);
		return this;
	}
	public function getExtend():CairoExtend return cast(CairoRaw.cairo_pattern_get_extend(handle), CairoExtend);

	public function getType():CairoPatternType return cast(CairoRaw.cairo_pattern_get_type(handle), CairoPatternType);
	public function getStatus():CairoStatus return cast(CairoRaw.cairo_pattern_status(handle), CairoStatus);

	public function setMatrix(matrix:CairoMatrix):CairoPattern {
		CairoRaw.cairo_pattern_set_matrix(handle, matrix);
		return this;
	}

	public function getRgba():CairoRgba {
		var r = [0.0], g = [0.0], b = [0.0], a = [0.0];
		CairoRaw.cairo_pattern_get_rgba(handle, r, g, b, a);
		return new CairoRgba(r[0], g[0], b[0], a[0]);
	}

	public function getMatrix() {
		var matrix = new CairoMatrix();
		CairoRaw.cairo_pattern_set_matrix(handle, matrix);
		return matrix;
	}
}
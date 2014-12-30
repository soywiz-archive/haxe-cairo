package cairo;

class CairoPatternGradient extends CairoPattern {
	public function new(handle:Dynamic) super(handle);

	public function addColorStopRgb(offset:Float, r:Float, g:Float, b:Float):CairoPatternGradient {
		CairoRaw.cairo_pattern_add_color_stop_rgb(handle, offset, r, g, b);
		return this;
	}

	public function addColorStopRgba(offset:Float, r:Float, g:Float, b:Float, a:Float):CairoPatternGradient {
		CairoRaw.cairo_pattern_add_color_stop_rgba(handle, offset, r, g, b, a);
		return this;
	}

	public function getLinearPoints():{ x0:Float, y0:Float, x1:Float, y1:Float } {
		var x0 = [0.0], y0 = [0.0], x1 = [0.0], y1 = [0.0];
		CairoRaw.cairo_pattern_get_linear_points(handle, x0, y0, x1, y1);
		return {
			x0: x0[0], y0: y0[0],
			x1: x1[0], y1: y1[0]
		}
	}

	public function getRadialCircles():{ x0:Float, y0:Float, r0:Float, x1:Float, y1:Float, r1:Float } {
		var x0 = [0.0], y0 = [0.0], r0 = [0.0], x1 = [0.0], y1 = [0.0], r1 = [0.0];
		CairoRaw.cairo_pattern_get_radial_circles(handle, x0, y0, r0, x1, y1, r1);
		return {
			x0: x0[0], y0: y0[0], r0: r0[0],
			x1: x1[0], y1: y1[0], r1: r1[0]
		}
	}

	public function getColorStops():Array<{ offset:Float, rgba:CairoRgba }> {
		var countPtr = [0]; CairoRaw.cairo_pattern_get_color_stop_count(handle, countPtr);
		var out = [];
		for (index in 0 ... countPtr[0]) {
			var offset = [0.0], r = [0.0], g = [0.0], b = [0.0], a = [0.0];
			CairoRaw.cairo_pattern_get_color_stop_rgba(handle, index, offset, r, g, b, a);
			out.push({ offset: offset[0],  rgba: new CairoRgba(r[0], g[0], b[0], a[0]) });
		}
		return out;
	}
}
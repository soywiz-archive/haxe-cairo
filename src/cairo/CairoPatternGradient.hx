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
}
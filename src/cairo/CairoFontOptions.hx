package cairo;
class CairoFontOptions {
    private var handle:Dynamic;

    private function new(handle:Dynamic) {
        this.handle = handle;
    }

    static public function create():CairoFontOptions {
        return new CairoFontOptions(CairoRaw.cairo_font_options_create());
    }

    public function copy():CairoFontOptions {
        return new CairoFontOptions(CairoRaw.cairo_font_options_copy(handle));
    }

    public function merge(that:CairoFontOptions):CairoFontOptions {
        CairoRaw.cairo_font_options_merge(handle, that.handle);
        return this;
    }

    public function getHash():Int return CairoRaw.cairo_font_options_hash(handle);
    public function equal(that:CairoFontOptions):Bool return CairoRaw.cairo_font_options_equal(this.handle, that.handle);

    public function setAntialias(value:CairoAntialias):CairoFontOptions {
        CairoRaw.cairo_font_options_set_antialias(handle, value);
        return this;
    }

    public function setSubpixelOrder(value:CairoSubpixelOrder):CairoFontOptions {
        CairoRaw.cairo_font_options_set_subpixel_order(handle, value);
        return this;
    }

    public function setHintStyle(value:CairoHintStyle):CairoFontOptions {
        CairoRaw.cairo_font_options_set_hint_style(handle, value);
        return this;
    }
    public function setHintMetrics(value:CairoHintMetrics):CairoFontOptions {
        CairoRaw.cairo_font_options_set_hint_metrics(handle, value);
        return this;
    }

    public function getAntialias():CairoAntialias return cast(CairoRaw.cairo_font_options_get_antialias(handle), CairoAntialias);
    public function getSubpixelOrder():CairoSubpixelOrder return cast(CairoRaw.cairo_font_options_get_subpixel_order(handle), CairoSubpixelOrder);
    public function getHintStyle():CairoHintStyle return cast(CairoRaw.cairo_font_options_get_hint_style(handle), CairoHintStyle);
    public function getHintMetrics():CairoHintMetrics return cast(CairoRaw.cairo_font_options_get_hint_metrics(handle), CairoHintMetrics);

    public function getStatus():CairoStatus {
        return cast(CairoRaw.cairo_font_options_status(handle), CairoStatus);
    }
}

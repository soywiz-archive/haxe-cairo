package cairo;

class CairoSurface {
	private var handle:Dynamic;
	public var format(default, null):CairoSurfaceFormat;
	public var width(default, null):Int;
	public var height(default, null):Int;

	private function new(handle:Dynamic, format:CairoSurfaceFormat, width:Int, height:Int) {
		this.handle = handle;
		this.format = format;
		this.width = width;
		this.height = height;
	}

	static public function create(format:CairoSurfaceFormat, width:Int, height:Int):CairoSurface {
		var result = CairoRaw.hx_cairo_image_surface_create(format, width, height);
		if (result == null) throw "Couldn't create surface";
		return new CairoSurface(result, format, width, height);
	}

	public function writeToPng(path:String) {
		CairoRaw.hx_cairo_surface_write_to_png(this.handle, path);
	}
}

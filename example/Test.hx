import cairo.*;

class Test {
	static public function main() {
		trace('test');
		trace(Cairo.getVersion());
		trace('a');
		var surface = CairoSurface.create(CairoSurfaceFormat.ARGB32, 100, 100);
		trace('b');
		trace(surface);
		var context = surface.getContext();
		context.save();
		{
			context.setSourceRgba(1, 0, 0, 1);
			context.rectangle(10, 10, 50, 50);
			context.fill();
			context.setSourceRgba(0, 1, 0, 1);
			context.rectangle(30, 30, 70, 70);
			context.fill();
		}
		context.restore();
		surface.writeToPng('output.png');
	}
}

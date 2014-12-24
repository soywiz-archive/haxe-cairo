import cairo.*;

class Test {
	static public function main() {
		trace('test');
		trace(Cairo.getVersion());
		trace('a');
		var result = CairoSurface.create(CairoSurfaceFormat.ARGB32, 10, 10);
		trace('b');
		trace(result);
		result.writeToPng('output.png');
	}
}

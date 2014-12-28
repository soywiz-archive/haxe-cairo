import cairo.*;

class Test {
	static public function main() {
		trace('Cairo version: ' + Cairo.getVersionString());
		var surface = CairoSurface.create(CairoSurfaceFormat.ARGB32, 256, 256);
		trace(surface);
		var context = surface.getContext();
		context.saveRestore(function() {
			context.setSourceRgba(1, 0, 0, 1);
			context.rectangle(10, 10, 50, 50);
			context.fill();
			context.setSourceRgba(0, 1, 0, 1);
			context.rectangle(30, 30, 70, 70);
			context.fill();
			context.saveRestore(function() {
				context.setAntialias(CairoAntialias.SUBPIXEL);
				context.transform(new CairoMatrix().setToRotate(1));
				context.setSourceRgba(0, 0, 1, 1);
				context.rectangle(100, 30, 70, 70);
				trace('path extents', context.getPathExtents());
				context.fill();
			});
			trace('status', context.getStatus());
		});
		context.selectFontFace("Arial", CairoFontSlant.NORMAL, CairoFontWeight.NORMAL);
		context.setFontSize(50);
		//context.showText('Hello World!');

		surface.writeToPng('output.png');
		trace('clip extents', context.getClipExtents());
		
		var matrix = new CairoMatrix();
		matrix.setToScale(2, 2);
		trace(matrix.transformPoint(new CairoPoint(10, 10)));
	}
}

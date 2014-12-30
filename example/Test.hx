import sys.io.FileInput;
import sys.io.File;
import haxe.io.BytesOutput;
import cairo.*;

class Test {
	static public function main() {
		trace('Cairo version: ' + Cairo.getVersionString());

		var surface = CairoSurface.create(CairoSurfaceFormat.ARGB32, 256, 256);
		//var surface = CairoSurface.createForSvg("output.svg", 200, 200);
		//var surface = CairoSurface.createForPdf("output.pdf", 200, 200);
		trace(surface);
		var context = surface.getContext();
		context.saveRestore(function() {
			context.setSourceRgba(1, 0, 0, 1);
			context.rectangle(10, 10, 50, 50);
			context.fill();
			context.setSource(CairoPattern.createLinear(30, 30, 70, 70).addColorStopRgb(0, 0.5, 0, 0).addColorStopRgb(1, 0, 0, 1));
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
		context.saveRestore(function() {
			context.translate(50, 50);
			context.selectFontFace("Arial", CairoFontSlant.NORMAL, CairoFontWeight.NORMAL);
			context.setFontSize(50);
			//context.showText('Hello World!');
		});

		//surface.flush();
		//surface.finish();
		//surface.destroy();
		//surface.writeToPng('output.png');
		File.saveBytes("output2.png", surface.getPngBytes());
		//trace(output.getBytes().length);
		trace('clip extents', context.getClipExtents());
		
		var matrix = new CairoMatrix();
		matrix.setToScale(2, 2);
		trace(matrix.transformPoint(new CairoPoint(10, 10)));

		testStreams();
		testRegions();
	}

	static private function testStreams() {
		var surface2 = CairoSurface.createFromPngStream(File.read("output2.png")).createForRectangle(50, 50, 100, 100);
		surface2.writeToPngStream(File.write("output3.png"));
	}

	static private function testRegions() {
		var region = CairoRegion.create();
		trace('numRects', region.getNumRectangles());
		region.unionRectangle(new CairoRectangleInt(0, 0, 100, 100));
		trace('numRects', region.getNumRectangles());
		trace('contains', region.containsRectangle(new CairoRectangleInt(0, 0, 50, 50)));
		trace('contains', region.containsRectangle(new CairoRectangleInt(-10, -10, 50, 50)));
		trace('contains', region.containsRectangle(new CairoRectangleInt(-50, -50, 50, 50)));
		region.xorRectangle(new CairoRectangleInt(50, 50, 100, 100));
		trace('extent', region.getExtents());
		trace('rectangles', region.getRectangles());
	}
}

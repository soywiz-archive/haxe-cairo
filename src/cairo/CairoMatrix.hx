package cairo;

class CairoMatrix {
	private var handle:Dynamic;

	public function new() {
		this.handle = CairoRaw.cairo_matrix_create();
		this.identity();
	}

	public function setTo(a:Float, b:Float, c:Float, d:Float, tx:Float, ty:Float):CairoMatrix {
		CairoRaw.cairo_matrix_init(handle, a, b, c, d, tx, ty);
		return this;
	}

	public function setToTranslate(tx:Float, ty:Float):CairoMatrix {
		CairoRaw.cairo_matrix_init_translate(handle, tx, ty);
		return this;
	}

	public function setToScale(sx:Float, sy:Float):CairoMatrix {
		CairoRaw.cairo_matrix_init_scale(handle, sx, sy);
		return this;
	}

	public function setToRotate(radians:Float):CairoMatrix {
		CairoRaw.cairo_matrix_init_rotate(handle, radians);
		return this;
	}

	public function translate(tx:Float, ty:Float) { CairoRaw.cairo_matrix_translate(handle, tx, ty); return this; }

	public function scale(sx:Float, sy:Float) { CairoRaw.cairo_matrix_scale(handle, sx, sy); return this; }

	public function rotate(radians:Float) { CairoRaw.cairo_matrix_rotate(handle, radians); return this; }

	public function identity():CairoMatrix { CairoRaw.cairo_matrix_init_identity(handle); return this; }
	public function invert():CairoMatrix { CairoRaw.cairo_matrix_invert(handle); return this; }

	public function multiply(left:CairoMatrix, right:CairoMatrix):CairoMatrix { CairoRaw.cairo_matrix_multiply(handle, left.handle, right.handle); return this; }
}
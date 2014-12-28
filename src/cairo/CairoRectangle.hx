package cairo;

class CairoRectangle {
	public var left:Float;
	public var top:Float;
	public var right:Float;
	public var bottom:Float;

	public var width(get, set):Float;
	public var height(get, set):Float;

	private function get_width() return right - left;
	private function get_height() return bottom - top;


	private function set_width(value:Float) {
		right = left + value;
		return value;
	}
	private function set_height(value:Float) {
		bottom = top + value;
		return value;
	}

	public function new(left:Float, top:Float, right:Float, bottom:Float) {
		this.left = left;
		this.top = top;
		this.right = right;
		this.bottom = bottom;
	}

	public function toString() return 'CairoRectangle(($left,$top)-($right,$bottom))';
}
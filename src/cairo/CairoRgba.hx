package cairo;
class CairoRgba {
    public var red:Float;
    public var green:Float;
    public var blue:Float;
    public var alpha:Float;

    public function new(red:Float, green:Float, blue:Float, alpha:Float) {
        this.red = red;
        this.green = green;
        this.blue = blue;
        this.alpha = alpha;
    }

    public function toString() {
        return 'CairoRgba($red, $green, $blue, $alpha)';
    }
}

package cairo.tool;
import haxe.io.Bytes;
class CairoBlur {
    static public function blur(surface:CairoSurface, radiusX:Int, radiusY:Int) {
        var indices = [0, 1, 2, 3];
        var w = surface.width;
        var h = surface.height;

        var components = surface.extractComponents(indices, 0, 0, surface.width, surface.height);
        var temp = new Bytes2(Bytes.alloc(w * h));

        for (component in components) gaussBlur_4(component, temp, w, h, radiusX, radiusY);

        surface.setComponents(indices, components, 0, 0, surface.width, surface.height);
    }

// http://blog.ivank.net/fastest-gaussian-blur.html

    @:noStack static private function boxesForGauss(sigma:Int, n:Int) {// standard deviation, number of boxes {
        var wIdeal = Math.sqrt((12 * sigma * sigma / n) + 1); // Ideal averaging filter width
        var wl = Math.floor(wIdeal); if (wl % 2 == 0) wl--;
        var wu = wl + 2;
        var mIdeal = (12 * sigma * sigma - n * wl * wl - 4 * n * wl - 3 * n) / (-4 * wl - 4);
        var m = Math.round(mIdeal);
        return [for (i in 0 ... n) i < m ? wl : wu];
    }

    @:noStack static private function gaussBlur_4(src:Bytes2, dst:Bytes2, w:Int, h:Int, rx:Int, ry:Int) {
        var bxsX = boxesForGauss(rx, 3);
        var bxsY = boxesForGauss(ry, 3);
        boxBlur_4(src, dst, w, h, Std.int((bxsX[0] - 1) / 2), Std.int((bxsY[0] - 1) / 2));
        boxBlur_4(dst, src, w, h, Std.int((bxsX[1] - 1) / 2), Std.int((bxsY[1] - 1) / 2));
        boxBlur_4(src, dst, w, h, Std.int((bxsX[2] - 1) / 2), Std.int((bxsY[2] - 1) / 2));
    }

    @:noStack static private function boxBlur_4(src:Bytes2, dst:Bytes2, w:Int, h:Int, rX:Int, rY:Int) {
        for (i in 0 ... src.length) dst[i] = src[i];
        boxBlurH_4(dst, src, w, h, rX);
        boxBlurT_4(src, dst, w, h, rY);
    }

    @:noStack static private function boxBlurH_4(src:Bytes2, dst:Bytes2, w:Int, h:Int, r:Int) {
        var iarr = 1 / (r + r + 1);
        for (i in 0 ... h) {
            var ti = i * w;
            var li = ti;
            var ri = ti + r;
            var fv = src[ti];
            var lv = src[ti + w - 1];
            var val = (r + 1) * fv;

            for (j in 0 ... r) val += src[ti + j];
            for (j in 0 ... r + 1) { val += src[ri++] - fv ; dst[ti++] = Math.round(val * iarr); }
            for (j in r + 1 ... w - r) { val += src[ri++] - src[li++]; dst[ti++] = Math.round(val * iarr); }
            for (j in w - r ... w) { val += lv - src[li++]; dst[ti++] = Math.round(val * iarr); }
        }
    }

    @:noStack static private function boxBlurT_4(src:Bytes2, dst:Bytes2, w:Int, h:Int, r:Int) {
        var iarr = 1 / (r + r + 1);
        for (i in 0 ... w) {
            var ti = i;
            var li = ti;
            var ri = ti + r * w;
            var fv = src[ti];
            var lv = src[ti + w * (h - 1)];
            var val = (r + 1) * fv;

            for (j in 0 ... r) val += src[ti + j * w];
            for (j in 0 ... r + 1) { val += src[ri] - fv ; dst[ti] = Math.round(val * iarr); ri += w; ti += w; }
            for (j in r + 1 ... h - r) { val += src[ri] - src[li]; dst[ti] = Math.round(val * iarr); li += w; ri += w; ti += w; }
            for (j in h - r ... h) { val += lv - src[li]; dst[ti] = Math.round(val * iarr); li += w; ti += w; }
        }
    }
}

abstract Bytes2(Bytes) to Bytes from Bytes {
    public function new(s:Bytes) this = s;
    public var length(get, never):Int;
    private inline function get_length():Int return this.length;
    @:arrayAccess inline function get(k:Int) return this.get(k);
    @:arrayAccess inline function set(k:Int, v:Int) return this.set(k, v);
}

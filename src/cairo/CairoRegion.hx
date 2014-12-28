package cairo;

import haxe.io.Error;
class CairoRegion {
    private var handle:Dynamic;

    public function new(handle:Dynamic) {
        this.handle = handle;
    }

    static public function create():CairoRegion return new CairoRegion(CairoRaw.cairo_region_create());
    static public function createRectangle(rectangle:CairoRectangleInt):CairoRegion {
        return create().unionRectangle(rectangle);
    }
    static public function createRectangles(rectangles:List<CairoRectangleInt>):CairoRegion {
        var that = create();
        for (rectangle in rectangles) that.unionRectangle(rectangle);
        return that;
    }

    public function copy():CairoRegion return new CairoRegion(CairoRaw.cairo_region_copy(handle));
    public function getStatus():CairoStatus return cast(CairoRaw.cairo_region_status(handle), CairoStatus);
    public function isEmpty():Bool return CairoRaw.cairo_region_is_empty(handle);
    public function getNumRectangles():Int return CairoRaw.cairo_region_num_rectangles(handle);
    public function containsPoint(x:Int, y:Int):Bool return CairoRaw.cairo_region_contains_point(handle, x, y);
    public function equals(that:CairoRegion):Bool return CairoRaw.cairo_region_equal(handle, this.handle, that.handle);
    public function translate(x:Int, y:Int):CairoRegion {
        CairoRaw.cairo_region_translate(handle, x, y);
        return this;
    }

    private function _check(status:CairoStatus):CairoRegion {
        if (status != CairoStatus.SUCCESS) throw "Error";
        return this;
    }

    public function intersect(that:CairoRegion):CairoRegion return _check(CairoRaw.cairo_region_intersect(handle, this.handle, that.handle));
    public function subtract(that:CairoRegion):CairoRegion return _check(CairoRaw.cairo_region_subtract(handle, this.handle, that.handle));
    public function union(that:CairoRegion):CairoRegion return _check(CairoRaw.cairo_region_union(handle, this.handle, that.handle));
    public function xor(that:CairoRegion):CairoRegion return _check(CairoRaw.cairo_region_xor(handle, this.handle, that.handle));

    public function unionRectangle(that:CairoRectangleInt):CairoRegion return _check(CairoRaw.cairo_region_union_rectangle(handle, that));
    public function intersectRectangle(that:CairoRectangleInt):CairoRegion return _check(CairoRaw.cairo_region_intersect_rectangle(handle, that));
    public function subtractRectangle(that:CairoRectangleInt):CairoRegion return _check(CairoRaw.cairo_region_subtract_rectangle(handle, that));
    public function xorRectangle(that:CairoRectangleInt):CairoRegion return _check(CairoRaw.cairo_region_xor_rectangle(handle, that));

    public function containsRectangle(that:CairoRectangleInt):CairoRegionOverlap return CairoRaw.cairo_region_contains_rectangle(handle, that);
    public function getExtents():CairoRectangleInt {
        var rect = new CairoRectangleInt(0, 0, 0, 0);
        CairoRaw.cairo_region_get_extents(handle, rect);
        return rect;
    }
    public function getRectangles():Array<CairoRectangleInt> {
        return [for (index in 0 ... this.getNumRectangles()) getRectangle(index)];
    }
    public function getRectangle(index:Int):CairoRectangleInt {
        var rect = new CairoRectangleInt(0, 0, 0, 0);
        CairoRaw.cairo_region_get_rectangle(handle, index, rect);
        return rect;
    }


}

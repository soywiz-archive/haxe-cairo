package cairo;
@:enum abstract CairoRegionOverlap(Int) {
    var IN = 0;		/* completely inside region */
    var OUT = 1;		/* completely outside region */
    var PART = 2;		/* partly inside region */

    public function toString() {
        return 'CairoRegionOverlap($this)';
    }
}

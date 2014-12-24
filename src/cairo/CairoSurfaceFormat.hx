package cairo;

@:enum abstract CairoSurfaceFormat(Int) {
	var INVALID   = -1;
    var ARGB32    =  0;
    var RGB24     =  1;
    var A8        =  2;
    var A1        =  3;
    var RGB16_565 =  4;
    var RGB30     =  5;
}

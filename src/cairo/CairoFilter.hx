package cairo;

@:enum abstract CairoFilter(Int) {
	var FAST = 0;
	var GOOD = 1;
	var BEST = 2;
	var NEAREST = 3;
	var BILINEAR = 4;
	var GAUSSIAN = 5;
}
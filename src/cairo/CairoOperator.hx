package cairo;

@:enum abstract CairoOperator(Int) {
    var CLEAR = 0;

    var SOURCE = 1;
    var OVER = 2;
    var IN = 3;
    var OUT = 4;
    var ATOP = 5;

    var DEST = 6;
    var DEST_OVER = 7;
    var DEST_IN = 8;
    var DEST_OUT = 9;
    var DEST_ATOP = 10;

    var XOR = 11;
    var ADD = 12;
    var SATURATE = 13;

    var MULTIPLY = 14;
    var SCREEN = 15;
    var OVERLAY = 16;
    var DARKEN = 17;
    var LIGHTEN = 18;
    var COLOR_DODGE = 19;
    var COLOR_BURN = 20;
    var HARD_LIGHT = 21;
    var SOFT_LIGHT = 22;
    var DIFFERENCE = 23;
    var EXCLUSION = 24;
    var HSL_HUE = 25;
    var HSL_SATURATION = 26;
    var HSL_COLOR = 27;
    var HSL_LUMINOSITY = 28;
}
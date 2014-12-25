package cairo;

#if neko
import neko.Lib;
#else
import cpp.Lib;
#end

class CairoRaw {
	static private inline function load(name:String, count:Int) return Lib.load('cairo', name, count);

	static private var laoded = hxcpp.NekoInit.nekoInit("cairo");

	<?php foreach ($functions as $function) { ?>
	static public var hx_<?= $function->name ?> = load('hx_<?= $function->name ?>', <?= count($function->args) ?>);
	<?php } ?>
}

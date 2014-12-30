package cairo;

#if neko
import neko.Lib;
#else
import cpp.Lib;
#end

class CairoRaw {
	static private inline function load(name:String, count:Int) return Lib.load('cairo', name, count);

	#if neko
	static private var laoded = hxcpp.NekoInit.nekoInit("cairo");
	#end

	<?php foreach ($functions as $function) { ?>
	static public var <?= $function->name ?> = load('hx_<?= $function->name ?>', <?= (count($function->args) > 5) ? -1 : count($function->args) ?>);
	<?php } ?>
}

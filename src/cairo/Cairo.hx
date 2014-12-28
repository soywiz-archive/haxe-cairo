package cairo;

class Cairo {
	static public function getVersion():Int return CairoRaw.cairo_version();
	static public function getVersionString():String return CairoRaw.cairo_version_string();
	static public function getStatusString(status:CairoStatus):String return CairoRaw.cairo_status_to_string(status);
	static public function debugResetStaticData():Void CairoRaw.cairo_debug_reset_static_data();
	
}

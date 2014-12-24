#ifndef STATIC_LINK
#define IMPLEMENT_API
#endif

#if defined(HX_WINDOWS) || defined(HX_MACOS) || defined(HX_LINUX)
#define NEKO_COMPATIBLE
#endif

#include <hx/CFFI.h>
#include <hxcpp.h> 

#include <string.h>
#include <stdio.h>

#include <cairo/cairo.h>

extern "C" {
	DECLARE_KIND(HX_SURFACE_KIND)
	DEFINE_KIND(HX_SURFACE_KIND)

    value hx_cairo_version_string() {
		return alloc_string(cairo_version_string());
    }
    DEFINE_PRIM(hx_cairo_version_string, 0);

    #define val_get_surface(z) ((cairo_surface_t*)val_get_handle(z, HX_SURFACE_KIND))

	void hx_surface_kind_destroy(value surface){ 
		cairo_surface_destroy(val_get_surface(surface));
	} 

    value hx_cairo_image_surface_create(value format, value width, value height) {
    	val_check(format, int);
    	val_check(width, int);
    	val_check(height, int);
    	cairo_surface_t *surface = cairo_image_surface_create((cairo_format_t)val_get_int(format), val_get_int(width), val_get_int(height));
		value abstract_object = alloc_abstract(HX_SURFACE_KIND, surface);
		val_gc(abstract_object, ((hxFinalizer) &hx_surface_kind_destroy));
		return abstract_object; 
    }
    DEFINE_PRIM(hx_cairo_image_surface_create, 3);

    value hx_cairo_surface_write_to_png(value surface, value path) {
    	val_check_kind(surface, HX_SURFACE_KIND);
    	val_check(path, string);
    	cairo_surface_write_to_png(val_get_surface(surface), val_string(path));
		return alloc_int(0);
    }
    DEFINE_PRIM(hx_cairo_surface_write_to_png, 2);

    value hx_cairo_test() {
    	cairo_surface_t *surface = cairo_image_surface_create(CAIRO_FORMAT_ARGB32, 128, 128);
    	cairo_surface_write_to_png(surface, "test.png");
    	cairo_surface_destroy(surface);
    	return alloc_int(10);
    }
	DEFINE_PRIM( hx_cairo_test, 0 );
}


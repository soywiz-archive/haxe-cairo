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
    		DECLARE_KIND(kind_cairo_surface_t)
		DEFINE_KIND(kind_cairo_surface_t)
		void kind_cairo_surface_t_check(value z) { val_check_kind(z, kind_cairo_surface_t);  }
		cairo_surface_t* kind_cairo_surface_t_get(value z) { return ((cairo_surface_t*)val_get_handle(z, kind_cairo_surface_t)); }
		void kind_cairo_surface_t_destroy(value z) { cairo_surface_destroy(kind_cairo_surface_t_get(z)); }
		value kind_cairo_surface_t_alloc(cairo_surface_t* z) {
	        value abstract_object = alloc_abstract(kind_cairo_surface_t, z);
	        val_gc(abstract_object, ((hxFinalizer) kind_cairo_surface_t_destroy));
	        return abstract_object; 
		}

    
            value hx_cairo_version_string() {
        	
			const char* _result = cairo_version_string();
			return alloc_string(_result);
        }
        DEFINE_PRIM(hx_cairo_version_string, 0);
            value hx_cairo_image_surface_create(value format, value width, value height) {
        	        		val_check(format, int);
        	        		val_check(width, int);
        	        		val_check(height, int);
        	
			cairo_surface_t* _result = cairo_image_surface_create(((cairo_format_t)val_get_int(format)), val_get_int(width), val_get_int(height));
			return kind_cairo_surface_t_alloc(_result);
        }
        DEFINE_PRIM(hx_cairo_image_surface_create, 3);
            value hx_cairo_image_surface_create_for_data(value data, value format, value width, value height, value stride) {
        	        		{ buffer temp = val_to_buffer(data); if (!temp) hx_failure("invalid source buffer");};
        	        		val_check(format, int);
        	        		val_check(width, int);
        	        		val_check(height, int);
        	        		val_check(stride, int);
        	
			cairo_surface_t* _result = cairo_image_surface_create_for_data((unsigned char*)buffer_data(val_to_buffer(data)), ((cairo_format_t)val_get_int(format)), val_get_int(width), val_get_int(height), val_get_int(stride));
			return kind_cairo_surface_t_alloc(_result);
        }
        DEFINE_PRIM(hx_cairo_image_surface_create_for_data, 5);
            value hx_cairo_image_surface_create_from_png(value filename) {
        	        		val_check(filename, string);
        	
			cairo_surface_t* _result = cairo_image_surface_create_from_png(val_get_string(filename));
			return kind_cairo_surface_t_alloc(_result);
        }
        DEFINE_PRIM(hx_cairo_image_surface_create_from_png, 1);
            value hx_cairo_surface_write_to_png(value surface, value filename) {
        	        		kind_cairo_surface_t_check(surface);
        	        		val_check(filename, string);
        	
			cairo_status_t _result = cairo_surface_write_to_png(kind_cairo_surface_t_get(surface), val_get_string(filename));
			return alloc_int(_result);
        }
        DEFINE_PRIM(hx_cairo_surface_write_to_png, 2);
            value hx_cairo_image_surface_get_format(value surface) {
        	        		kind_cairo_surface_t_check(surface);
        	
			cairo_format_t _result = cairo_image_surface_get_format(kind_cairo_surface_t_get(surface));
			return alloc_int(_result);
        }
        DEFINE_PRIM(hx_cairo_image_surface_get_format, 1);
            value hx_cairo_image_surface_get_width(value surface) {
        	        		kind_cairo_surface_t_check(surface);
        	
			int _result = cairo_image_surface_get_width(kind_cairo_surface_t_get(surface));
			return alloc_int(_result);
        }
        DEFINE_PRIM(hx_cairo_image_surface_get_width, 1);
            value hx_cairo_image_surface_get_height(value surface) {
        	        		kind_cairo_surface_t_check(surface);
        	
			int _result = cairo_image_surface_get_height(kind_cairo_surface_t_get(surface));
			return alloc_int(_result);
        }
        DEFINE_PRIM(hx_cairo_image_surface_get_height, 1);
            value hx_cairo_image_surface_get_stride(value surface) {
        	        		kind_cairo_surface_t_check(surface);
        	
			int _result = cairo_image_surface_get_stride(kind_cairo_surface_t_get(surface));
			return alloc_int(_result);
        }
        DEFINE_PRIM(hx_cairo_image_surface_get_stride, 1);
    }


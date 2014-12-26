#ifndef STATIC_LINK
#define IMPLEMENT_API
#endif

#if defined(HX_WINDOWS) || defined(HX_MACOS) || defined(HX_LINUX)
#define NEKO_COMPATIBLE
#endif

#include <hx/CFFI.h>

#include <string.h>
#include <stdio.h>

#include <cairo/cairo.h>

extern "C" {
	#define val_get_float(v) val_get_double(v)

	void dummy_free(void*ptr) { }

	cairo_matrix_t* cairo_matrix_create() {
		return new cairo_matrix_t;
	}

	void cairo_matrix_destroy(cairo_matrix_t* matrix) {
		delete matrix;
	}

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

    		DECLARE_KIND(kind_cairo_t)
		DEFINE_KIND(kind_cairo_t)
		void kind_cairo_t_check(value z) { val_check_kind(z, kind_cairo_t);  }
		cairo_t* kind_cairo_t_get(value z) { return ((cairo_t*)val_get_handle(z, kind_cairo_t)); }
		void kind_cairo_t_destroy(value z) { cairo_destroy(kind_cairo_t_get(z)); }
		value kind_cairo_t_alloc(cairo_t* z) {
	        value abstract_object = alloc_abstract(kind_cairo_t, z);
	        val_gc(abstract_object, ((hxFinalizer) kind_cairo_t_destroy));
	        return abstract_object; 
		}

    		DECLARE_KIND(kind_cairo_pattern_t)
		DEFINE_KIND(kind_cairo_pattern_t)
		void kind_cairo_pattern_t_check(value z) { val_check_kind(z, kind_cairo_pattern_t);  }
		cairo_pattern_t* kind_cairo_pattern_t_get(value z) { return ((cairo_pattern_t*)val_get_handle(z, kind_cairo_pattern_t)); }
		void kind_cairo_pattern_t_destroy(value z) { cairo_pattern_destroy(kind_cairo_pattern_t_get(z)); }
		value kind_cairo_pattern_t_alloc(cairo_pattern_t* z) {
	        value abstract_object = alloc_abstract(kind_cairo_pattern_t, z);
	        val_gc(abstract_object, ((hxFinalizer) kind_cairo_pattern_t_destroy));
	        return abstract_object; 
		}

    		DECLARE_KIND(kind_cairo_matrix_t)
		DEFINE_KIND(kind_cairo_matrix_t)
		void kind_cairo_matrix_t_check(value z) { val_check_kind(z, kind_cairo_matrix_t);  }
		cairo_matrix_t* kind_cairo_matrix_t_get(value z) { return ((cairo_matrix_t*)val_get_handle(z, kind_cairo_matrix_t)); }
		void kind_cairo_matrix_t_destroy(value z) { cairo_matrix_destroy(kind_cairo_matrix_t_get(z)); }
		value kind_cairo_matrix_t_alloc(cairo_matrix_t* z) {
	        value abstract_object = alloc_abstract(kind_cairo_matrix_t, z);
	        val_gc(abstract_object, ((hxFinalizer) kind_cairo_matrix_t_destroy));
	        return abstract_object; 
		}

    		DECLARE_KIND(kind_cairo_path_t)
		DEFINE_KIND(kind_cairo_path_t)
		void kind_cairo_path_t_check(value z) { val_check_kind(z, kind_cairo_path_t);  }
		cairo_path_t* kind_cairo_path_t_get(value z) { return ((cairo_path_t*)val_get_handle(z, kind_cairo_path_t)); }
		void kind_cairo_path_t_destroy(value z) { cairo_path_destroy(kind_cairo_path_t_get(z)); }
		value kind_cairo_path_t_alloc(cairo_path_t* z) {
	        value abstract_object = alloc_abstract(kind_cairo_path_t, z);
	        val_gc(abstract_object, ((hxFinalizer) kind_cairo_path_t_destroy));
	        return abstract_object; 
		}

    
            value hx_cairo_version_string() {
        	
        					const char* _result = cairo_version_string();
				return alloc_string(_result);
        	        }
        DEFINE_PRIM(hx_cairo_version_string, 0);
            value hx_cairo_create(value target) {
        	        		kind_cairo_surface_t_check(target);
        	
        					cairo_t* _result = cairo_create(kind_cairo_surface_t_get(target));
				return kind_cairo_t_alloc(_result);
        	        }
        DEFINE_PRIM(hx_cairo_create, 1);
            value hx_cairo_save(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_save(kind_cairo_t_get(cr));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_save, 1);
            value hx_cairo_restore(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_restore(kind_cairo_t_get(cr));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_restore, 1);
            value hx_cairo_set_source_rgba(value cr, value red, value green, value blue, value alpha) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(red, number);;
        	        		val_check(green, number);;
        	        		val_check(blue, number);;
        	        		val_check(alpha, number);;
        	
        					cairo_set_source_rgba(kind_cairo_t_get(cr), val_get_double(red), val_get_double(green), val_get_double(blue), val_get_double(alpha));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_set_source_rgba, 5);
            value hx_cairo_fill(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_fill(kind_cairo_t_get(cr));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_fill, 1);
            value hx_cairo_stroke(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_stroke(kind_cairo_t_get(cr));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_stroke, 1);
            value hx_cairo_matrix_create() {
        	
        					cairo_matrix_t* _result = cairo_matrix_create();
				return kind_cairo_matrix_t_alloc(_result);
        	        }
        DEFINE_PRIM(hx_cairo_matrix_create, 0);
            value hx_cairo_matrix_init(value matrix, value xx, value yx, value xy, value yy, value x0, value y0) {
        	        		kind_cairo_matrix_t_check(matrix);
        	        		val_check(xx, number);;
        	        		val_check(yx, number);;
        	        		val_check(xy, number);;
        	        		val_check(yy, number);;
        	        		val_check(x0, number);;
        	        		val_check(y0, number);;
        	
        					cairo_matrix_init(kind_cairo_matrix_t_get(matrix), val_get_double(xx), val_get_double(yx), val_get_double(xy), val_get_double(yy), val_get_double(x0), val_get_double(y0));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_matrix_init, 7);
            value hx_cairo_matrix_init_identity(value matrix) {
        	        		kind_cairo_matrix_t_check(matrix);
        	
        					cairo_matrix_init_identity(kind_cairo_matrix_t_get(matrix));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_matrix_init_identity, 1);
            value hx_cairo_matrix_init_translate(value matrix, value tx, value ty) {
        	        		kind_cairo_matrix_t_check(matrix);
        	        		val_check(tx, number);;
        	        		val_check(ty, number);;
        	
        					cairo_matrix_init_translate(kind_cairo_matrix_t_get(matrix), val_get_double(tx), val_get_double(ty));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_matrix_init_translate, 3);
            value hx_cairo_matrix_init_scale(value matrix, value sx, value sy) {
        	        		kind_cairo_matrix_t_check(matrix);
        	        		val_check(sx, number);;
        	        		val_check(sy, number);;
        	
        					cairo_matrix_init_scale(kind_cairo_matrix_t_get(matrix), val_get_double(sx), val_get_double(sy));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_matrix_init_scale, 3);
            value hx_cairo_matrix_init_rotate(value matrix, value radians) {
        	        		kind_cairo_matrix_t_check(matrix);
        	        		val_check(radians, number);;
        	
        					cairo_matrix_init_rotate(kind_cairo_matrix_t_get(matrix), val_get_double(radians));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_matrix_init_rotate, 2);
            value hx_cairo_matrix_translate(value matrix, value tx, value ty) {
        	        		kind_cairo_matrix_t_check(matrix);
        	        		val_check(tx, number);;
        	        		val_check(ty, number);;
        	
        					cairo_matrix_translate(kind_cairo_matrix_t_get(matrix), val_get_double(tx), val_get_double(ty));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_matrix_translate, 3);
            value hx_cairo_matrix_scale(value matrix, value sx, value sy) {
        	        		kind_cairo_matrix_t_check(matrix);
        	        		val_check(sx, number);;
        	        		val_check(sy, number);;
        	
        					cairo_matrix_scale(kind_cairo_matrix_t_get(matrix), val_get_double(sx), val_get_double(sy));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_matrix_scale, 3);
            value hx_cairo_matrix_rotate(value matrix, value radians) {
        	        		kind_cairo_matrix_t_check(matrix);
        	        		val_check(radians, number);;
        	
        					cairo_matrix_rotate(kind_cairo_matrix_t_get(matrix), val_get_double(radians));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_matrix_rotate, 2);
            value hx_cairo_matrix_invert(value matrix) {
        	        		kind_cairo_matrix_t_check(matrix);
        	
        					cairo_status_t _result = cairo_matrix_invert(kind_cairo_matrix_t_get(matrix));
				return alloc_int(_result);
        	        }
        DEFINE_PRIM(hx_cairo_matrix_invert, 1);
            value hx_cairo_matrix_multiply(value result, value a, value b) {
        	        		kind_cairo_matrix_t_check(result);
        	        		kind_cairo_matrix_t_check(a);
        	        		kind_cairo_matrix_t_check(b);
        	
        					cairo_matrix_multiply(kind_cairo_matrix_t_get(result), kind_cairo_matrix_t_get(a), kind_cairo_matrix_t_get(b));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_matrix_multiply, 3);
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
            value hx_cairo_translate(value cr, value tx, value ty) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(tx, number);;
        	        		val_check(ty, number);;
        	
        					cairo_translate(kind_cairo_t_get(cr), val_get_double(tx), val_get_double(ty));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_translate, 3);
            value hx_cairo_scale(value cr, value sx, value sy) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(sx, number);;
        	        		val_check(sy, number);;
        	
        					cairo_scale(kind_cairo_t_get(cr), val_get_double(sx), val_get_double(sy));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_scale, 3);
            value hx_cairo_rotate(value cr, value angle) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(angle, number);;
        	
        					cairo_rotate(kind_cairo_t_get(cr), val_get_double(angle));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_rotate, 2);
            value hx_cairo_transform(value cr, value matrix) {
        	        		kind_cairo_t_check(cr);
        	        		kind_cairo_matrix_t_check(matrix);
        	
        					cairo_transform(kind_cairo_t_get(cr), kind_cairo_matrix_t_get(matrix));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_transform, 2);
            value hx_cairo_set_matrix(value cr, value matrix) {
        	        		kind_cairo_t_check(cr);
        	        		kind_cairo_matrix_t_check(matrix);
        	
        					cairo_set_matrix(kind_cairo_t_get(cr), kind_cairo_matrix_t_get(matrix));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_set_matrix, 2);
            value hx_cairo_get_matrix(value cr, value matrix) {
        	        		kind_cairo_t_check(cr);
        	        		kind_cairo_matrix_t_check(matrix);
        	
        					cairo_get_matrix(kind_cairo_t_get(cr), kind_cairo_matrix_t_get(matrix));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_get_matrix, 2);
            value hx_cairo_identity_matrix(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_identity_matrix(kind_cairo_t_get(cr));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_identity_matrix, 1);
            value hx_cairo_copy_path(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_path_t* _result = cairo_copy_path(kind_cairo_t_get(cr));
				return kind_cairo_path_t_alloc(_result);
        	        }
        DEFINE_PRIM(hx_cairo_copy_path, 1);
            value hx_cairo_copy_path_flat(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_path_t* _result = cairo_copy_path_flat(kind_cairo_t_get(cr));
				return kind_cairo_path_t_alloc(_result);
        	        }
        DEFINE_PRIM(hx_cairo_copy_path_flat, 1);
            value hx_cairo_append_path(value cr, value path) {
        	        		kind_cairo_t_check(cr);
        	        		kind_cairo_path_t_check(path);
        	
        					cairo_append_path(kind_cairo_t_get(cr), kind_cairo_path_t_get(path));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_append_path, 2);
            value hx_cairo_line_to(value cr, value x, value y) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(x, number);;
        	        		val_check(y, number);;
        	
        					cairo_line_to(kind_cairo_t_get(cr), val_get_double(x), val_get_double(y));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_line_to, 3);
            value hx_cairo_move_to(value cr, value x, value y) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(x, number);;
        	        		val_check(y, number);;
        	
        					cairo_move_to(kind_cairo_t_get(cr), val_get_double(x), val_get_double(y));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_move_to, 3);
            value hx_cairo_new_path(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_new_path(kind_cairo_t_get(cr));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_new_path, 1);
            value hx_cairo_new_sub_path(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_new_sub_path(kind_cairo_t_get(cr));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_new_sub_path, 1);
            value hx_cairo_close_path(value cr) {
        	        		kind_cairo_t_check(cr);
        	
        					cairo_close_path(kind_cairo_t_get(cr));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_close_path, 1);
            value hx_cairo_arc(value cr, value xc, value yc, value radius, value angle1, value angle2) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(xc, number);;
        	        		val_check(yc, number);;
        	        		val_check(radius, number);;
        	        		val_check(angle1, number);;
        	        		val_check(angle2, number);;
        	
        					cairo_arc(kind_cairo_t_get(cr), val_get_double(xc), val_get_double(yc), val_get_double(radius), val_get_double(angle1), val_get_double(angle2));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_arc, 6);
            value hx_cairo_arc_negative(value cr, value xc, value yc, value radius, value angle1, value angle2) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(xc, number);;
        	        		val_check(yc, number);;
        	        		val_check(radius, number);;
        	        		val_check(angle1, number);;
        	        		val_check(angle2, number);;
        	
        					cairo_arc_negative(kind_cairo_t_get(cr), val_get_double(xc), val_get_double(yc), val_get_double(radius), val_get_double(angle1), val_get_double(angle2));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_arc_negative, 6);
            value hx_cairo_curve_to(value cr, value x1, value y1, value x2, value y2, value x3, value y3) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(x1, number);;
        	        		val_check(y1, number);;
        	        		val_check(x2, number);;
        	        		val_check(y2, number);;
        	        		val_check(x3, number);;
        	        		val_check(y3, number);;
        	
        					cairo_curve_to(kind_cairo_t_get(cr), val_get_double(x1), val_get_double(y1), val_get_double(x2), val_get_double(y2), val_get_double(x3), val_get_double(y3));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_curve_to, 7);
            value hx_cairo_rectangle(value cr, value x, value y, value width, value height) {
        	        		kind_cairo_t_check(cr);
        	        		val_check(x, number);;
        	        		val_check(y, number);;
        	        		val_check(width, number);;
        	        		val_check(height, number);;
        	
        					cairo_rectangle(kind_cairo_t_get(cr), val_get_double(x), val_get_double(y), val_get_double(width), val_get_double(height));
				return val_null;
        	        }
        DEFINE_PRIM(hx_cairo_rectangle, 5);
            value hx_cairo_pattern_create_rgba(value red, value green, value blue, value alpha) {
        	        		val_check(red, number);;
        	        		val_check(green, number);;
        	        		val_check(blue, number);;
        	        		val_check(alpha, number);;
        	
        					cairo_pattern_t* _result = cairo_pattern_create_rgba(val_get_double(red), val_get_double(green), val_get_double(blue), val_get_double(alpha));
				return kind_cairo_pattern_t_alloc(_result);
        	        }
        DEFINE_PRIM(hx_cairo_pattern_create_rgba, 4);
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
    }


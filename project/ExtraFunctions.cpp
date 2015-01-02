#include <math.h>
#include <stdint.h>

#define ARRAY_LENGTH(a) (sizeof (a) / sizeof (a)[0])

#define _MIN(a, b) (((a) < (b)) ? (a) : (b))

unsigned char* bytedata_ptr(value vv) {
    if (val_is_string(vv)) {
        return (unsigned char *)val_string(vv);
    } else {
        return (unsigned char *)buffer_data(val_to_buffer(vv));
    }
}

int bytedata_size(value vv) {
    if (val_is_string(vv)) {
        return val_strlen(vv);
    } else {
        return buffer_size(val_to_buffer(vv));
    }
}

cairo_status_t cairo_read_stream(void* _reader, unsigned char *data, unsigned int length) {
    value reader = (value)_reader;
    value result = val_call1(reader, alloc_int(length));
    memcpy(data, bytedata_ptr(result), length);
    return CAIRO_STATUS_SUCCESS;
}

cairo_status_t cairo_write_stream(void* _writer, const unsigned char *data, unsigned int length) {
    value writer = (value)_writer;
    buffer outbuffer = alloc_buffer_len(0);
    buffer_append_sub(outbuffer, (const char *)data, length);
    value result = val_call1(writer, buffer_val(outbuffer));
    return (cairo_status_t)val_int(result);
}

value cairo_image_surface_get_data2(cairo_surface_t *surface) {
    int stride = cairo_image_surface_get_stride(surface);
    int height = cairo_image_surface_get_height(surface);
    int size = stride * height;
    unsigned char* data = cairo_image_surface_get_data(surface);
    buffer outbuffer = alloc_buffer_len(0);
    buffer_append_sub(outbuffer, (const char *)data, size);
    return buffer_val(outbuffer);
}

void cairo_image_surface_set_data2(cairo_surface_t *surface, void* _data) {
    value data = (value)_data;
    unsigned char* buffer_ptr = bytedata_ptr(data);
    int buffer_size = bytedata_size(data);
    int stride = cairo_image_surface_get_stride(surface);
    int width = cairo_image_surface_get_width(surface);
    int height = cairo_image_surface_get_height(surface);
    int size = stride * height;
    unsigned char* surface_data = cairo_image_surface_get_data(surface);

    memcpy(surface_data, buffer_ptr, _MIN(buffer_size, size));

    cairo_surface_mark_dirty(surface);
}

#ifndef STATIC_LINK
#define IMPLEMENT_API
#endif

#if defined(HX_WINDOWS) || defined(HX_MACOS) || defined(HX_LINUX)
#define NEKO_COMPATIBLE
#endif

#include <hx/CFFI.h>

#include <string.h>
#include <stdio.h>

#include "cairo/src/cairo.h"
#include "cairo/src/cairo-svg.h"
#include "cairo/src/cairo-pdf.h"

extern "C" {
	#define val_get_float(v) val_get_double(v)

	void dummy_free(void*ptr) { }

	cairo_matrix_t* cairo_matrix_create() {
		return new cairo_matrix_t;
	}

	void cairo_matrix_destroy(cairo_matrix_t* matrix) {
		delete matrix;
	}

    <?php foreach ($abstracts as $abstract) { ?>
		DECLARE_KIND(kind_<?= $abstract->name ?>)
		DEFINE_KIND(kind_<?= $abstract->name ?>)
		void kind_<?= $abstract->name ?>_check(value z) {
			val_check_kind(z, kind_<?= $abstract->name ?>);
		}
		<?= $abstract->name ?>* kind_<?= $abstract->name ?>_get(value z) {
			return ((<?= $abstract->name ?>*)val_get_handle(z, kind_<?= $abstract->name ?>));
		}
		void kind_<?= $abstract->name ?>_destroy(value z) {
			<?= $abstract->destructor ?>(kind_<?= $abstract->name ?>_get(z));
		}
		value kind_<?= $abstract->name ?>_alloc(<?= $abstract->type ?> z) {
	        value abstract_object = alloc_abstract(kind_<?= $abstract->name ?>, z);
	        val_gc(abstract_object, ((hxFinalizer) kind_<?= $abstract->name ?>_destroy));
	        return abstract_object; 
		}

    <?php } ?>

    <?php foreach ($functions as $function) { ?>
        value hx_<?= $function->name ?>(<?php echo implode(', ', array_map(function($a) { return "value {$a->name}"; }, $function->args)); ?>) {
        	<?php foreach ($function->args as $arg) { ?>
        		<?= $arg->check ?>;
        	<?php } ?>

        	<?php if ($function->retval->type == 'void') { ?>
				<?= $function->name ?>(<?php echo implode(', ', array_map(function($a) { return $a->get; }, $function->args)); ?>);
	        	<?php foreach ($function->args as $arg) { ?>
	        		<?= $arg->acheck ?>;
	        	<?php } ?>
				return val_null;
        	<?php } else { ?>
				<?= $function->retval->type ?> _result = <?= $function->name ?>(<?php echo implode(', ', array_map(function($a) { return $a->get; }, $function->args)); ?>);
	        	<?php foreach ($function->args as $arg) { ?>
	        		<?= $arg->acheck ?>;
	        	<?php } ?>
				return <?= $function->retval->alloc('_result') ?>;
        	<?php } ?>
        }
        DEFINE_PRIM(hx_<?= $function->name ?>, <?= count($function->args) ?>);
    <?php } ?>
}


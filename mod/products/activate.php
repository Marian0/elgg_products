<?php
/**
 * Register the ProductEntity class for the object/blog subtype
 */

if (get_subtype_id('object', PRODUCTS_SUBTYPE)) {
	update_subtype('object', PRODUCTS_SUBTYPE, 'ProductEntity');
} else {
	add_subtype('object', PRODUCTS_SUBTYPE, 'ProductEntity');
}

<?php

/**
 * Description of ProductHandler
 *
 * @author german
 */
class ProductHandler {

	public static function prepareFormVars($product = null) {
		// input names => defaults
		$values = array(
			'title' => get_input('title', ''), // bookmarklet support
			'price' => get_input('price', ''),
			'container_guid' => elgg_get_page_owner_guid(),
			'guid' => null,
			'entity' => $product,
		);

		if ($product) {
			foreach (array_keys($values) as $field) {
				if (isset($product->$field)) {
					$values[$field] = $product->$field;
				}
			}
		}

		if (elgg_is_sticky_form('products')) {
			$sticky_values = elgg_get_sticky_values('products');
			foreach ($sticky_values as $key => $value) {
				$values[$key] = $value;
			}
		}

		elgg_clear_sticky_form('products');

		return $values;
	}

	public static function makeStickyForm() {
		elgg_make_sticky_form('products');
	}

}

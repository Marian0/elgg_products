<?php

/**
 * Accion para guardar entidades de productos
 */

$title = get_input('title');
$price = get_input('price');
$guid = (int) get_input('guid');

ProductHandler::makeStickyForm();

try {
	if (empty($title)) {
		throw new Exception(elgg_echo('products:error:empty:title'));
	}
	
	if (empty($price) || !is_numeric($price))  {
		throw new Exception(elgg_echo('products:error:empty:price'));
	}
	
	if ($guid) {
		$product = get_entity($guid);
		
		if (!($product instanceof ProductEntity)) {
			throw new Exception(elgg_echo('products:error:not:product'));
		}
		
	} {
		$product = new ProductEntity();
	}
	
	$product->title = $title;
	$new_guid = $product->save();
	
	if ($new_guid) {
		$product->setPrice($price);
	}
	
	
	system_message(elgg_echo('products:msg:save:success'));
	
	elgg_clear_sticky_form('products');
	
	forward($product->getURL());
	
} catch (Exception $exc) {
	register_error($exc->getMessage());
}


forward(REFERER);
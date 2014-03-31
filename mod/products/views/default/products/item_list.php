<?php
/* @var $product  ProductEntity  */
$product = elgg_extract('entity', $vars);

$metadata = elgg_view_menu('entity', array(
	'entity' => $product,
	'handler' => 'products',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
		));

// brief view
$owner_icon = elgg_view_entity_icon($product->getOwnerEntity(), 'tiny');

$content = '';

$extended_value = elgg_view('products/ext_profile', $vars);

$params = array(
	'entity' => $product,
	'metadata' => $metadata,
	'subtitle' => $extended_value,
	'content' => $content,
);
	
$params = $params + $vars;
$body = elgg_view('object/elements/summary', $params);

echo elgg_view_image_block($owner_icon, $body);

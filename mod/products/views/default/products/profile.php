<?php

$product = elgg_extract('entity', $vars);

//$extra = '';
//if (elgg_view_exists("file/specialcontent/$mime")) {
//	$extra = elgg_view("file/specialcontent/$mime", $vars);
//} else if (elgg_view_exists("file/specialcontent/$base_type/default")) {
//	$extra = elgg_view("file/specialcontent/$base_type/default", $vars);
//}

$metadata = elgg_view_menu('entity', array(
	'entity' => $product,
	'handler' => 'products',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
		));

// brief view
$owner_icon = elgg_view_entity_icon($product->getOwnerEntity(), 'medium');

$params = array(
	'entity' => $product,
	'title' => $product->title,
	'metadata' => $metadata,
//	'subtitle' => $subtitle,
);
$params = $params + $vars;
$summary = elgg_view('object/elements/summary', $params);

$text = '';
//Esta vista no va a existir
$extended_value = elgg_view('products/ext_profile', $vars);

$body = "$text {$extended_value}";

echo elgg_view('object/elements/full', array(
	'entity' => $product,
	'icon' => $owner_icon,
	'summary' => $summary,
	'body' => $body,
));
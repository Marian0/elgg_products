<?php
/**
 * View a product
 *
 * @package Elggproducts
 */


$product = get_entity(get_input('guid'));
if (!$product) {
	register_error(elgg_echo('noaccess'));
	forward('');
}


$title = $product->title;

$content = elgg_view_entity($product, array('full_view' => true));
$content .= elgg_view_comments($product);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
));

echo elgg_view_page($title, $body);

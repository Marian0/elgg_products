<?php
$product = get_entity(get_input('guid'));

if (!($product instanceof ProductEntity)) {
	register_error('Not product');
	forward(REFERER);
}

if (!$product->canEdit()) {
	register_error('Not Access');
	forward(REFERER);
}

$form_vars = array(
	'enctype' => 'multipart/form-data',
//	'action' => elgg_normalize_url('action/products/add'),
);

$form_view_vars = ProductHandler::prepareFormVars($product);

$content = elgg_view_form('products/edit', $form_vars, $form_view_vars);
$title = elgg_echo('products:title:add');

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	));


echo elgg_view_page($title, $body);

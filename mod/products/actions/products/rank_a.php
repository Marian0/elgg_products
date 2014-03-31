<?php

/**
 * Accion para guardar entidades de productos
 */
$guid = (int) get_input('guid');
$vote = (int) get_input('vote');


try {
	if (empty($vote) || !is_numeric($vote)) {
		throw new Exception(elgg_echo('products:error:empty:vote'));
	}

	if ($vote < 0 || $vote > 5) {
		throw new Exception(elgg_echo('products:error:range:out'));
	}

	$product = get_entity($guid);

	if (!($product instanceof ProductEntity)) {
		throw new Exception(elgg_echo('products:error:not:product'));
	}


	//Exists annotation?
	$filter_annotation_options = array(
		'annotation_name' => 'vote',
		'annotation_owner_guid' => elgg_get_logged_in_user_guid(),
		'limit' => 1,
	);

	$vote_annotations = elgg_get_annotations($filter_annotation_options);
	if ($vote_annotations) {
		$annotation = $vote_annotations[0];
		/* @var $annotation ElggAnnotation */
		$annotation->value = $vote;
		$success = $annotation->save();
	} else {
		$success = $product->annotate('vote', $vote);
	}

	

	if ($success) {
		system_message(elgg_echo('products:msg:voting:success'));
	} else {
		throw new Exception(elgg_echo('products:error:voting'));
	}
} catch (Exception $exc) {
	register_error($exc->getMessage());
}


forward(REFERER);

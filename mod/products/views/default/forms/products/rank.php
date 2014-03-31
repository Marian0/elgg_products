<?php
/* @var $product ProductEntity */

$product = elgg_extract('entity', $vars, FALSE);
if (!($product instanceof ProductEntity)) {
	return NULL;
}

$filter_annotation_options = array(
	'annotation_name'	=> 'vote',
	'annotation_owner_guid' => elgg_get_logged_in_user_guid(),
	'limit' => 1,
);

$vote_value = 0;
$vote_annotation = elgg_get_annotations($filter_annotation_options);
if ($vote_annotation) {
	$vote_value = $vote_annotation[0];
}


$option_values = array(
	1 => 'Bad',
	2 => 'Regular',
	3 => 'Good',
	4 => 'Very Good',
	5 => 'Excellent',
);
?>
<div>
<?php
echo elgg_view('input/dropdown', array('name' => 'vote', 'value' => $vote_value->value , 'options_values' => $option_values));
echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $product->getGUID() )); 
echo elgg_view('input/submit', array('name' => 'vote-submit', 'value' => 'Vote!'));

?>
	<span class="feedback"></span>
</div>

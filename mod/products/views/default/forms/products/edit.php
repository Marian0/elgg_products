<?php


$title = elgg_extract('title', $vars, '');
$price = elgg_extract('price', $vars, '');
$guid = (int) elgg_extract('guid', $vars, '');

?>

<div class="products-field-wrapper">
	<label for=""><?php echo elgg_echo("products:form:title") ?></label>
	<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>

<div class="products-field-wrapperå">
	<label for=""><?php echo elgg_echo("products:form:price") ?></label>
	<?php echo elgg_view('input/text', array('name' => 'price', 'value' => $price)); ?>
</div>

<div class="elgg-foot">
	<?php echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid)); ?>
	<?php echo elgg_view('input/submit', array('value' => elgg_echo("save"))); ?>
</div>


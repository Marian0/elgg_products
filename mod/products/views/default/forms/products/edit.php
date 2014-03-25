<?php


$title = elgg_extract('title', $vars, '');
$price = '';

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
	<?php echo elgg_view('input/hidden', array('name' => 'guid', 'value' => 0)); ?>
	<?php echo elgg_view('input/submit', array('value' => elgg_echo("save"))); ?>
</div>


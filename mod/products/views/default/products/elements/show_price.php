<?php
/* @var $product ProductEntity */
$product = elgg_extract('entity', $vars);

?>

<div class="product-price">
	Price: <?php echo $product->getPrice(); ?>
</div>
<?php

/**
 * Description of ProductEntity
 *
 * @author Mariano Peyregne
 * 
 * @property float $price
 */
class ProductEntity extends ElggObject {

	/**
	 * Set subtype to ProductEntity.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = PRODUCTS_SUBTYPE;
		$this->attributes['access_id'] = ACCESS_PUBLIC;
	}
	
	
	/**
	 * Set the product price
	 * @param float $price
	 */
	public function setPrice($price) {
		$price = (float) $price;
		$this->price = number_format($price, 2);
	}
	
	/**
	 * Get the price
	 * 
	 * @return float
	 */
	public function getPrice() {
		return $this->price;
	}
	

}

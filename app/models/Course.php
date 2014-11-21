<?php

class Course extends BaseModel {

	protected $table = 'courses';
	public $timestamps = false;

	public static $relationsData = [
		'hole_items' => [self::HAS_MANY, 'Hole']
	];

	public function toArray() {
		$this->load('hole_items');
		return parent::toArray();
	}

}

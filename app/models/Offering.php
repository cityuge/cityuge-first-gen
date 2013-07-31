<?php

class Offering extends BaseModel {
	public $timestamps = false;

	public function course() {
		return $this->belongsTo('Course');
	}
}
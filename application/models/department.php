<?php

class Department extends Basemodel 
{
	public static $timestamps = false;

	public function courses() {
		return $this->has_many('Course');
	}
}
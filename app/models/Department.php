<?php

class Department extends BaseModel
{
    protected $guarded = array();

    public static $rules = array();

    public $timestamps = false;

    public function courses()
    {
        return $this->hasMany('Course');
    }

}

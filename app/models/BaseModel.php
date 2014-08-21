<?php

class BaseModel extends Eloquent
{
    public function validate($data)
    {
        return Validator::make($data, static::$rules);
    }
}

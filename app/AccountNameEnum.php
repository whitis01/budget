<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountNameEnum extends Model
{
    public static function getAccountNameCollection($id)
    {
        return AccountNameEnum::all()->first(function ($value) use ($id) { // Can be function ($value, $key)
            return $value->id == $id;
        });
    }
}

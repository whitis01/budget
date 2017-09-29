<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryEnum extends Model
{
    public function accountNames()
    {
        return $this->hasMany(AccountNameEnum::class);
    }
}

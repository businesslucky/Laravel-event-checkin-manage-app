<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlusOneList extends Model
{
    //
    protected $table = "plusonelists";
    protected $fillable = ['names','birthday'];
}

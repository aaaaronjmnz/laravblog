<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $table = 'posts'; -> just in case you want to iterate the table name.
    // public $primaryKey = 'item_id'; -> to change the primary key.
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

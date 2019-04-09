<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'client_quantity','description', 'admin'];

    public function clients(){
        return $this->hasMany('App\Client');
    }
}

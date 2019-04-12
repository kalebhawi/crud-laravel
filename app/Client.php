<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'cpf','birthDate', 'address', 'group_id'];

    public function scopeName($query, $name)
    {
        if(!empty($name)){
            $query->where('name','LIKE', "%$name%");
        }
    }
    public function scopeQuantity($query)
    {
        return $query->where('group_id', 1);
    }

    public function phones()
    {
        return $this->hasMany('App\Phone');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'client_quantity','description', 'admin'];

    public function scopeName($query, $name){
        if(!empty($name)){
            $query->where('name','LIKE', "%$name%");
        }
    }

    public function scopeAdmin($query, $id){
        $admin_group = Group::find($id);
        return Client::where('id', $admin_group->admin)->first();
    }

    public function client(){
        return $this->hasMany('App\Client');
    }
}

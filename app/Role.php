<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'roles';
	protected $fillable = [
		'hausmeister',
		'putzfrau',
		'user'
	];
    public function user() {
    	return $this->hasMany('App\User');
    }
}

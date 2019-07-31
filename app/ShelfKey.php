<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShelfKey extends Model
{
	protected $table = 'shelfkeys';
	protected $fillable = [
		'name',
		'description',
		'shelfspace_id'
	];
    public function shelf() {
    	return $this->hasOne('App\Shelfspace');
    }
}

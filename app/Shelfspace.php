<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelfspace extends Model
{
	protected $table = 'shelfspaces';
	protected $fillable = [
		'nummer',
		'key_id'
	];
	public function key() {
		return $this->hasOne('App\ShelfKey');
	}
}

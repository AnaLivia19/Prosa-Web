<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interesse extends Model
{
protected $table = 'interesses';
protected $fillable = ['nome'];

public function users() { return $this->belongsToMany(User::class); }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunidade extends Model
{
protected $table = 'comunidades';
protected $fillable = ['nome', 'descricao', 'user_id'];

public function criador() { return $this->belongsTo(User::class, 'user_id'); }
public function membros() { return $this->belongsToMany(User::class); }
public function eventos() { return $this->hasMany(Evento::class); }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
protected $fillable = ['titulo', 'descricao', 'local', 'data_hora', 'user_id', 'comunidade_id'];
protected $casts = ['data_hora' => 'datetime'];

public function organizador() { return $this->belongsTo(User::class, 'user_id'); }
public function comunidade() { return $this->belongsTo(Comunidade::class); }
public function participantes() { return $this->belongsToMany(User::class); }
}

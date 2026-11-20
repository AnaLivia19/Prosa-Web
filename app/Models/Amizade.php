<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amizade extends Model
{
    protected $table = 'amizades';
    protected $fillable = ['user_id', 'amigo_id', 'status'];

    public function remetente() { return $this->belongsTo(User::class, 'user_id'); }
    public function destinatario() { return $this->belongsTo(User::class, 'amigo_id'); }
}
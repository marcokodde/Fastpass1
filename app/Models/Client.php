<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
    ];


    // Relación con Sesiones
    public function sessions(){
        return $this->hasMany(ClientSession::class);
    }
}

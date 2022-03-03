<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
    ];


    // Sesiones
    public function sessions(){
        return $this->hasMany(ClientSession::class);
    }

    // Garages
    public function garages(): HasMany
    {
        return $this->hasMany(Garage::class);
    }

    /**+------------+
     * | Búsquedas  |
     * +------------+
     */


    public function scopeClientId($query,$valor){
        if(trim($valor) != ""){
            $query->where('client_id',$valor);
        }
     }
}

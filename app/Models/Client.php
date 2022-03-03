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

    // Vehículos sugeridos

    public function suggested_vehicles(){
        return $this->hasMany(SuggestedVehicle::class);
    }

    public function suggested_vehicles_with_downpayment(){
        return $this->hasMany(SuggestedVehicle::class)->where('downpayment_for_next_tier');
    }

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
     * | Apoyo      |
     * +------------+
     */

     // ¿Tiene vehicles_with_downpayment?
    public function has_vehicles_with_downpayment(){
        return $this->suggested_vehicles_with_downpayment->count();
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

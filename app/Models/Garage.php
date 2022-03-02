<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garage extends Model
{
    use HasFactory;
    protected $table = 'garages';
    protected $fillable = [
        'client_id',
    ];


    // Detalle de garages
    public function vehicles_in_garages(): HasMany
    {
        return $this->hasMany(DetailGarage::class);
    }

    /**+------------+
     * | Apoyo      |
     * +------------+
     */


     // Tiene espacio (no importa si es o no de enganche adicional)
     public function has_space(){
        return $this->vehicles_in_garages->count() < ENV('GARAGE_SPACES');
     }

     // Espacios ocupados (No importa si es o no de enganche adicional)
     public function occupied_spaces(){
        return $this->vehicles_in_garages->count();
     }

     // Espacios disponibles (No importa si es o no de enganche adicional)
     public function available_spaces(){
         return ENV('GARAGE_SPACES') - $this->vehicles_in_garages->count();
     }

     // Espacios ocupados (De Enganche Adicional)
     public function occupied_spaces_like_next_tier(){
         return $this->vehicles_in_garages->where('is_additional_next_tier',1)->count();
     }

     // Espacios disponibles para Enganche Adicional
     public function available_spaces_like_next_tier(){
        return ENV('GARAGE_SPACES_TO_NEXT_TIER') - $this->vehicles_in_garages->where('is_additional_next_tier',1)->count();
     }

     // ¿Tiene espacio para vehículo con Enganche Adicional?
     public function has_space_to_next_tier(){
        return $this->vehicles_in_garages->where('is_additional_next_tier',1)->count() < ENV('GARAGE_SPACES_TO_NEXT_TIER');
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

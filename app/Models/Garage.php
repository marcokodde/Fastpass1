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

    public function client(){
        return $this->belongsTo(Client::class);
    }

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
        return $this->occupied_spaces() < ENV('GARAGE_SPACES');
    }

     // Espacios ocupados (No importa si es o no de enganche adicional)
    /**+-----------------------------------------------------------+
      * | Determinar los espacios ocupados del garage               |
      * +-----------------------------------------------------------+
      * | 1.- Se toma el total de vehículos del detalle del garage  |
      * | 2.- Se recorren los vehículos y por cada uno              |
      * |     (a) Si está vendido se "resta 1" al total             |
      * | Al terminar el recorreido se regresa el resultado         |
      * +-----------------------------------------------------------+
      */
    public function occupied_spaces(){
        $total_vehicles_in_garage = $this->vehicles_in_garages->count();
            if($total_vehicles_in_garage){
                foreach($this->vehicles_in_garages as $vehicle_in_garage){
                    if($vehicle_in_garage->inventory->sold_out){
                        $total_vehicles_in_garage--;
                    }
                }
            }
        return $total_vehicles_in_garage;
    }

     // Espacios disponibles (No importa si es o no de enganche adicional)
    public function available_spaces(){
        return ENV('GARAGE_SPACES') - $this->occupied_spaces();
    }

    public function not_available_spaces(){
        return ENV('GARAGE_SPACES') == $this->occupied_spaces();
    }

    // Espacios ocupados (De Enganche Adicional)
    public function occupied_spaces_like_next_tier(){
        return $this->vehicles_in_garages->where('is_additional_next_tier',1)->count();
    }

     // Espacios disponibles para Enganche Adicional
    public function available_spaces_like_next_tier(){
        return ENV('GARAGE_SPACES_TO_NEXT_TIER') - $this->occupied_spaces();
    }

     //Los Espacios Para Vehiculos con Enganche estan ocupados
    public function not_available_spaces_like_next_tier(){
        return ENV('GARAGE_SPACES_TO_NEXT_TIER') == $this->vehicles_in_garages->where('is_additional_next_tier',1)->count();
    }

     // ¿Tiene espacio para vehículo con Enganche Adicional?
    public function has_space_to_next_tier(){
        return $this->vehicles_in_garages->where('is_additional_next_tier',1)->count() < ENV('GARAGE_SPACES_TO_NEXT_TIER');
    }

     // ¿Está o no un vehículo en el garage?
    public function is_vehicle_in_garage($stock){
        foreach($this->vehicles_in_garages()->get() as $vehicle_in_garage){
            if($stock == $vehicle_in_garage->stock){
                return true;
            }
        }
        return false;
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
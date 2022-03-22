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
        return $this->hasMany(DetailGarage::class)->orderby('retail_price');
    }

    // Detalle de garages
    public function vehicles_in_garages_availables(): HasMany
    {
        return $this->hasMany(DetailGarage::class)->where('is_available_inventory', 1)->orderby('retail_price');
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
         $occupied_spaces = $this->vehicles_in_garages->count();
         if($occupied_spaces){
             foreach($this->vehicles_in_garages as $vehicle_in_garage){
                 if($vehicle_in_garage->inventory->sold_out){
                    $occupied_spaces--;
                 }
             }
         }
        return $occupied_spaces;
     }

     // Espacios ocupados que no estan disponibles
     public function occupied_spaces_availables(){
        return $this->vehicles_in_garages_availables->count();
     }

     // Espacios disponibles (No importa si es o no de enganche adicional)
     public function available_spaces(){
         return ENV('GARAGE_SPACES') - $this->occupied_spaces();
     }

    public function not_available_spaces(){
        return ENV('GARAGE_SPACES') == $this->vehicles_in_garages->count();
    }
     // Espacios ocupados (De Enganche Adicional)
     public function occupied_spaces_like_next_tier(){
         return $this->vehicles_in_garages->where('is_additional_next_tier',1)->count();
     }

     // Espacios disponibles para Enganche Adicional
     public function available_spaces_like_next_tier(){
        return ENV('GARAGE_SPACES_TO_NEXT_TIER') - $this->vehicles_in_garages->where('is_additional_next_tier',1)->count();
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
 // ¿Está o no un vehículo en el garage?
 public function is_vehicle_in_garage_available($stock) {
    foreach ($this->vehicles_in_garages()->get() as $vehicle_in_garage) {
        if ($stock == $vehicle_in_garage->stock && $vehicle_in_garage->is_available_inventory) {
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

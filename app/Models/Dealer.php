<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;
    protected $table = 'dealers';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'percentage',
        'open_sunday',
        'hour_opening',
        'hour_closing'
    ];


    // Relación con Autos Sugerido
    public function suggested_vehicles()
    {
        return $this->hasMany(SuggestedVehicle::class);
    }

    /*+-----------------------------------------+
      | Setters y Getters de varios Campos      |
      +-----------------------------------------+
    */
    // Setters
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }


    /**+------------+
     * | Búsquedas  |
     * +------------+
     */

    public function scopeName($query,$valor){
        if(trim($valor) != ""){
            $query->where('name',$valor);
        }
     }


}

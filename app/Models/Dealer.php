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
        'percentage'
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

}

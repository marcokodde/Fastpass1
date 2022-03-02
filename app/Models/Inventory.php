<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'vin',
        'stock',
        'year',
        'make',
        'model',
        'exterior_color',
        'interior_color',
        'mileage',
        'transmission',
        'engine',
        'retail_price',
        'sales_price',
        'options',
        'images',
        'last_updated',
        'body',
        'trim'
    ];

    // Relación con Autos Sugerido a un Cliente
    public function suggested_vehicles()
    {
        return $this->hasMany(SuggestedVehicle::class);
    }



    // Nombre Completo
    public function scopeFullsearch($query,$valor)
    {
        if (trim($valor) != "") {
            $valor =str_replace(' ','%',$valor);
            $query->where(DB::raw("CONCAT(make,model,year, stock)"), 'LIKE', "%$valor%");
        }
    }


    // Por Stock
    public function scopeStock($query,$valor){
        if (trim($valor) != "") {
            $query->where('stock',  $valor);
        }
    }

    // Por VIN
    public function scopeVin($query,$valor){
        if (trim($valor) != "") {
            $query->where('vin',  $valor);
        }
    }

}

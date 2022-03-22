<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';
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
        'trim',
        'available',
        'sold_out'
    ];

    // Relación con Autos Sugerido a un Cliente
    public function suggested_vehicles()
    {
        return $this->hasMany(SuggestedVehicle::class);
    }

    // Detalle de garages
    public function vehicles_in_garages(): HasMany
    {
        return $this->hasMany(DetailGarage::class);
    }

    // Actualiza estado de Vendido
    public function update_sold_out($sold_out = false){
        $this->sold_out = $sold_out;
        $this->save();
    }

    // Nombre Completo
    public function scopeFullsearch($query,$valor)
    {
        if (trim($valor) != "") {
            $valor =str_replace(' ','%',$valor);
            $query->where(DB::raw("CONCAT(make,model,year, stock)"), 'LIKE', "%$valor%");
        }
    }


    // Por Distribuidor
    public function scopeDealerId($query,$valor){
        if (trim($valor) != "") {
            $query->where('dealer_id',  $valor);
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

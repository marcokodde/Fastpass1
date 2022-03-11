<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryInventory extends Model
{
    use HasFactory;
    protected $table = 'temporary_inventories';
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

    /** Búsquedas */

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

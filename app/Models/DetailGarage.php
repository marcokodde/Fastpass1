<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGarage extends Model
{
    use HasFactory;
    protected $table = 'detail_garages';
    public $timestamps = false;
    protected $fillable = [
        'garage_id',
        'inventory_id',
        'sales_price',
        'is_additional_next_tier',
        'is_available_inventory'
    ];

    // Al garage que pertenece
    public function garage(){
        return $this->belongsTo(Garage::class,'garage_id');
    }

    // Al inventario que pertenece
    public function inventory(){
        return $this->belongsTo(Inventory::class,'inventory_id');
    }

    /**+------------+
     * | Búsquedas  |
     * +------------+
     */

    public function scopeGarageId($query,$valor){
        if(trim($valor) != ""){
            $query->where('garage_id',$valor);
        }
    }

    public function scopeInventoryId($query,$valor){
        if(trim($valor) != ""){
            $query->where('inventory_id',$valor);
        }
    }
}

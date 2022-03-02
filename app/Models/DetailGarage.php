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
        'image',
        'last_updated',
        'body',
        'trim',
        'is_additional_next_tier',
        'is_available_inventory',
    ];

    // Al garage que pertenece
    public function garage(){
        return $this->belongsTo(Garage::class,'garage_id');
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
     public function scopeStock($query,$valor){
        if(trim($valor) != ""){
            $query->where('stock',$valor);
        }
     }


}

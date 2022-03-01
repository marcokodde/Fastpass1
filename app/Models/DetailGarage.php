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
        'stock'
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

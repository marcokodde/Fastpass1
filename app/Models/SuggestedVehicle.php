<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestedVehicle extends Model
{
    use HasFactory;
    protected $table = 'suggested_vehicles';
    public $timestamps = false;
    protected $fillable = [
        'client_id',
        'inventory_id',
        'grade',
        'downpayment_for_next_tier'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

    /**+------------+
     * | Apoyo      |
     * +------------+
     */

    // ¿es de enganche adicional?
    public function is_addional_downpayment(){
        return $this->downpayment_for_next_tier > 0 ? true : false;
    }

    /**+------------+
     * | Búsquedas  |
     * +------------+
     */

    public function scopeClientId($query,$client_id){

        if ($client_id) {
            $query->where('client_id',  $client_id);
        }
    }

    /** Del vehículo en particular por Id Inventario */
    public function scopeInventoryId($query,$inventory_id){
        if($inventory_id){
            $query->where('inventory_id',$inventory_id);
        }

    }

    // Menor o igual a un enganche adicional
    public function scopeDownPayment($query,$downpayment=250){
        $query->where('downpayment_for_next_tier', '<=', $downpayment)
              ->where('downpayment_for_next_tier', '>',0);
    }

    // De un grado
    public function scopeGrade($query,$valor)
    {
        if (trim($valor) != "") {
            $query->where('grade',  $valor);
        }
    }

    // Aprobados
    public function scopeApproved($query){
        $query->where('downpayment_for_next_tier', 0);
    }
}

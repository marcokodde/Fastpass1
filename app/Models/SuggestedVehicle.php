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
        'dealer_id',
        'client_id',
        'inventory_id',
        'sale_price',
        'grade',
        'downpayment_for_next_tier'
    ];


    // Distribuidor
    public function dealer(){
        return $this->belongsTo(Dealer::class);
    }

    // Cliente
    public function client(){
        return $this->belongsTo(Client::class);
    }

    // Inventario
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

    // ¿Mostrar o no según enganches y porcentaje del distribuidor)
    public function showByTotalDownPayment($from,$to){

        $price_min_by_dealer =  intdiv($this->sale_price * $this->dealer->percentage,100);

        //return'% Dealer=' . $this->dealer->percentage . ' Precio=' . $this->sale_price . ' Min Dowpayment=' . $price_min_by_dealer;
       // dd('% Dealer=' . $this->dealer->percentage . ' Precio=' . $this->sale_price . ' Min Dowpayment=' . $price_min_by_dealer);
        for($from;$from <= $to;$from = $from+env('APP_ADDITIONAL_DOWNPAYMENT_STEP ')){

                if($from + $to >= $price_min_by_dealer){
                    return true;
                }
        }

       return false;
    }

    /**+------------+
     * | Búsquedas  |
     * +------------+
     */


    public function scopeDealerId($query,$dealer_id){
        if ($dealer_id) {
            $query->where('dealer_id',  $dealer_id);
        }
    }

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


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
        'downpayment_for_next_tier',
        'show_like_additional'
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

    /**+--------------------------------------------+
     * | Decidir si se muestra o no el vehículo     |
     * +--------------------------------------------+
     * | 1) Calcular precios del vehículo           |
     * |    a) Mínimo                               |
     * |    b) Máximo                               |
     * | 2) Comparar si el precio del vehículo      |
     * |    está en el rango de precio min y max    |
     * +--------------------------------------------+
     */
    // Actualiza campo para mostrar como adicional
    public function update_show_like_additional($value=false){
        // if($from = env('APP_ADDITIONAL_DOWNPAYMENT_MIN',500)){
        //     $downpayment_total_min = $downpayment_initial_client;
        // }else{
        //     $downpayment_total_min = $downpayment_initial_client + $from;
        // }

        // $downpayment_total_max  = $downpayment_initial_client + $to;
        // $downpayment_min_vehicle      = intdiv($this->sale_price * $this->dealer->percentage,100);
    //     dd('Precio=' .$this->sale_price . ' % dealer=' . $this->dealer->percentage .
    //         ' Enganche Mínimo=' . $downpayment_min_vehicle . ' Inicial=' . $downpayment_initial_client .
    //         ' Desde=' . $from . ' Hasta=' . $to . ' Total Min=' . $downpayment_total_min  .
    //         ' Total Max=' .  $downpayment_total_max
    //  );
        $this->show_like_additional = $value;
        $this->save();

        // if($downpayment_min_vehicle >= $downpayment_total_min && $downpayment_min_vehicle <=$downpayment_total_max){
        //     dd('Si está dentro del rango');
        //     $this->show_like_additional = true;
        //     $this->save();
        // }


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
        $query->where('downpayment_for_next_tier', '>=', $downpayment)
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


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


    /** Búsquedas */

    public function scopeClientId($query,$valor){

        if (trim($valor) != "") {
            $query->where('client_id',  $valor);
        }
    }

    // Menor o igual a un enganche adicional
    public function scopeDownPayment($query,$valor=250){
        $query->where('client_id', '<=', $valor);
    }

    // De un grado
    public function scopeGrade($query,$valor)
    {
        if (trim($valor) != "") {
            $query->where('grade',  $valor);
        }
    }
}

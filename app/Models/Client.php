<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $fillable = [
        'client_id',
       ' downpayment',
        'loggin_times',
        'date_at'
    ];

      // Vehículos sugeridos

    public function suggested_vehicles(){
        return $this->hasMany(SuggestedVehicle::class,'client_id')
                    ->orderby('sale_price');
    }

    public function suggested_vehicles_with_downpayment(){
        return $this->hasMany(SuggestedVehicle::class,'client_id')
                    ->where('downpayment_for_next_tier','>',0)
                    ->orderby('sale_price');
    }

    // Aprobados por Neo
    public function suggested_vehicles_approved(){
        return $this->hasMany(SuggestedVehicle::class,'client_id')
                    ->where('downpayment_for_next_tier','=',0)
                    ->orderby('sale_price');
    }

    // Sesiones
    public function sessions(){
        return $this->hasMany(ClientSession::class);
    }

    // Sesión con token
    public function session_with_token(){
        return $this->sessions->whereNotNull('token')->where('active')->first();
    }
    // Garages
    public function garages(): HasMany
    {
        return $this->hasMany(Garage::class);
    }

    /**+------------+
     * | Apoyo      |
     * +------------+
     */

     // ¿Tiene vehicles_with_downpayment?
    public function has_vehicles_with_downpayment(){
        return $this->suggested_vehicles_with_downpayment->count();
    }

    // ¿Tiene vehículos autorizados por defecto?
    public function has_vehicles_approved(){
        return $this->suggested_vehicles_approved->count();
    }

    // Incrementa las veces que ha entrado
    public function update_loggin_times(){
        $this->loggin_times++;
        $this->save();
    }

    // Incrementa las veces que ha entrado
    public function update_times_loggin(){
        $this->times_loggin++;
        $this->save();
    }

    // Incrementa las veces que ha expirado sesión
    public function update_expired_sessions(){
        $this->expired_sessions++;
        $this->save();
    }

    // Actualiza las sesiones Activas
    public function update_active_sessions($type = 'input'){

        $this->active_sessions = $type == 'input' ? $this->active_sessions++ : $this->active_sessions--;
        $this->active_sessions =   $this->active_sessions < 0  ? $this->active_sessions=0 : $this->active_sessions;
        $this->save();
    }



    /**+------------+
     * | Búsquedas  |
     * +------------+
     */


    public function scopeClientId($query,$valor){
        if(trim($valor) != ""){
            $query->where('client_id',$valor);
        }
     }
}

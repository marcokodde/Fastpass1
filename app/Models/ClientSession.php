<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSession extends Model
{
    use HasFactory;
    protected $table = 'client_sessions';
    protected $fillable = [
        'client_id',
        'token',
        'start_at',
        'expire_at',
        'generated_by_system',
        'active'
    ];

    /**+------------+
     * | Relaciones |
     * +------------+
     */

     public function client(){
         return $this->belongsTo(Client::class);
     }



     // ¿Está expirada?
     public function is_expired(){
        return  Carbon::now()->diffInMinutes($this->start_at) >= env('SESSION_INTERVAL');
     }

     // Expira la sesión
    public function expire_session(){
            $this->active = 0;
            $this->save();
    }

    /**+------------+
     * | Búsquedas  |
     * +------------+
     */


     public function scopeClientId($query,$valor){
        if($valor){
            $query->where('client_id',$valor);
        }
     }

     public function scopeToken($query,$valor){
        if(trim($valor) != ""){
            $query->where('token',$valor);
        }
     }

     public function scopeActive($query,$valor = true){
         $query->where('active',$valor);
     }

     public function scopeExpired($query){
         $query->where('expire_at','<',now());
     }




}

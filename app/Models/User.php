<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shipmentid',
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shipments()
    {
        return $this->hasMany(Shipments::class,'customer_id', 'id')->with('status','rate','shipcourier');
    }



    public static function boot()
    {

        parent::boot();
        static::creating(function($model){
            // $shipmentid = User::latest()->first()->shipmentid + 1;
            // dd($shipmentid);

              $model->number = User::latest()->max('number')+ 1;
            $model->shipmentid= 'EZL' . '-' . str_pad($model->number, 5, '0', STR_PAD_LEFT);
                   // $model->shipmentid = 'RPL' . '-' . str_pad($shipmentid, 5, '0', STR_PAD_LEFT);
        });
    }
}

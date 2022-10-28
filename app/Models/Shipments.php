<?php

namespace App\Models;

use App\Traits\Multitenntfilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipments extends Model
{
    use HasFactory, SoftDeletes;
    use Multitenntfilter;
    protected $fillable = [
        'Status',
        'status_id',
        'date',
        'shipper',
        'shipper_id',
        'description',
        'customer_id',
        'rate_id',
        'consignee',
        'courier',
        'courier_id',
        'pieces',
        'weight',
        'volume',
        'tracking_number',
        'number',
        'shipment_number',
        'freight'
    ];

    public function shipper()
    {
        return $this->belongsTo(Shipper::class,'');
    }
    public function packagetype()
    {
        return $this->belongsTo(PackageType::class,'package_type_id');
    }
    public function shipstatus()
    {
        return $this->belongsToMany(Status::class, 'shipments_status','shipment_id','status_id')->withPivot('created_at');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }
    public function shipcourier()
    {
        return $this->belongsTo(Carrier::class, 'carrier_id');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function prealert()
    {
        return $this->belongsTo(Prealert::class);
    }

    public static function boot()
    {

        parent::boot();
      static::creating(function($model){

        $s = Shipments::select('id')->latest('id')->max('id');
        $id = $s + 1;

            $model->number = Shipments::latest('number')->max('number') + 1;

            $model->shipment_number = 'RPL' . '-' . str_pad($model->number, 5, '0', STR_PAD_LEFT);

          Status::find(1)->shipmentsStatus()->attach($id);
        });

    }

}

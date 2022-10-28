<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Status
 *
 * @property $id
 * @property $name
 * @property $persentage
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Status extends Model
{
    use SoftDeletes;

    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','percentage'];

    public function shipments()
    {
        return $this->hasMany(Shipments::class,'status_id','id');
    }


    public function shipmentsStatus()
    {
        return $this->belongsToMany(Shipments::class, 'shipments_status','status_id','shipment_id')->withTimestamps();
    }

}

<?php
namespace App\Traits;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;

trait Multitenntfilter {
    public static function bootMultitenntfilter(){

            if(auth()->check()){

                static::creating(function ($modal){
                    $modal->customer_id = auth()->id();
                });
                static::addGlobalScope('customer_id',function(Builder  $Builder){
                    if(auth()->check()){
                        return $Builder->where('customer_id', auth()->id());
                    }
                });
            }

    }
}

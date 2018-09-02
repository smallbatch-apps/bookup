<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 22/4/18
 * Time: 12:54 AM
 */


namespace App;


use Webpatser\Uuid\Uuid;

trait HasUuid
{

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }


}
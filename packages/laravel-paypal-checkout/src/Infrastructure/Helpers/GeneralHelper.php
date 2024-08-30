<?php

namespace Arneon\LaravelPaypalCheckout\Infrastructure\Helpers;

trait GeneralHelper
{
    public function setEntityValuesToModel($model, $entityArray)
    {
        foreach ($model->getFillable() as $field)
        {
            if(array_key_exists($field, $entityArray))
            {
                $model->{$field} = $entityArray[$field];
            }
        }
        return $model;
    }
}

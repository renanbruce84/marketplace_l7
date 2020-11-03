<?php

namespace App\Traits;

trait RealPriceTrait
{
    private function realPrice($product)
    {
        return str_replace(['.', ','], ['', '.'], $product);        
    }
}

<?php

function filtersItemsByStoreId(array $items, $storeId)
{
    return array_filter($items, function ($line) use ($storeId) {
        return $line['store_id'] == $storeId;
    });
}

// Utilizado para recuperar o valor de $price para formato para realizar os cálculos numéricos
function priceToDatabase($price)
{    
    return str_replace(['.', ','], ['', '.'], $price);   
}
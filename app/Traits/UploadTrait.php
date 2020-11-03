<?php

namespace App\Traits;

trait Uploadtrait
{
    private function imageUpload($images, $imageColumn = null)
    {
        $uploadedImages = array();

        if (!is_null($imageColumn)) {
            foreach ($images as $image) {
                // store('nome da pasta', 'local da pasta de acordo com filesystems.php');
                $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
            }
        } else {
            // store('nome da pasta', 'local da pasta de acordo com filesystems.php');
            $uploadedImages = $images->store('logo', 'public');
        }

        return $uploadedImages;
    }
}

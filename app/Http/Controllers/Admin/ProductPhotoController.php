<?php

namespace App\Http\Controllers\Admin;

use App\ProductPhoto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function remove($photoName)
    {
        // Remover dos arquivos
        $photoPath = 'products/'.$photoName;

        if (Storage::disk('public')->exists($photoPath)) {
            Storage::disk('public')->delete($photoPath);
        }
        
        // Remover a imagem do banco de dados
        $removePhoto = ProductPhoto::where('image', $photoPath);
        $removePhoto->delete();

        flash('Imagem removida com sucesso')->success();

        return redirect()->back();
    }
}

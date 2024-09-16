<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Repair extends Model
{
    use HasFactory;

    public function handleUploadImage($image)
    {
        $file = $image;
        $name = time() . $file->getClientOriginalName();
        /*$file->move(public_path('/img/products/', $name));*/
        Storage::putFileAs('/public/repairs/', $file, $name, 'public');
        return $name;
    }

    protected $fillable = ['fullname', 'dni', 'phone', 'location', 'vehicle', 'image_path', 'type_repair', 'price', 'details'];
}

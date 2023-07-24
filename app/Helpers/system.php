<?php

function uploadFile($nameForder, $file)
{
    $fileName = time() . '_' . $file->getClientOriginalName();
    return $file->storeAs($nameForder, $fileName, 'public');
}

function resizeImage($tables, $width, $height) {
    foreach ($tables as $table) {
        if ($table->image) {
            $imagePath = public_path('storage/' . $table->image);
            $resizedImage = Image::make($imagePath)->resize($width, $height);
            $resizedImage->save($imagePath);

            // $table->save();
        }
    }
}


function resizeImageProduct($tables, $width, $height)
{
    foreach ($tables as $table) {
        if ($table->image) {
            $imagePath = public_path('storage/' . $table->image);
            $resizeImageProduct = Image::make($imagePath)->resize($width, $height);
            $resizeImageProductPath = public_path('storage//images/resized_products_detail/' . $table->image);
            // dd($resizeImageProductPath);
            $resizeImageProduct->save($resizeImageProductPath);

            // $table->save();
        }
    }
} 

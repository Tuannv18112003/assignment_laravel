<?php

function uploadFile($nameForder, $file)
{
    $fileName = time() . '_' . $file->getClientOriginalName();
    return $file->storeAs($nameForder, $fileName, 'public');
}

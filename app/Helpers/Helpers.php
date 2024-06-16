<?php

use Illuminate\Support\Facades\Storage;

if(function_exists("uploadFile")){
    function uploadFile($file,$path){
        $fileName = str()::uuid().'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->put($path.$fileName,$file->getContent());
        return $fileName;
    }
    
}
<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if(!function_exists("uploadFile")){
    function uploadFile($file,$path){
        $fileName =Str::uuid().'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->put($path.$fileName,$file->getContent());
        return $fileName;
    }
    
}
if(!function_exists("deleteFile")){
    function deleteFile($path,$fileName){
        Storage::disk('public')->delete($path.$fileName);
    }
    
}
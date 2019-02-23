<?php 
namespace App;

use DB;
use File;
use Image;

class ImageUpload
{

    public static function upload($path,$image,$prefix)
    {
        $imageName = $prefix.'-'.time().'-'.str_random(5).'.'.$image->getClientOriginalExtension();
        $upload_image = Image::make($image->getRealPath())->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        
        $upload_image->save(public_path($path).'/'.$imageName);
        return $imageName;
    }

    public static function uploadThumbnail($path, $image, $width, $height, $prefix='thumb')
    {
        return Image::make(public_path($path).'/'.$image)->fit($width,$height)->save(public_path($path).'/'.$prefix.'-'.$image);
    }

    public static function removeFile($path,$image,$image_thum,$resize='')
    {   
        if(File::exists(public_path($path))){
            File::delete(public_path($path.$image));
            File::delete(public_path($path.$image_thum));

            if($resize != ''){
               File::delete(public_path($path.$resize));                
            }
        }
    }
}

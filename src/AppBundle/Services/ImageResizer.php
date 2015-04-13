<?php
namespace AppBundle\Services;

use abeautifulsite\SimpleImage;

class ImageResizer{   
    public function generateImages($image){
       $img=new SimpleImage($image->getPathToImages('originals') . DIRECTORY_SEPARATOR . $image->getFilename());
        $img->best_fit(600, 600)->save($image->getPathToImages('mediums') . DIRECTORY_SEPARATOR . $image->getFilename());
        $img->best_fit(400, 400)->thumbnail(60)->desaturate()->save($image->getPathToImages('thumbnails') . DIRECTORY_SEPARATOR . $image->getFilename(), 95);
    }
}
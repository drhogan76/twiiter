<?php

namespace Collage\Repository\CollageGenerate;

use Collage\Service\Connection\ConnectionTwitApi;


class EloquentCollage implements CollageInterface
{     
    
    public function getData($array)    {       
        $conn = ConnectionTwitApi::connection();
        $result = $conn->get("friends/list", array("screen_name" => $array['name'], "count" => 100));
         $urlsAvatarArr = [];
        foreach ($result->users as $friend) {
            $urlsAvatarArr[] = array('name' => $friend->name, 'url' => $friend->profile_image_url);
        }        
        return $this->generateCollage($urlsAvatarArr);
    }
    
    private function generateCollage($urlsAvatarArr)
    {         
        $montage_image = imagecreatetruecolor(1000, 1000);
        $back = imagecolorallocate($montage_image, 255, 255, 255);
        $border = imagecolorallocate($montage_image, 0, 0, 0);
        imagefilledrectangle($montage_image, 0, 0, 1000 - 1, 1000 - 1, $back);
        imagerectangle($montage_image, 0, 0, 1000 - 1, 1000 - 1, $border);

        $x_index = 0;
        $y_index = 0;
        foreach ($urlsAvatarArr as $gif_image_url) {           
            $current_image = imagecreatefromstring(file_get_contents($gif_image_url['url']));
            imagecopyresampled($montage_image, $current_image, $x_index * 100, $y_index * 100, 0, 0, 100, 100, imagesx($current_image), imagesy($current_image));
            imagedestroy($current_image);
            $x_index++;
            if ($x_index > 10) {
                $x_index = 0;
                $y_index++;
            }
        }
        
        return $montage_image;
    }
}


<?php

use Abraham\TwitterOAuth\TwitterOAuth;
use Collage\Repository\CollageGenerate\CollageInterface;
use Collage\Service\Validator\Coll\PixelsCollage;
use Collage\Service\Validator\Coll\AvatarsCollage;

class HomeController extends BaseController {

    protected $avatarsValidator;
    protected $pixelsValidator;
    protected $collage;

    public function __construct(PixelsCollage $pixelsCollage, AvatarsCollage $avatarsCollage, CollageInterface $collage) {
        $this->avatarsValidator = $avatarsCollage;
        $this->pixelsValidator = $pixelsCollage;
        $this->collage = $collage;
    }

    public function sdad() {
        $connection = new TwitterOAuth("lRNqACRubp3B4xwp6xJYqNlKG", "JhYy0kfnsk6qx6NJr9YmYnw5P7CJQ98b3IG1Us29BnBbX4qhkI", "3645803356-4POu9u8M2Hw8eTVtXYDwVmnJP01JLkPfEW1KaXO", "ts7bNA6bKlXa6QyX3hUc3JUIt1NfpMxar1VBNULMpIwza");
        //$statues = $connection->get("users/show", array("screen_name" => "mark_feygin"));
        $friendList = $connection->get("friends/list", array("screen_name" => "mark_feygin", "count" => 100));
        //dd($statues);
        //dd($friendList);
        $urlsAvatarArr = [];
        foreach ($friendList->users as $friend) {
            $urlsAvatarArr[] = array('name' => $friend->name, 'url' => $friend->profile_image_url);
        }
        //dd(substr_replace($urlsAvatarArr[0]['url'], '200x200', strpos($urlsAvatarArr[0]['url'], 'normal'), 6));
        //$image = imagecreatefromstring(file_get_contents($urlsAvatarArr[0]['url']));
        $montage_image = imagecreatetruecolor(1000, 1000);
        $back = imagecolorallocate($montage_image, 255, 255, 255);
        $border = imagecolorallocate($montage_image, 0, 0, 0);
        imagefilledrectangle($montage_image, 0, 0, 1000 - 1, 1000 - 1, $back);
        imagerectangle($montage_image, 0, 0, 1000 - 1, 1000 - 1, $border);

        $x_index = 0;
        $y_index = 0;
        foreach ($urlsAvatarArr as $gif_image_url) {
            /* $current_image = substr_replace($gif_image_url['url'], 'reasonably_small', strpos($gif_image_url['url'], 'normal'), 6);
              $current_image = imagecreatefromstring(file_get_contents($current_image)); */
            $current_image = imagecreatefromstring(file_get_contents($gif_image_url['url']));
            imagecopyresampled($montage_image, $current_image, $x_index * 100, $y_index * 100, 0, 0, 100, 100, imagesx($current_image), imagesy($current_image));
            imagedestroy($current_image);
            $x_index++;
            if ($x_index > 10) {
                $x_index = 0;
                $y_index++;
            }
        }

        header('Content-Type: image/jpeg');
        imagejpeg($montage_image, null, 100);
        imagedestroy($montage_image);
        // imagejpeg($image);
        //imagedestroy($image);
        /*        header("Content-type: image/png");
          $gd = new GDResource();
          $gd->resource = $image; */

        // $imanee = new Imanee($image); //using the shortcut
        // imagedestroy($image);
        //$imanee->setResource($image);
        // imagepng($gd->getResource());
        //echo $gd->output('jpeg');
        //$size = filesize($imanee);
        //dd($urlsAvatarArr);
        //echo imagepng(imagecreatefrompng($urlsAvatarArr[0]['url']));
        /* $response = Response::make($imanee->output(), 200);
          $response->header('Content-Type', 'image/png');

          return $response; */
    }

    public function createCollage() {
        $inputs = Session::get('inputs');
        $montage_image = $this->collage->getData($inputs);
        header('Content-Type: image/jpeg');
        imagejpeg($montage_image, null, 100);
        imagedestroy($montage_image);
    }

    public function showWelcome() {
        if (Request::IsMethod('post')) {
            $inputs = Input::only(array('name', 'width', 'height'));
            $dimestion = Input::get('dimension');
            if ($dimestion == 'pixel') {
                if (!$this->pixelsValidator->with($inputs)->passes()) {
                    $errors = $this->pixelsValidator->errors();
                } else {
                    return Redirect::to('/collage')->with('inputs', $inputs);
                }
            } else {
                if (!$this->avatarsValidator->with($inputs)->passes()) {
                    $errors = $this->avatarsValidator->errors();
                } else {
                    return Redirect::to('/collage')->with('inputs', $inputs);
                }
            }
            return Redirect::back()->withInput()->withErrors($errors);
        }
        return View::make('home.index');
    }

}

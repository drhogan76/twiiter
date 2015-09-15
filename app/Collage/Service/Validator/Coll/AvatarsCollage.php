<?php

namespace Collage\Service\Validator\Coll;

class AvatarsCollage extends AbstractCollageValidator {

    protected static $message = array(
        "width.between" => "Width value between 1 to 10 avatars",
        "height.between" => "Height value between 1 to 10 avatars",
    );
    protected static $rules = array(
        'width' => array("required", "integer", "between:1,10"),
        'height' => array("required", "integer", "between:1,10"),
    );
    
    protected function getRules() {
        return parent::$rules + self::$rules;
    }

    protected function getMessages() {
        return parent::$message + self::$message;
    }
   
}

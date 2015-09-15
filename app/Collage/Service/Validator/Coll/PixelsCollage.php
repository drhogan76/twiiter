<?php

namespace Collage\Service\Validator\Coll;

class PixelsCollage extends AbstractCollageValidator {

    protected static $message = array(
        "width.between" => "Width value between 200 to 1000 pixels",
        "height.between" => "Height value between 200 to 1000 pixels",
    );
    protected static $rules = array(
        'width' => array("required", "integer", "between:200,1000"),
        'height' => array("required", "integer", "between:200,1000"),
    );

    protected function getRules() {
        return parent::$rules + self::$rules;
    }

    protected function getMessages() {
        return parent::$message + self::$message;
    }

}

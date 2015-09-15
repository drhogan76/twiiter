<?php

namespace Collage\Service\Validator\Coll;

use Collage\Service\Validator\AbstractValidator;

class AbstractCollageValidator extends AbstractValidator
{
    protected static $message = array (
        "name.required" => "Name is reqiured",
        "width.required" => "Width is reqiured",
        "height.required" => "Height is reqiured",
    );
    
    protected static $rules = array (
        "name" => array("required"),      
    );
}


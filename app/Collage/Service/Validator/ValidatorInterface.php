<?php

namespace Collage\Service\Validator;

interface ValidatorInterface
{
    public function errors();
    public function passes();
    public function with(array $data);
    
}

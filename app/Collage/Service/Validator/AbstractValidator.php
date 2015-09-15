<?php
namespace Collage\Service\Validator;

use Illuminate\Validation\Factory as Validator;

class AbstractValidator implements ValidatorInterface
{
	protected $validator;
	protected static $data = array();
	protected static $errors = array();
	protected static $rules = array();
	protected static $messages = array();

	public function __construct(Validator $validator)
	{
		$this->validator = $validator;
	}
	
	public function with(array $data)
	{
		static::$data = $data;

		return $this;
	}
	
	public function passes()
	{
		static::$errors = array();

		$validator = $this->makeValidator();

		if ($validator->fails())
		{
			static::$errors = $validator->messages()->toArray();
			
			return false;
		}

		return true;
	}

	public function errors()
	{
		return static::$errors;
	}

	protected function makeValidator()
	{
		return $this->validator->make(
			$this->getData(),
			$this->getRules(),
			$this->getMessages()
		);
	}

	protected function getData()
	{
		return static::$data;
	}

	protected function getRules()
	{
		return static::$rules;
	}

	protected function getMessages()
	{
		return static::$messages;
	}
}

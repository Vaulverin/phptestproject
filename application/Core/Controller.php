<?php
class Controller {
	
	public $model;
	public $view;
	public $validateVars;
	public $errors = array();

	public function __construct()
	{
		$this->validateVars['id'] = new ValidateSettings( FILTER_VALIDATE_INT, array());
		$this->validateVars['name'] = new ValidateSettings( FILTER_SANITIZE_STRING, array());
		$this->validateVars['message'] = new ValidateSettings( FILTER_SANITIZE_FULL_SPECIAL_CHARS, array());
		$this->validateVars['email'] = new ValidateSettings( FILTER_VALIDATE_EMAIL, array());
		$this->validateVars['imageSrc'] = new ValidateSettings( FILTER_SANITIZE_URL, array());
		$this->validateVars['status'] = new ValidateSettings( FILTER_VALIDATE_INT, array());
		$this->view = new View();
		$_SESSION['access'] = $_SESSION['access'] ?? false;
	}

	final public function Validate($data, $keys = null) : array
	{
		$tempVars = array();
		$errors = array();
		if ($keys != null)
			foreach ($keys as $key) {
				if (isset($this->validateVars[$key]))
					$tempVars[$key] = $this->validateVars[$key];
				else
				{
					array_push($errors, $key);
					$this->errors[$key] = "Key doesn't exist in validateVars!";
				}
			}
		else
			$tempVars = $this->validateVars;
		foreach($tempVars as $property=>$filter)
		{
			$filterResult = filter_var($data[$property], $tempVars[$property]->Filter, $tempVars[$property]->Options);
			if ($filterResult === false)
			{
				array_push($errors, $property);
				$this->errors[$property] = "Filter error!";
			}
			else
				$data[$property] = $filterResult;
		}
		return $errors;
	}
}

class ValidateSettings
{
	public $Filter;
	public $Options;

	public function __construct(int $filter, array $options)
	{
		$this->Filter = $filter;
		$this->Options = $options;
	}
}
<?php
	require_once "base.class.php";
	class client extends base{

		public function __construct($fields = array()){
			parent::__construct();  			//call connection

			$this->table 	= 'users';		//some default values
			$this->fieldPK 	= 'id';

			if(sizeof($fields) <= 0){			//get values to fields_values
				$this->fields_values = array(	//set default values
					'name' => NULL,
					'lastName' => NULL
				);
			}else{
				$this->fields_values = $fields;
			}
			
		}
	}
?>
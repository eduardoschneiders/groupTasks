<?php

	class Util {

		public function printPre($var = NULL){
			echo '<pre>';
			print_r($var);
			echo '</pre>';
			return $html;
		}

		public function redirect($location = NULL){
			echo '<script>window.location="' . $location . '"</script>';
		}

	}

$util = new Util();
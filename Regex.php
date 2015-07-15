<?php
	namespace UnbutterflyPHP ;

	class Regex{
		private $_expression ;

		public function __construct($expressionIn){
			$this->$_expression = $expressionIn ;
		}

		public function Display(){
			echo $this->_expression.'<br>' ;
		}

		public function Execute($targetIn){
			return preg_match($_expression, $targetIn) ;
		}
	}
?>
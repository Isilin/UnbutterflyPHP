<?php
	namespace UnbutterflyPHP ;

	class Scaling{
		private $_type ;

		public function __construct($expressionIn){
			$this->_type = $expressionIn ;
		}

		public function Execute($targetIn){
			switch($this->_type){
				case 'INT' :
					return is_int($targetIn) ;
					break ;
				case 'STR' :
					return is_string($targetIn) ;
					break ;
				case 'BOOL' :
					return is_bool($targetIn) ;
					break ;
				case 'FLOAT' :
					return is_float($targetIn) ;
					break ;
				case 'ARRAY' :
					return is_array($targetIn) ;
					break ;
				default :
					return is_a($targetIn, $this->_type) ;
					break ;
			}
		}
	}
?>
<?php
	namespace UnbutterflyPHP ;

	class Expression{
		private $_target ;
		private $_expression ;
		private $_typeExpression ;
		private $_valid ;

		public function __construct($expressionIn){
			$this->_valid = TRUE ;

			if(strpos($expressionIn, '##') !== FALSE){
				$this->_typeExpression = '##' ;
			} else if(strpos($expressionIn, '->') !== FALSE){
				$this->_typeExpression = '->' ;
			} else if(strpos($expressionIn, '\'') !== FALSE){
				$this->_typeExpression = '\'' ;
			} else{
				$this->_typeExpression = '' ;
				$this->_valid = FALSE ;
			}

			if(!empty($this->_typeExpression)){
				$this->_target = strstr($expressionIn, $this->_typeExpression, TRUE) ;
				$this->_expression = strstr($expressionIn, $this->_target.$this->_typeExpression) ;
			} else{
				$this->_target = '' ;
				$this->_expression = '' ;
			}
		}

		public function IsValid(){
			return $this->_valid ;
		}

		public function Display(){
			echo $this->_target.' : ['.$this->_typeExpression.'] '.$this->_expression.'<br>' ;
		}
	}
?>
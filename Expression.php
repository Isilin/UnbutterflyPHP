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

			if($this->_valid){
				$this->_target = strstr($expressionIn, $this->_typeExpression, TRUE) ;
				$this->_expression = strstr($expressionIn, $this->_target.$this->_typeExpression) ;
			} else{
				$this->_target = '' ;
				$this->_expression = '' ;
			}

			/* vérifier validité expression */
			switch($this->_typeExpression){
				case '##' :
					require_once('Regex.php') ;
					$this->_expression = new \UnbutterflyPHP\Regex($this->_expression) ;
					break ;
				case '->' :
					require_once('Scaling.php') ;
					$this->_expression = new \UnbutterflyPHP\Scaling($this->_expression) ;
					break ;
				case '\'' :
					require_once('Arithmetic.php') ;
					$this->_expression = new \UnbutterflyPHP\Arithmetic($this->_expression) ;
					break ;
				default :
					break ;
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
<?php
	namespace UnbutterflyPHP ;

	class Arithmetic{
		private $_value ;
		private $_operator ;
		private $_leftOperand ;
		private $_rightOperand ;

		public function __construct($expressionIn){
			if(is_numeric($expressionIn) || (substr($expressionIn, 0, 1) === '$' && strpos($expressionIn, ' ') === FALSE)){
				$this->_value = $expressionIn ;
				$this->_operator = NULL ;
				$this->_leftOperand = NULL ;
				$this->_rightOperand = NULL ;
			} else{
				$value = NULL ;
				if(substr($expressionIn, 0, 1) === '('){
					$leftOperand = substr(strstr($expressionIn, ')', TRUE), 1) ;
					$this->_leftOperand = new Arithmetic($leftOperand) ;
					if(strlen($expressionIn) > strlen($leftOperand) + 2){
						$this->_operator = substr(strstr($expressionIn, ')'), 2, 1) ;
						$this->_rightOperand = new Arithmetic(substr(strstr($expressionIn, ')'), 4)) ;
					} else{
						$this->_operator = NULL ;
						$this->_rightOperand = NULL ;
					}
				} else{
					$leftOperand = strstr($expressionIn, ' ', TRUE) ;
					$this->_leftOperand = new Arithmetic($leftOperand) ;
					if(strlen($expressionIn) > strlen($leftOperand) + 2){
						$this->_operator = substr(strstr($expressionIn, ' '), 1, 1) ;
						$this->_rightOperand = new Arithmetic(substr(strstr($expressionIn, ' '), 2)) ;
					} else{
						$this->_operator = NULL ;
						$this->_rightOperand = NULL ;
					}
				}
			}
		}

		public function Display(){
			if(!is_null($this->_value)){
				echo $this->_value ;
			} else{
				echo '(' ;
				if(!is_null($this->_leftOperand)){
					$this->_leftOperand->Display() ;
				}
				echo ')' ;
				if(!is_null($this->_leftOperand) && !is_null($this->_rightOperand)){
					echo ' '.$this->_operator.' ' ;
				}
				echo '(' ;
				if(!is_null($this->_rightOperand)){
					$this->_rightOperand->Display() ;
				}
				echo ')' ;
			}
		}

		public function Execute(){
			$args = func_get_args() ;
			if(is_array($args[0])){
				$args = $args[0] ;
			}
			if(!is_null($this->_value)){
				if(substr($this->_value, 0, 1) === '$'){
					return $args[intval(substr($this->_value, 1))] ;
				} else{
					return $this->_value ;
				}
			} else{
				switch($this->_operator){
					case '+' :
						return $this->_leftOperand->Execute($args) + $this->_rightOperand->Execute($args) ;
						break ;
					case '-' :
						return $this->_leftOperand->Execute($args) - $this->_rightOperand->Execute($args) ;
						break ;
					case '*' :
						return $this->_leftOperand->Execute($args) * $this->_rightOperand->Execute($args) ;
						break ;
					case '/' :
						return $this->_leftOperand->Execute($args) / $this->_rightOperand->Execute($args) ;
						break ;
					case '%' :
						return $this->_leftOperand->Execute($args) % $this->_rightOperand->Execute($args) ;
						break ;
					case '<' :
						return $this->_leftOperand->Execute($args) < $this->_rightOperand->Execute($args) ;
						break ;
					case '>' :
						return $this->_leftOperand->Execute($args) > $this->_rightOperand->Execute($args) ;
						break ;
					case '=' :
						return $this->_leftOperand->Execute($args) == $this->_rightOperand->Execute($args) ;
						break ;
				}
			}
		}
	}
?>
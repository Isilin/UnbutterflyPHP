<?php
	namespace UnbutterflyPHP ;

	require_once('Expression.php') ;

	abstract class Butterflyable{
		private $_methods ;
		private $_invariantClass ;

		public function __construct($instanceIn){
			$this->_methods = get_class_methods($instanceIn) ;
			$this->_methods = array_diff($this->_methods, get_class_methods(get_parent_class($instanceIn))) ;

			$this->_invariantClass = array() ;
		}

		/* Add an invariant of class */
		public function InvariantClass($expressionIn){
			$expression = new \UnbutterflyPHP\Expression($expressionIn) ;
			if($expression->IsValid()){
				array_push($this->_invariantClass, $expression) ;
			} else{
				echo 'The following expression : '.$expressionIn.' is not valid and was not processed.<br>' ;
			}
		}

		/* Fixe type for a property */
		public function InvariantAttribute($namePropertyIn, $typeIn){
			$this->InvariantClass($namePropertyIn.'->'.$typeIn) ;
		}

		/* Check the invariants */
		public function CheckInvariants(){
			$check = TRUE ;
			foreach($this->_invariantClass as $key => $value) {
				$check = $check && $this->CheckExpression($value) ;
			}
			return $check ;
		}

		/* Check if the instance follow the invariant */
		private function CheckExpression($expressionIn){
			return FALSE ;
		}
	}

	class Complexe extends Butterflyable{
		private $_real ;
		private $_imaginary ;

		public function __construct($iIn, $jIn){
			parent::__construct($this) ;
			parent::InvariantAttribute('_real', 'INT') ;
			parent::InvariantAttribute('_imaginary', 'INT') ;

			$this->_real = $iIn ;
			$this->_imaginary = $jIn ;
		}

		public function Display(){
			echo $this->_imaginary.'i + '.$this->_real ;
		}

		public function Add($rightOperantIn){
			$this->_real += $rightOperantIn->GetReal() ;
			$this->_imaginary += $rightOperantIn->GetImaginary() ;
		}

		public function Sub($rightOperantIn){
			$this->_real -= $rightOperantIn->GetReal() ;
			$this->_imaginary -= $rightOperantIn->GetImaginary() ;
		}
	}
?>
# UnbutterflyPHP

## 1. What's about UnbutterflyPHP


This little library is made to help you to write unary test in your PHP script. It permits to avoid any redundances in your code and aid your test.

## 2. How it works


To use UnbutterflyPHP, you just have to inherit from *Butterflyable* class.
Like this :


    class MyClass extends Butterflyable{
    }


Then, you have to add all your unary tests, aka invariants in the constructor, and the checks in your method :


    class MyClass extends Butterflyable{
        private $property1 ;
        public $property2 ;
        protected $property3 ;

        public function __construct(){
            parent::__construct($this) ;
            parent::InvariantClass($expression) ;
            parent::InvariantAttribute($type) ;
            ...
            /* construct */
        }

        public function MyFunction1(){
            parent::Prerequite() ;
            ...
            /* execution */
            parent::Check() ;
            ...
        }
    }


## 3. Expression


There are three types of expression allowed to add an invariant.

### 1. Scaling


Scaling is an expression to fixe the type of a property.
The model is `[propertyName]->[properyType]`


    class MyClass extends Butterflyable{
        private $property1 ;

        public function __construct(){
            parent::__construct($this) ;
            parent::InvariantClass("property1->INT") ;
        }
    }


Typse allowed are 'INT', 'STR', 'BOOL', 'FLOAT', 'ARRAY', and every class name.

### 2. Arithmetic


Arithmetic is an expression of mathematic tests.
You can use '+', '-', '*', '/', '%' operators of computation and '<', '>', '=' operators of comparison. '(' and ')' are allowed to priority computation.
The syntax is `[propertyName]'[arithmetic]'`.


    class MyClass extends Butterflyable{
        private $property1 ;

        public function __construct(){
            parent::__construct($this) ;
            parent::InvariantClass("property1'1 < $0 < 3'") ;
        }
    }

### 3. Regex


Regex is a php regex.
Yo use it, the syntax is `[propertyName]##[regex]##`.


    class MyClass extends Butterflyable{
        private $property1 ;

        public function __construct(){
            parent::__construct($this) ;
            parent::InvariantClass("property1##[0-9a-z]##") ;
        }
    }

## 4. Parameters


$0 is the target property. And you can use all the other $X as parameters.
    
    parent::InvariantClass("property1'1 < $0 < $1'") ;
    parent::Check(3) ; /* tests if 1 < $this->property1 < 3 */
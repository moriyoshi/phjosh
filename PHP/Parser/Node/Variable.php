<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_Variable extends PHP_Parser_Node {
    public $arg;

    public function __construct($lineno, $col, $arg) {
        parent::__construct($lineno, $col);
        $this->arg = $arg;
    }

    public function accept($visitor) {
        $visitor->visitVariable($this); 
    }
}



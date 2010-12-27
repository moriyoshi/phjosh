<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_IfStatement extends PHP_Parser_Node {
    public $condition;
    public $statements;
    public $otherwise;

    public function __construct($lineno, $col, $condition = false, $statements = array(), $otherwise = false) {
        parent::__construct($lineno, $col);
        $this->condition = $condition;
        $this->statements = $statements;
        $this->otherwise = $otherwise;
    }

    public function accept($visitor) {
        $visitor->visitIfStatement($this); 
    }
}



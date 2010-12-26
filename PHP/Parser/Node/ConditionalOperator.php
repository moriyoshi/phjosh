<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_ConditionalOperator extends PHP_Parser_Node {
    public $op;
    public $lhs;
    public $rhs;

    public function __construct($lineno, $col, $condition = false, $true = false, $false = false) {
        parent::__construct($lineno, $col);
        $this->condition = $condition;
        $this->true = $true;
        $this->false = $false;
    }

    public function accept($visitor) {
        $visitor->visitConditionalOperator($this); 
    }
}



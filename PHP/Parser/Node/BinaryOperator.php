<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_Operator extends PHP_Parser_Node {
    public $op;
    public $lhs;
    public $rhs;

    public function __construct($lineno, $col, $op, $lhs, $rhs) {
        parent::__construct($lineno, $col);
        $this->op = $op;
        $this->lhs = $lhs;
        $this->rhs = $rhs;
    }

    public function accept($visitor) {
        $visitor->visitOperator($this); 
    }
}



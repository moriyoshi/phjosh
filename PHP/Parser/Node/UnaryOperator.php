<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_UnaryOperator extends PHP_Parser_Node {
    public $op;
    public $operand;

    public function __construct($lineno, $col, $op, $operand) {
        parent::__construct($lineno, $col);
        $this->op = $op;
        $this->operand = $operand;
    }

    public function accept($visitor) {
        $visitor->visitUnaryOperator($this); 
    }
}

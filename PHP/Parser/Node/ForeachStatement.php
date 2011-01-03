<?php
require_once 'PHP/Parser/Node/Statement.php';

class PHP_Parser_Node_ForeachStatement extends PHP_Parser_Node_Statement {
    public $target;
    public $key;
    public $value;
    public $statements;

    public function __construct($lineno, $col, $target = false, $key = false, $value = false, $statements = array()) {
        parent::__construct($lineno, $col);
        $this->target = $target;
        $this->key = $key;
        $this->value = $value;
        $this->statements = $statements;
    }

    public function accept($visitor) {
        $visitor->visitForeachStatement($this); 
    }
}



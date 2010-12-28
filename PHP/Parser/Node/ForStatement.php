<?php
require_once 'PHP/Parser/Node/Statement.php';

class PHP_Parser_Node_ForStatement extends PHP_Parser_Node_Statement {
    public $initial;
    public $condition;
    public $next;
    public $statements;

    public function __construct($lineno, $col, $initial = false, $condition = false, $next = false, $statements = array()) {
        parent::__construct($lineno, $col);
        $this->initial = $initial;
        $this->condition = $condition;
        $this->next = $next;
        $this->statements = $statements;
    }

    public function accept($visitor) {
        $visitor->visitForStatement($this); 
    }
}




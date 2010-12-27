<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_Statements extends PHP_Parser_Node {
    public $statements = array();

    public function __construct($statements) {
        parent::__construct();
        assert(is_array($statements));
        $this->statements = $statements;
    }

    public function accept($visitor) {
        $visitor->visitStatements($this);
    }
}


<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_Dereference extends PHP_Parser_Node {
    public $referencee;
    public $var;

    public function __construct($lineno, $col, $referencee, $var) {
        parent::__construct($lineno, $col);
        $this->referencee = $referencee;
        $this->var = $var;
    }
}



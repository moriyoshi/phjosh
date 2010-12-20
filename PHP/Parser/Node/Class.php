<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_Class extends PHP_Parser_Node {
    public $name = "";
	public $flags = 0;
    public $extends = false;
	public $implements = array();
    public $statements = array();

    public function __construct($lineno, $col) {
        parent::__construct($lineno, $col);
    }

    public function accept($visitor) {
        $visitor->visitClass($this); 
    }
}

<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_Function extends PHP_Parser_Node {
	public $name = "";
	public $flags = 0;
	public $return_ref = false;
    public $statements = array();
    public $arguments = array();
    public $doc_comment = "";

    public function __construct($lineno, $col) {
        parent::__construct($lineno, $col);
    }

    public function accept($visitor) {
        $visitor->visitFunction($this); 
    }
}


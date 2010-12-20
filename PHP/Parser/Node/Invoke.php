<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_Invoke extends PHP_Parser_Node {
	public $name = "";
	public $object = false;
	public $dynamic = false;
    public $arguments = array();

    public function __construct($lineno, $col) {
        parent::__construct($lineno, $col);
    }

    public function accept($visitor) {
        $visitor->visitInvoke($this); 
    }
}



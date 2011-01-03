<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_Array extends PHP_Parser_Node {
    public $items = array();

    public function __construct($lineno, $col) {
        parent::__construct($lineno, $col);
    }

    public function accept($visitor) {
        $visitor->visitArray($this); 
    }
}



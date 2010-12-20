<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_String extends PHP_Parser_Node {
    public $image;

    public function __construct($lineno, $col, $image) {
        parent::__construct($lineno, $col);
        $this->image = $image;
    }

    public function accept($visitor) {
        $visitor->visitString($this); 
    }
}


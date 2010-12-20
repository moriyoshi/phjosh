<?php
require_once 'PHP/Parser/Node.php';

class PHP_Parser_Node_Number extends PHP_Parser_Node {
    public $image;
    public $integer;

    public function __construct($lineno, $col, $image, $integer) {
        parent::__construct($lineno, $col);
        $this->image = $image;
        $this->integer = $integer;
    }

    public function accept($visitor) {
        $visitor->visitNumber($this); 
    }
}



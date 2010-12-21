<?php

class PHP_Parser_Node {
    public $lineno;
    public $col;
    public $EA = false;
    public $op_type = false;
	public $constant = false;

    public function __construct($lineno = 0, $col = 0) {
        $this->lineno = $lineno;
        $this->col = $col;
    }

    public function accept($visitor) {
        throw new Exception("not implemented");
    }
}

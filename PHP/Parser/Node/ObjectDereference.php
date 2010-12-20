<?php
require_once 'PHP/Parser/Node/Dereference.php';

class PHP_Parser_Node_ObjectDereference extends PHP_Parser_Node_Dereference {
    public function accept($visitor) {
        $visitor->visitObjectDereference($this); 
    }
}



<?php
/**
 * doc comment
 */
class Foo {
    /**
     * constructor
     */
    function __construct($param) {
        $this->param = $param;
    }

    function test($a, $b) {
        return $this->param + $a + $b;
    }
}
?>

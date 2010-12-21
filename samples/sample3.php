<?php
class Foo {
    function __construct($param) {
        $this->param = $param;
    }

    function test($a, $b) {
        return $this->param + $a + $b;
    }
}
?>

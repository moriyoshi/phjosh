<?php
require_once 'PHP/Parser/Base.php';

class PHP_Parser extends PHP_Parser_Base {
    public $handler;

    public function __construct($handler) {
        $this->handler = $handler;
    }

    public function yyerror($msg) {
        fprintf(STDERR, "%s in %s on line %d column %d\n", $msg, $this->lex->filename, $this->lex->last[0], $this->lex->last[1]);
    }
}

?>

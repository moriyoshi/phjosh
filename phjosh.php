#!/usr/bin/env php
<?php
set_include_path(get_include_path(). PATH_SEPARATOR. dirname(__FILE__));
require_once 'PHP/Tokenizer.php';
require_once 'PHP/Parser.php';
require_once 'PHP/Parser/Handler.php';
require_once 'PHP/Parser/Emitter.php';
require_once 'Phjosh/Buffer.php';
require_once 'Phjosh/JSBuilder.php';

$lex = new PHP_Tokenizer(file_get_contents($argv[1]));
$emitter = new PHP_Parser_Emitter($lex);
$parser = new PHP_Parser($emitter);
$parser->yyparse($lex);
$buffer = new Phjosh_Buffer();
$builder = new Phjosh_JSBuilder($buffer);
$emitter->getTopStatements()->accept($builder);
echo $buffer;

exit(0);
?>

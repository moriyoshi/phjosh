#!/usr/bin/env php
<?php
set_include_path(get_include_path(). PATH_SEPARATOR. dirname(__FILE__));
require_once 'PHP/Tokenizer.php';
require_once 'PHP/Parser.php';
require_once 'PHP/Parser/Handler.php';
require_once 'PHP/Parser/Emitter.php';
require_once 'Phjosh/Buffer.php';
require_once 'Phjosh/JSBuilder.php';

$emitter = new PHP_Parser_Emitter();
$lex = new PHP_Tokenizer(file_get_contents($argv[1]));
$parser = new PHP_Parser($emitter);
$parser->yyparse($lex);
$buffer = new Phjosh_Buffer();
$builder = new Phjosh_JSBuilder($buffer);
$builder->visitStatements($emitter->statements);
echo $buffer;

exit(0);
?>

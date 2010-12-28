<?php
require_once 'PHP/Parser/Node/ArrayDereference.php';
require_once 'PHP/Parser/Node/Class.php';
require_once 'PHP/Parser/Node/ConditionalOperator.php';
require_once 'PHP/Parser/Node/Constant.php';
require_once 'PHP/Parser/Node/Echo.php';
require_once 'PHP/Parser/Node/Function.php';
require_once 'PHP/Parser/Node/IfStatement.php';
require_once 'PHP/Parser/Node/Include.php';
require_once 'PHP/Parser/Node/Invoke.php';
require_once 'PHP/Parser/Node/Number.php';
require_once 'PHP/Parser/Node/ObjectDereference.php';
require_once 'PHP/Parser/Node/BinaryOperator.php';
require_once 'PHP/Parser/Node/UnaryOperator.php';
require_once 'PHP/Parser/Node/Return.php';
require_once 'PHP/Parser/Node/String.php';
require_once 'PHP/Parser/Node/Symbol.php';
require_once 'PHP/Parser/Node/Variable.php';
require_once 'PHP/Parser/Node/VariableName.php';

interface PHP_Parser_NodeVisitor {
    function visitArrayDereference($node);

    function visitClass($node);

    function visitEcho($node);

    function visitFunction($node);

    function visitInclude($node);

    function visitInvoke($node);

    function visitNumber($node);

    function visitObjectDereference($node);

    function visitBinaryOperator($node);

    function visitUnaryOperator($node);

    function visitReturn($node);

    function visitString($node);

    function visitVariableName($node);

    function visitSymbol($node);

    function visitVariable($node);

    function visitConstant($node);

    function visitConditionalOperator($node);

    function visitIfStatement($node);

    function visitForStatement($node);

    function visitStatements($node);
}

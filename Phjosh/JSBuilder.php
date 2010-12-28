<?php
require_once 'PHP/Parser/NodeVisitor.php';

class Phjosh_JSBuilder implements PHP_Parser_NodeVisitor {
    public $include_functions = array(
        ZEND_INCLUDE => "include",
        ZEND_INCLUDE_ONCE => "include",
        ZEND_REQUIRE => "require",
        ZEND_REQUIRE_ONCE => "require"
    );

    public function __construct($buffer) {
        $this->buffer = $buffer;
    }

    public function visitArrayDereference($node) {}

    public function visitClass($node) {
        $buffer = $this->buffer;
        if ($node->doc_comment)
            $buffer->putln(self::normalizeDocComment($node->doc_comment));
        $buffer->putln(sprintf("var %s = function() { this.__class__ = callee; this.__construct.apply(this, arguments); };", $node->name));
        if ($node->extends) {
            $buffer->putln(sprintf("%s.prototype = new %s();", $node->extends));
        }
        foreach ($node->statements as $n => $statement) {
            if ($statement instanceof PHP_Parser_Node_Function) {
                if ($statement->doc_comment)
                    $buffer->putln(self::normalizeDocComment($statement->doc_comment));
                $buffer->put(sprintf("%s.prototype.%s = ", $node->name, $statement->name));
                $this->visitFunctionBody($statement);
                $buffer->putln(";\n");
            }
        }
    }

    public function visitFunctionBody($node) {
        $buffer = $this->buffer;
        $arguments = array();
        foreach ($node->arguments as $argument)
            $arguments[] = $argument['variable']->arg->image;
        $buffer->putln(sprintf("function(%s) {", implode(', ', $arguments)));
        $buffer->indent();
        $this->renderStatements($node->statements);
        $buffer->dedent();
        $buffer->put("}");
    }

    public function visitEcho($node) {
        $this->buffer->put("document.write(");
        $node->arg->accept($this);
        $this->buffer->put(")");
    }

    public function visitFunction($node) {
        if ($node->doc_comment)
            $buffer->putln(self::normalizeDocComment($node->doc_comment));
        $this->buffer->put(sprintf("var %s = ", $node->name));
        $this->visitFunctionBody($node);
    }

    public function visitStatements($node) {
        if (!($node instanceof PHP_Parser_Node_Statements))
            throw new Exception();
        foreach ($node->statements as $node) {
            $node->accept($this);
            if (!($node instanceof PHP_Parser_Node_Statement))
                $this->buffer->putln(";");
            if ($node instanceof PHP_Parser_Node_Function)
                $this->buffer->putln("");
        }
    }

    public function visitInclude($node) {
        $this->buffer->put($this->include_functions[$node->type]);
        $this->buffer->put("(");
        $node->arg->accept($this);
        $this->buffer->put(")");
    }

    public function visitInvoke($node) {
        $buffer = $this->buffer;
        if ($node->object) {
            $node->object->accept($this);
            $buffer->put(".");
        }
        $buffer->put($node->name->image);
        $buffer->put("(");
        $first = true;
        foreach ($node->arguments as $argument) {
            if (!$first)
                $buffer->put(", ");
            $argument['value']->accept($this);
            $first = false;
        }
        $buffer->put(")");
    }

    public function visitNumber($node) {
        $this->buffer->put($node->image);
    }

    public function visitObjectDereference($node) {
        $node->referencee->accept($this);
        $this->buffer->put(".");
        $this->buffer->put($node->var->image);
    }

    public function visitBinaryOperator($node) {
        static $op_map = array(
            ZEND_ADD => "+",
            ZEND_SUB => "-",
            ZEND_MUL => "*",
            ZEND_DIV => "/",
            ZEND_MOD => "%",
            ZEND_SL => "<<",
            ZEND_SR => ">>",
            ZEND_CONCAT => "+",
            ZEND_BW_OR => "|",
            ZEND_BW_AND => "&",
            ZEND_BW_XOR => "^",
            ZEND_BOOL_XOR => "^",
            ZEND_IS_IDENTICAL => "===",
            ZEND_IS_NOT_IDENTICAL => "!==",
            ZEND_IS_EQUAL => "==",
            ZEND_IS_NOT_EQUAL => "!=",
            ZEND_IS_SMALLER => "<",
            ZEND_IS_SMALLER_OR_EQUAL => "<=",
            ZEND_ASSIGN => "=",
        );
        $node->lhs->accept($this);
        $this->buffer->put(" {$op_map[$node->op]} ");
        $node->rhs->accept($this);
    }

    public function visitUnaryOperator($node) {
        switch ($node->op) {
        case ZEND_POST_INC:
            $node->operand->accept($this);
            $this->buffer->put("++");
            break;
        case ZEND_POST_DEC:
            $node->operand->accept($this);
            $this->buffer->put("--");
            break;
        default:
            static $op_map = array(
                ZEND_BW_NOT => "~",
                ZEND_BOOL_NOT => "!",
                ZEND_PRE_INC => "++",
                ZEND_PRE_DEC => "--",
            );
            $this->buffer->put("{$op_map[$node->op]}");
            $node->operand->accept($this);
        }
    }


    public function visitReturn($node) {
        $this->buffer->put("return");
        if ($node->arg) {
            $this->buffer->put(" ");
            $node->arg->accept($this);
        }
    }

    public function visitString($node) {
        $this->buffer->put("\"");
        $this->buffer->put(self::escape($node->image));
        $this->buffer->put("\"");
    }

    public function visitSymbol($node) {
        $this->buffer->put($node->image);
    }

    public function visitVariableName($node) {
        $this->buffer->put($node->image);
    }

    public function visitVariable($node) {
        if ($node->arg instanceof PHP_Parser_Node_VariableName) {
            $this->buffer->put($node->arg->image);
        } else {
            $this->buffer->put("$(");
            $node->arg->accept($this);
            $this->buffer->put(")");
        }
    }

    public function visitConstant($node) {
        $this->buffer->put($node->arg->image);
    }

    public function visitConditionalOperator($node) {
        $node->condition->accept($this);
        $this->buffer->put(" ? ");
        $node->true->accept($this);
        $this->buffer->put(" : ");
        $node->false->accept($this);
    }

    public function renderStatements($node) {
        if ($node instanceof PHP_Parser_Node_Statements) {
            $node->accept($this);
        } else {
            $node->accept($this);
            if (!($node instanceof PHP_Parser_Node_Statement))
                $this->buffer->putln(";");
        }
    }

    public function visitIfStatement($node) {
        $this->buffer->put("if (");
        $node->condition->accept($this);
        $this->buffer->putln(") {");
        $this->buffer->indent();
        $this->renderStatements($node->statements);
        $this->buffer->dedent();
        if ($node->otherwise) {
            if ($node->otherwise instanceof PHP_Parser_Node_IfStatement) {
                $this->buffer->put("} else ");
                $node->otherwise->accept($this);
            } else {
                $this->buffer->putln("} else {");
                $this->buffer->indent();
                $this->renderStatements($node->otherwise);
                $this->buffer->dedent();
                $this->buffer->putln("}");
            }
        }
    }

    public function visitForStatement($node) {
        $this->buffer->put("for (");
        $node->initial->accept($this);
        $this->buffer->put("; ");
        $node->condition->accept($this);
        $this->buffer->put("; ");
        $node->next->accept($this);
        $this->buffer->putln(") {");
        $this->buffer->indent();
        $this->renderStatements($node->statements);
        $this->buffer->dedent();
        $this->buffer->putln("}");
    }

    private static function normalizeDocComment($str) {
        return preg_replace('/^[ \t]* \*/m', ' *', $str);
    }

    private static function escape($str) {
        return preg_replace("/([\\x00-\\x1f])/e", 'oct(ord($l))', addcslashes($str, "'\"\\\b\f\n\r\t\x7f"));
    }
}

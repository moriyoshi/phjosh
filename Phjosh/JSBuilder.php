<?php
require_once 'PHP/Parser/NodeVisitor.php';

class Phjosh_JSBuilder implements PHP_Parser_NodeVisitor {
    public function __construct($buffer) {
        $this->buffer = $buffer;
    }

    public function visitArrayDereference($node) {}

    public function visitClass($node) {
        $buffer = $this->buffer;
        $buffer->putln(sprintf("var %s = function() { this.__class__ = callee; this.__construct.apply(this, arguments); };", $node->name));
        if ($node->extends) {
            $buffer->putln(sprintf("%s.prototype = new %s();", $node->extends));
        }
        foreach ($node->statements as $n => $statement) {
            if ($statement instanceof PHP_Parser_Node_Function) {
                $arguments = array();
                foreach ($statement->arguments as $argument) {
                    var_dump($argument);
                    $arguments[] = substr($argument['variable']->arg->image, 1);
                }
                $buffer->putln(sprintf("%s.prototype.%s = function(%s) {", $node->name, $statement->name, implode(', ', $arguments)));
                $buffer->indent();
                $this->visitStatements($statement->statements);
                $buffer->dedent();
                $buffer->put("}");
                $buffer->putln(";");
            }
        }
    }

    public function visitEcho($node) {
        $this->buffer->put("document.write(");
        $node->arg->accept($this);
        $this->buffer->put(")");
    }

    public function visitFunction($node) {
        $arguments = array();
        $buffer = $this->buffer;
        foreach ($node->arguments as $argument) {
            $arguments[] = substr($argument['variable']->arg->image, 1);
        }
        $buffer->putln(sprintf("var %s = function(%s) {", $node->name, implode(', ', $arguments)));
        $buffer->indent();
        $this->visitStatements($node->statements);
        $buffer->dedent();
        $buffer->put("}");
    }
    

    public function visitStatements($nodes) {
        foreach ($nodes as $node) {
            $node->accept($this);
            $this->buffer->putln(";");
        }
    }

    public function visitInclude($node) {}

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

    public function visitOperator($node) {
        $op_map = array(
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
            ZEND_BW_NOT => "~",
            ZEND_BOOL_NOT => "!",
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

    public function visitReturn($node) {
        $this->buffer->put("return");
        if ($node->arg) {
            $this->buffer->put(" ");
            $node->arg->accept($this);
        }
    }

    public function visitString($node) {
        $this->buffer->put($node->image);
    }

    public function visitVariable($node) {
        $this->buffer->put(substr($node->arg->image, 1));
    }
}

<?php

require_once 'PHP/Parser/Handler.php';
require_once 'PHP/Parser/Node/Include.php';
require_once 'PHP/Parser/Node/Class.php';
require_once 'PHP/Parser/Node/Function.php';
require_once 'PHP/Parser/Node/Variable.php';
require_once 'PHP/Parser/Node/Operator.php';
require_once 'PHP/Parser/Node/Return.php';
require_once 'PHP/Parser/Node/Echo.php';
require_once 'PHP/Parser/Node/ObjectDereference.php';
require_once 'PHP/Parser/Node/ArrayDereference.php';
require_once 'PHP/Parser/Node/Invoke.php';

class PHP_Parser_Emitter implements PHP_Parser_Handler {
    public $statements = false;
    private $pending = false;
    private $statements_stack = array();
    private $pending_stack = array();
    private $object_stack = array();
    public $access_type = false;

    public function __construct() {
        $this->statements = array();
    }

    private function push_statements() {
        $this->statements_stack[] = $this->statements;
        $this->statements = array();
    }

    private function pop_statements() {
        $this->statements = array_pop($this->statements_stack);
    }

    private function push_pending() {
        $this->pending_stack[] = $this->pending;
        $this->pending = false;
    }

    private function pop_pending() {
        $this->pending = array_pop($this->pending_stack);
    }

    public function check_writable_variable() {}

    public function add_to_list() {}

    public function add_trait_alias() {}

    public function add_trait_precedence() {}

    public function do_abstract_method() {}

    public function do_add_array_element() {}

    public function do_add_list_element() {}

    public function do_add_static_array_element() {}

    public function do_add_string() {}

    public function do_assign(&$retval, $lhs, $rhs) {
        $retval = new PHP_Parser_Node_Operator($lhs->lineno, $lhs->col, ZEND_ASSIGN, $lhs, $rhs);
    }

    public function do_begin_catch() {}

    public function do_begin_class_declaration($type, $name, $extends) {
        $this->push_pending();
        $this->push_statements();
        $this->pending = new PHP_Parser_Node_Class($name->lineno, $name->col);
        $this->pending->name = $name->image;
        $this->pending->flags = $type->EA;
        $this->pending->extends = $extends->op_type == IS_UNUSED ? false: $extends->image;
    }

    public function do_begin_class_member_function_call() {}

    public function do_begin_function_call($name) {
        $this->push_pending();
        $this->pending = array();
        return false;
    }

    public function do_begin_function_declaration($function_node, $name, $is_method, $return_ref, $flags) {
        $this->push_pending();
        $this->push_statements();
        $this->pending = new PHP_Parser_Node_Function($function_node->lineno, $function_node->col);
        $this->pending->name = $name->image;
        $this->pending->return_ref = $return_ref == ZEND_RETURN_REF;
        $this->pending->flags = $flags->constant;
    }

    public function do_begin_lambda_function_declaration() {}

    public function do_begin_method_call($deref_node) {
        $this->push_pending();
        $this->pending = array();
    }

    public function do_begin_namespace() {}
    public function do_begin_new_object() {}
    public function do_begin_qm_op() {}
    public function do_begin_silence() {}
    public function do_begin_variable_parse() {}

    public function do_binary_op($op, &$retval, $lhs, $rhs) {
        $retval = new PHP_Parser_Node_Operator($lhs->lineno, $lhs->col, $op, $lhs, $rhs);
    }

    public function do_boolean_and_begin() {}
    public function do_boolean_and_end() {}
    public function do_boolean_or_begin() {}
    public function do_boolean_or_end() {}
    public function do_brk_cont() {}
    public function do_build_namespace_name() {}
    public function do_case_after_statement() {}
    public function do_cast() {}
    public function do_clone() {}
    public function do_declare_class_constant() {}
    public function do_declare_constant() {}
    public function do_declare_end() {}
    public function do_declare_implicit_property() {}
    public function do_declare_property() {}
    public function do_declare_stmt() {}
    public function do_do_while_end() {}

    public function do_echo($arg) {
        $this->statements[] = new PHP_Parser_Node_Echo($arg->lineno, $arg->col, $arg);
    }

    public function do_early_binding() {}
    public function do_end_catch() {}

    public function do_end_class_declaration($type, $name) {
        assert($this->pending);
        $this->pending->statements = $this->statements;
        $this->pop_statements();
        $this->statements[] = $this->pending;
        $this->pop_pending();
    }

    public function do_end_compilation() {}

    public function do_end_function_call($name, &$result, $num_arguments, $is_method, $is_dynamic) {
        $arguments = $this->pending;
        $this->pop_pending();
        $result = new PHP_Parser_Node_Invoke($name->lineno, $name->col);
        if ($name instanceof PHP_Parser_Node_ObjectDereference) {
            $result->object = $name->referencee;
            $result->name = $name->var;
        } else {
            $result->name = $name;
        }
        $result->dynamic = $is_dynamic;
        $result->arguments = $arguments;
    }

    public function do_end_function_declaration() {
        $this->pending->statements = $this->statements;
        $this->pop_statements();
        $this->statements[] = $this->pending;
        $this->pop_pending();
    }

    public function do_end_namespace() {}
    public function do_end_new_object() {}
    public function do_end_silence() {}
    public function do_end_variable_parse() {}
    public function do_exit() {}
    public function do_extended_fcall_begin() {}
    public function do_extended_fcall_end() {}
    public function do_extended_info() {}

    public function do_fetch_class(&$retval, $name) {
        $retval = $name;
    }

    public function do_fetch_constant() {}
    public function do_fetch_global_variable() {}
    public function do_fetch_lexical_variable() {}

    public function do_fetch_property(&$retval, $referencee, $var) {
        $retval = new PHP_Parser_Node_ObjectDereference($var->lineno, $var->col, $referencee, $var);
    }

    public function do_fetch_static_variable() {}
    public function do_first_catch() {}
    public function do_for_end() {}
    public function do_foreach_begin() {}
    public function do_foreach_cont() {}
    public function do_foreach_end() {}

    public function do_free($expr) {
        $this->statements[] = $expr;
    }

    public function do_goto() {}
    public function do_halt_compiler_register() {}
    public function do_if_after_statement() {}
    public function do_if_cond() {}
    public function do_if_end() {}

    public function do_implements_interface($interface) {
        assert($this->pending);
        if (!$this->pending->implements)
            $this->pending->implements = array();
        $this->pending->implements[] = $interface->image;
    }

    public function do_implements_trait() {}

    public function do_include_or_eval($code, &$retval, $param) {
        $retval = new PHP_Parser_Node_Include($param->lineno, $param->col, $code, $param);
    }

    public function do_indirect_references(&$retval, $count, $var) {}
    public function do_init_array() {}
    public function do_instanceof() {}
    public function do_isset_or_isempty() {}
    public function do_jmp_set() {}
    public function do_jmp_set_else() {}
    public function do_label() {}
    public function do_list_end() {}
    public function do_list_init() {}
    public function do_mark_last_catch() {}
    public function do_new_list_begin() {}
    public function do_new_list_end() {}

    public function do_pass_param($param, $op, $index) {
        $this->pending[$index] = array(
            'is_ref' => $op == ZEND_SEND_REF,
            'value' => $param
        );
    }

    public function do_pop_object(&$node) {
        $node = array_pop($this->object_stack);
    }

    public function do_post_incdec() {}
    public function do_pre_incdec() {}
    public function do_print() {}
    public function do_push_object($node) {
        $this->object_stack[] = $node;
    }
    public function do_qm_false() {}
    public function do_qm_true() {}

    public function do_receive_arg($op, $var, &$retval, $default, $typehint, $varname, $is_ref) {
        assert($this->pending);
        $this->pending->arguments[] = array(
            'type' => $typehint,
            'variable' => $var,
            'default' => $default,
            'is_ref' => $is_ref
        );
    }

    public function do_return($value, $do_end_vparse) {
        $this->statements[] = new PHP_Parser_Node_Return($value->lineno, $value->col, $value);
    }

    public function do_shell_exec() {}
    public function do_switch_cond() {}
    public function do_switch_end() {}
    public function do_throw() {}
    public function do_ticks() {}
    public function do_try() {}
    public function do_unary_op() {}
    public function do_use() {}
    public function do_while_cond() {}
    public function do_while_end() {}
    public function error() {}
    public function fetch_array_begin() {}
    public function fetch_array_dim() {}

    public function fetch_simple_variable(&$retval, $name) {
        $retval = new PHP_Parser_Node_Variable($name->lineno, $name->col, $name);
    }

    public function fetch_string_offset() {}
    public function init_list() {}
    public function initialize_try_catch_element() {}
    public function prepare_reference() {}
    public function prepare_trait_alias() {}
    public function prepare_trait_precedence() {}
    public function verify_namespace() {}
}


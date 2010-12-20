<?php

interface PHP_Parser_Handler {
    function check_writable_variable();
    function add_to_list();
    function add_trait_alias();
    function add_trait_precedence();
    function do_abstract_method();
    function do_add_array_element();
    function do_add_list_element();
    function do_add_static_array_element();
    function do_add_string();
    function do_assign(&$retval, $lhs, $rhs);
    function do_begin_catch();
    function do_begin_class_declaration($type, $name, $extends);
    function do_begin_class_member_function_call();
    function do_begin_function_call($name);
    function do_begin_function_declaration($function_node, $name, $is_method, $return_ref, $flags);
    function do_begin_lambda_function_declaration();
    function do_begin_method_call($deref_node);
    function do_begin_namespace();
    function do_begin_new_object();
    function do_begin_qm_op();
    function do_begin_silence();
    function do_begin_variable_parse();
    function do_binary_op($op, &$retval, $lhs, $rhs);
    function do_boolean_and_begin();
    function do_boolean_and_end();
    function do_boolean_or_begin();
    function do_boolean_or_end();
    function do_brk_cont();
    function do_build_namespace_name();
    function do_case_after_statement();
    function do_cast();
    function do_clone();
    function do_declare_class_constant();
    function do_declare_constant();
    function do_declare_end();
    function do_declare_implicit_property();
    function do_declare_property();
    function do_declare_stmt();
    function do_do_while_end();
    function do_echo($arg);
    function do_early_binding();
    function do_end_catch();
    function do_end_class_declaration($type, $name);
    function do_end_compilation();
    function do_end_function_call($name, &$result, $num_arguments, $is_method, $is_dynamic);
    function do_end_function_declaration();
    function do_end_namespace();
    function do_end_new_object();
    function do_end_silence();
    function do_end_variable_parse();
    function do_exit();
    function do_extended_fcall_begin();
    function do_extended_fcall_end();
    function do_extended_info();
    function do_fetch_class(&$retval, $name);
    function do_fetch_constant();
    function do_fetch_global_variable();
    function do_fetch_lexical_variable();
    function do_fetch_property(&$retval, $reference, $var);
    function do_fetch_static_variable();
    function do_first_catch();
    function do_for_end();
    function do_foreach_begin();
    function do_foreach_cont();
    function do_foreach_end();
    function do_free($expr);
    function do_goto();
    function do_halt_compiler_register();
    function do_if_after_statement();
    function do_if_cond();
    function do_if_end();
    function do_implements_interface($interface);
    function do_implements_trait();
    function do_include_or_eval($code, &$retval, $param);
    function do_indirect_references(&$retval, $count, $var);
    function do_init_array();
    function do_instanceof();
    function do_isset_or_isempty();
    function do_jmp_set();
    function do_jmp_set_else();
    function do_label();
    function do_list_end();
    function do_list_init();
    function do_mark_last_catch();
    function do_new_list_begin();
    function do_new_list_end();
    function do_pass_param($param, $op, $index);
    function do_pop_object(&$node);
    function do_post_incdec();
    function do_pre_incdec();
    function do_print();
    function do_push_object($node);
    function do_qm_false();
    function do_qm_true();
    function do_receive_arg($op, $var, &$retval, $default, $typehint, $varname, $is_ref);
    function do_return($value, $do_end_vparse);
    function do_shell_exec();
    function do_switch_cond();
    function do_switch_end();
    function do_throw();
    function do_ticks();
    function do_try();
    function do_unary_op();
    function do_use();
    function do_while_cond();
    function do_while_end();
    function error();
    function fetch_array_begin();
    function fetch_array_dim();
    function fetch_simple_variable(&$retval, $name);
    function fetch_string_offset();
    function init_list();
    function initialize_try_catch_element();
    function prepare_reference();
    function prepare_trait_alias();
    function prepare_trait_precedence();
    function verify_namespace();
}

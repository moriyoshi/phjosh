<?php
require_once 'PHP/Tokenizer.php';
require_once 'PHP/Parser.php';
require_once 'PHP/Parser/Handler.php';
require_once 'PHP/Parser/Emitter.php';
require_once 'Phjosh/Buffer.php';
require_once 'Phjosh/JSBuilder.php';

class MyHandlerImpl implements PHP_Parser_Handler {
    public function check_writable_variable() { var_dump("check_writable_variable", func_get_args()); }
    public function add_to_list() { var_dump("add_to_list", func_get_args()); }
    public function add_trait_alias() { var_dump("add_trait_alias", func_get_args()); }
    public function add_trait_precedence() { var_dump("add_trait_precedence", func_get_args()); }
    public function do_abstract_method() { var_dump("do_abstract_method", func_get_args()); }
    public function do_add_array_element() { var_dump("do_add_array_element", func_get_args()); }
    public function do_add_list_element() { var_dump("do_add_list_element", func_get_args()); }
    public function do_add_static_array_element() { var_dump("do_add_static_array_element", func_get_args()); }
    public function do_add_string() { var_dump("do_add_string", func_get_args()); }
    public function do_assign() { var_dump("do_assign", func_get_args()); }
    public function do_begin_catch() { var_dump("do_begin_catch", func_get_args()); }
    public function do_begin_class_declaration($a, $b, $c) { var_dump("do_begin_class_declaration", func_get_args()); }
    public function do_begin_class_member_function_call() { var_dump("do_begin_class_member_function_call", func_get_args()); }
    public function do_begin_function_call($name) {}
    public function do_begin_function_declaration($a, $b, $c, $d, $e) { var_dump("do_begin_function_declaration", func_get_args()); }
    public function do_begin_lambda_function_declaration() { var_dump("do_begin_lambda_function_declaration", func_get_args()); }
    public function do_begin_method_call($deref_node) { var_dump("do_begin_method_call", func_get_args()); }
    public function do_begin_namespace() { var_dump("do_begin_namespace", func_get_args()); }
    public function do_begin_new_object() { var_dump("do_begin_new_object", func_get_args()); }
    public function do_begin_qm_op() { var_dump("do_begin_qm_op", func_get_args()); }
    public function do_begin_silence() { var_dump("do_begin_silence", func_get_args()); }
    public function do_begin_variable_parse() { var_dump("do_begin_variable_parse", func_get_args()); }
    public function do_binary_op($op, &$retval, $lhs, $rhs) { var_dump("do_binary_op", func_get_args()); }
    public function do_boolean_and_begin() { var_dump("do_boolean_and_begin", func_get_args()); }
    public function do_boolean_and_end() { var_dump("do_boolean_and_end", func_get_args()); }
    public function do_boolean_or_begin() { var_dump("do_boolean_or_begin", func_get_args()); }
    public function do_boolean_or_end() { var_dump("do_boolean_or_end", func_get_args()); }
    public function do_brk_cont() { var_dump("do_brk_cont", func_get_args()); }
    public function do_build_namespace_name() { var_dump("do_build_namespace_name", func_get_args()); }
    public function do_case_after_statement() { var_dump("do_case_after_statement", func_get_args()); }
    public function do_cast() { var_dump("do_cast", func_get_args()); }
    public function do_clone() { var_dump("do_clone", func_get_args()); }
    public function do_declare_class_constant() { var_dump("do_declare_class_constant", func_get_args()); }
    public function do_declare_constant() { var_dump("do_declare_constant", func_get_args()); }
    public function do_declare_end() { var_dump("do_declare_end", func_get_args()); }
    public function do_declare_implicit_property() { var_dump("do_declare_implicit_property", func_get_args()); }
    public function do_declare_property() { var_dump("do_declare_property", func_get_args()); }
    public function do_declare_stmt() { var_dump("do_declare_stmt", func_get_args()); }
    public function do_do_while_end() { var_dump("do_do_while_end", func_get_args()); }
    public function do_early_binding() { var_dump("do_early_binding", func_get_args()); }
    public function do_echo($arg) { echo "ECHO"; }
    public function do_end_catch() { var_dump("do_end_catch", func_get_args()); }
    public function do_end_class_declaration($a, $b) { var_dump("do_end_class_declaration", func_get_args()); }
    public function do_end_compilation() { var_dump("do_end_compilation", func_get_args()); }
    public function do_end_function_call($name, &$result, $arguments, $is_method, $is_dynamic) { var_dump("do_end_function_call", func_get_args()); }
    public function do_end_function_declaration() { var_dump("do_end_function_declaration", func_get_args()); }
    public function do_end_namespace() { var_dump("do_end_namespace", func_get_args()); }
    public function do_end_new_object() { var_dump("do_end_new_object", func_get_args()); }
    public function do_end_silence() { var_dump("do_end_silence", func_get_args()); }
    public function do_end_variable_parse() { var_dump("do_end_variable_parse", func_get_args()); }
    public function do_exit() { var_dump("do_exit", func_get_args()); }
    public function do_extended_fcall_begin() { var_dump("do_extended_fcall_begin", func_get_args()); }
    public function do_extended_fcall_end() { var_dump("do_extended_fcall_end", func_get_args()); }
    public function do_extended_info() { var_dump("do_extended_info", func_get_args()); }
    public function do_fetch_class(&$a, $b) { var_dump("do_fetch_class", func_get_args()); }
    public function do_fetch_constant() { var_dump("do_fetch_constant", func_get_args()); }
    public function do_fetch_global_variable() { var_dump("do_fetch_global_variable", func_get_args()); }
    public function do_fetch_lexical_variable() { var_dump("do_fetch_lexical_variable", func_get_args()); }
    public function do_fetch_property(&$retval, $referencee, $var) { var_dump("do_fetch_property", func_get_args()); }
    public function do_fetch_static_variable() { var_dump("do_fetch_static_variable", func_get_args()); }
    public function do_first_catch() { var_dump("do_first_catch", func_get_args()); }
    public function do_for_end() { var_dump("do_for_end", func_get_args()); }
    public function do_foreach_begin() { var_dump("do_foreach_begin", func_get_args()); }
    public function do_foreach_cont() { var_dump("do_foreach_cont", func_get_args()); }
    public function do_foreach_end() { var_dump("do_foreach_end", func_get_args()); }
    public function do_free($expr) { var_dump("do_free", func_get_args()); }
    public function do_goto() { var_dump("do_goto", func_get_args()); }
    public function do_halt_compiler_register() { var_dump("do_halt_compiler_register", func_get_args()); }
    public function do_if_after_statement() { var_dump("do_if_after_statement", func_get_args()); }
    public function do_if_cond() { var_dump("do_if_cond", func_get_args()); }
    public function do_if_end() { var_dump("do_if_end", func_get_args()); }
    public function do_implements_interface($a) { var_dump("do_implements_interface", func_get_args()); }
    public function do_implements_trait() { var_dump("do_implements_trait", func_get_args()); }
    public function do_include_or_eval($a, &$b, $c) { var_dump("do_include_or_eval", func_get_args()); }
    public function do_indirect_references(&$retval, $count, $var) { var_dump("do_indirect_references", func_get_args()); }
    public function do_init_array() { var_dump("do_init_array", func_get_args()); }
    public function do_instanceof() { var_dump("do_instanceof", func_get_args()); }
    public function do_isset_or_isempty() { var_dump("do_isset_or_isempty", func_get_args()); }
    public function do_jmp_set() { var_dump("do_jmp_set", func_get_args()); }
    public function do_jmp_set_else() { var_dump("do_jmp_set_else", func_get_args()); }
    public function do_label() { var_dump("do_label", func_get_args()); }
    public function do_list_end() { var_dump("do_list_end", func_get_args()); }
    public function do_list_init() { var_dump("do_list_init", func_get_args()); }
    public function do_mark_last_catch() { var_dump("do_mark_last_catch", func_get_args()); }
    public function do_new_list_begin() { var_dump("do_new_list_begin", func_get_args()); }
    public function do_new_list_end() { var_dump("do_new_list_end", func_get_args()); }
    public function do_pass_param($param, $op, $index) { var_dump("do_pass_param", func_get_args()); }
    public function do_pop_object(&$node) { var_dump("do_pop_object", func_get_args()); }
    public function do_post_incdec() { var_dump("do_post_incdec", func_get_args()); }
    public function do_pre_incdec() { var_dump("do_pre_incdec", func_get_args()); }
    public function do_print() { var_dump("do_print", func_get_args()); }
    public function do_push_object($node) { var_dump("do_push_object", func_get_args()); }
    public function do_qm_false() { var_dump("do_qm_false", func_get_args()); }
    public function do_qm_true() { var_dump("do_qm_true", func_get_args()); }
    public function do_receive_arg($op, $var, &$retval, $default, $typehint, $varname, $is_ref) { var_dump("do_receive_arg", func_get_args()); }
    public function do_return($value, $do_end_vparse) { var_dump("do_return", func_get_args()); }

    public function do_shell_exec() { var_dump("do_shell_exec", func_get_args()); }
    public function do_switch_cond() { var_dump("do_switch_cond", func_get_args()); }
    public function do_switch_end() { var_dump("do_switch_end", func_get_args()); }
    public function do_throw() { var_dump("do_throw", func_get_args()); }
    public function do_ticks() { var_dump("do_ticks", func_get_args()); }
    public function do_try() { var_dump("do_try", func_get_args()); }
    public function do_unary_op() { var_dump("do_unary_op", func_get_args()); }
    public function do_use() { var_dump("do_use", func_get_args()); }
    public function do_while_cond() { var_dump("do_while_cond", func_get_args()); }
    public function do_while_end() { var_dump("do_while_end", func_get_args()); }
    public function error() { var_dump("error", func_get_args()); }
    public function fetch_array_begin() { var_dump("fetch_array_begin", func_get_args()); }
    public function fetch_array_dim() { var_dump("fetch_array_dim", func_get_args()); }
    public function fetch_simple_variable(&$retval, $name) { var_dump("fetch_simple_variable", func_get_args()); }
    public function fetch_string_offset() { var_dump("fetch_string_offset", func_get_args()); }
    public function init_list() { var_dump("init_list", func_get_args()); }
    public function initialize_try_catch_element() { var_dump("initialize_try_catch_element", func_get_args()); }
    public function prepare_reference() { var_dump("prepare_reference", func_get_args()); }
    public function prepare_trait_alias() { var_dump("prepare_trait_alias", func_get_args()); }
    public function prepare_trait_precedence() { var_dump("prepare_trait_precedence", func_get_args()); }
    public function verify_namespace() { var_dump("verify_namespace", func_get_args()); }
}

$emitter = new PHP_Parser_Emitter();
$lex = new PHP_Tokenizer(file_get_contents($argv[1]));
#$parser = new PHP_Parser(new MyHandlerImpl());
$parser = new PHP_Parser($emitter);
$parser->yyparse($lex);
#var_dump($emitter->statements);
$buffer = new Phjosh_Buffer();
$builder = new Phjosh_JSBuilder($buffer);
$builder->visitStatements($emitter->statements);
echo $buffer;

?>

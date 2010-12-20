<?php
define('ZEND_EVAL',                1<<0);
define('ZEND_INCLUDE',             1<<1);
define('ZEND_INCLUDE_ONCE',        1<<2);
define('ZEND_REQUIRE',             1<<3);
define('ZEND_REQUIRE_ONCE',        1<<4);
define('ZEND_ACC_PUBLIC',          0x100);
define('ZEND_ACC_PROTECTED',       0x200);
define('ZEND_ACC_PRIVATE',         0x400);
define('ZEND_ACC_PPP_MASK',        ZEND_ACC_PUBLIC
                                   | ZEND_ACC_PROTECTED
                                   | ZEND_ACC_PRIVATE);
define('ZEND_ACC_CHANGED',         0x800);
define('ZEND_ACC_IMPLICIT_PUBLIC', 0x1000);

/* method flags (special method detection) */
define('ZEND_ACC_CTOR',            0x2000);
define('ZEND_ACC_DTOR',            0x4000);
define('ZEND_ACC_CLONE',           0x8000);

define('IS_CONST',                 1<<0);

define('ZEND_RETURN_VAL',             0);
define('ZEND_RETURN_REF',             1);
define('ZEND_RETURN_VALUE',           0);
define('ZEND_RETURN_REFERENCE',       1);

define('ZEND_PARSED_MEMBER',             1<<0);
define('ZEND_PARSED_METHOD_CALL',        1<<1);
define('ZEND_PARSED_STATIC_MEMBER',      1<<2);
define('ZEND_PARSED_FUNCTION_CALL',      1<<3);
define('ZEND_PARSED_VARIABLE',           1<<4);
define('ZEND_PARSED_REFERENCE_VARIABLE', 1<<5);
define('ZEND_PARSED_NEW',                1<<6);

define('ZEND_RECV',                      63);
define('ZEND_SEND_VAL',                  65);
define('ZEND_SEND_VAR',                  66);
define('ZEND_SEND_REF',                  67);

define('BP_VAR_R',        0);
define('BP_VAR_W',        1);
define('BP_VAR_RW',       2);
define('BP_VAR_IS',       3);
define('BP_VAR_NA',       4);
define('BP_VAR_FUNC_ARG', 5);
define('BP_VAR_UNSET',    6);

define('ZEND_ADD',                  1);
define('ZEND_SUB',                  2);
define('ZEND_MUL',                  3);
define('ZEND_DIV',                  4);
define('ZEND_MOD',                  5);
define('ZEND_SL',                   6);
define('ZEND_SR',                   7);
define('ZEND_CONCAT',               8);
define('ZEND_BW_OR',                9);
define('ZEND_BW_AND',               10);
define('ZEND_BW_XOR',               11);
define('ZEND_BW_NOT',               12);
define('ZEND_BOOL_NOT',             13);
define('ZEND_BOOL_XOR',             14);
define('ZEND_IS_IDENTICAL',         15);
define('ZEND_IS_NOT_IDENTICAL',     16);
define('ZEND_IS_EQUAL',             17);
define('ZEND_IS_NOT_EQUAL',         18);
define('ZEND_IS_SMALLER',           19);
define('ZEND_IS_SMALLER_OR_EQUAL',  20);


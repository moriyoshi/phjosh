KMYACC = kmyacc
PARSER_TEMPLATE = kmyacc.class.php.parser

all: PHP/Parser/Base.php

clean:
	rm -f PHP/Parser/Base.php
	rm -f PHP/Parser/Base.y

PHP/Parser/Base.php: PHP/Parser/Base.y
	$(KMYACC) -m $(PARSER_TEMPLATE) -L php -b PHP/Parser/Base -p PHP_Parser_Base PHP/Parser/Base.y

PHP/Parser/Base.y: zend_language_parser.y
	sed -e 's/#include "zend_compile.h"/require_once "PHP\/Parser\/Constants.php";/; s/&\$$/$$/g; s/zval minus_one; *//g; s/minus_one/$$minus_one/g; s/&$$minus_one/$$minus_one/g; s/znode tmp_znode;/$$tmp_znode = new PHP_Parser_Node();/g; s/&tmp_znode/$$tmp_znode/g; s/znode tmp;/$$tmp = new PHP_Parser_Node();/g; s/&tmp/$$tmp/g; s/char \*/$$/g; s/memcpy(&(tmp\[\([^]]*\)\]),/memcpy($$tmp, \1,/g; s/tmp\[\([^]]*\)\]/$$&/g; s/++Z_STRLEN([^)]*)//g; s/ *TSRMLS_CC//g; s/TSRMLS_C//g; s/Z_TYPE(\([^)]*\))[^;]*//g; s/Z_LVAL(\([^)]*\))/\1/g; s/Z_STRVAL(\([^)]*\))/\1->string/g; s/Z_STRLEN(\([^)]*\))/strlen(\1->string)/g; s/\$$[^;.]*\.u\.\(op\.\)*opline_num = get_next_op_number([^;]*;//g; s/\$$[^;.]*\.u\.\(op\.\)*opline_num = CG(zend_lineno);//g; s/\$$[^;.]*\.u\.\(op\.\)*opline_num = \([^;]*\);/$$tmpval = \2;/g; s/\$$[^;.]*\.u\.\(op\.\)*opline_num = [0-9-]*;//g; s/, \$$[^ ,.;]*\.u\.\(op\.\)*opline_num/, $$tmpval/g; s/[^a-zA-Z0-9_]\(fetch_[a-zA-Z0-9_]*\)(/$$this->handler->\1(/g; s/zend_\([a-zA-Z0-9_]*\)(/$$this->handler->\1(/g; s/CG(\([^)]*\))/$$this->handler->\1/g; s/\.u\.op\./->op_/g; s/\.u\.constant/->constant/g; s/\.op_type = IS_UNUSED/= false/g; s/\.op_type/->op_type/g; s/\.u\.EA/->EA/g; s/\.EA/->EA/g; s/->EA\.type/->EA/g; s/HANDLE_INTERACTIVE();//g; s/INIT_PZVAL([^)]*);//g; s/handler->zend_lineno/lex->lineno/g; s/NULL/false/g' $< > $@

.PHONY: all clean

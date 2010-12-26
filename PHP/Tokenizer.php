<?php
require_once 'PHP/Parser.php';
require_once 'PHP/Parser/Node.php';
require_once 'PHP/Parser/Node/String.php';
require_once 'PHP/Parser/Node/Symbol.php';
require_once 'PHP/Parser/Node/VariableName.php';
require_once 'PHP/Parser/Node/Number.php';

class PHP_Tokenizer {
    private static $token_map = array();
    private $tokens;
    public $filename;
    public $last;
    public $lineno;
    public $col;
    public $last_doc_comment = false;

    private static function __cinit() {
        $rc = new ReflectionClass('PHP_Parser');
        self::$token_map = range(0, 255);
        foreach ($rc->getConstants() as $k => $v) {
            if (strncmp($k, "T_", 2) != 0)
                continue;
            self::$token_map[constant($k)] = $v;
        }
    }

    function __construct($src, $filename = "(none)") {
        self::__cinit();
        $this->tokens = token_get_all($src);
        $this->filename = $filename;
        $this->last = false;
        $this->lineno = 0;
        $this->col = 0;
    }

    function yylex(&$yylval) {
        for (;;) {
            if (!$this->tokens) {
                return 0;
            }
            $token = array_shift($this->tokens);
            $tokval = false;
            $image = false;
            if (is_array($token)) {
                if ($this->lineno != $token[2]) {
                    $this->col = 0;
                }
                $image = $token[1];
                $tokval = $token[0];
                $lineno = $token[2];
            } else {
                $image = $token;
                $tokval = ord($token);
                $lineno = $this->lineno;
            }
            switch ($tokval) {
            case T_NUM_STRING:
            case T_INLINE_HTML:
            case T_ENCAPSED_AND_WHITESPACE:
                $yylval = new PHP_Parser_Node_String($lineno, $this->col, $image);
                break;
            case T_STRING:
                $yylval = new PHP_Parser_Node_Symbol($lineno, $this->col, $image);
                break;
            case T_STRING_VARNAME:
                $yylval = new PHP_Parser_Node_VariableName($lineno, $this->col, $image);
                break;
            case T_VARIABLE:
                $yylval = new PHP_Parser_Node_VariableName($lineno, $this->col, substr($image, 1));
                break;
            case T_CONSTANT_ENCAPSED_STRING:
                $yylval = new PHP_Parser_Node_String($lineno, $this->col, stripcslashes(substr($image, 1, -1)));
                break;

            case T_LNUMBER:
                $yylval = new PHP_Parser_Node_Number($lineno, $this->col, $image, true);
                break;
            case T_DNUMBER:
                $yylval = new PHP_Parser_Node_Number($lineno, $this->col, $image, false);
                break;

            default:
                $yylval = new PHP_Parser_Node($lineno, $this->col);
                break;
            }
            $this->last = $yylval;
            $this->col += strlen($image);
            $this->lineno = $lineno;
            switch ($tokval) {
            case T_COMMENT:
            case T_OPEN_TAG:
            case T_WHITESPACE:
                continue;
            case T_DOC_COMMENT:
                $this->last_doc_comment = $image;
                continue;
            case T_CLOSE_TAG:
                $tokval = ord(';');
                break 2;
            case T_OPEN_TAG_WITH_ECHO:
                $tokval = T_ECHO;
                break 2;
            default:
                break 2;
            }
        }
        return self::$token_map[$tokval];
    }
}

?>

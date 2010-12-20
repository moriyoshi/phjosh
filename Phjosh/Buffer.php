<?php
class Phjosh_Buffer {
    private $buf;
    private $indent_chars;
    private $indent;

    public function __construct($indent_chars = "    ") {
        $this->buf = array();
        $this->indent_chars = $indent_chars;
        $this->indent = 0;
        $this->newline = true;
    }

    public function putln($value) {
        if ($this->newline)
            $this->buf[] = str_repeat($this->indent_chars, $this->indent);
        $this->buf[] = $value;
        $this->buf[] = "\n";
        $this->newline = true;
    }

    public function put($value) {
        if ($this->newline)
            $this->buf[] = str_repeat($this->indent_chars, $this->indent);
        $this->buf[] = $value;
        $this->newline = false;
    }

    public function indent() {
        $this->indent++;
    }

    public function dedent() {
        $this->indent--;
    }

    public function __tostring() {
        return implode('', $this->buf);
    }
}

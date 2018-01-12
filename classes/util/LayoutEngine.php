<?php
class LayoutEngine
{
    private $code = "";
    private $tag_open = "{";
    private $tag_close = "}";

    function __construct($file)
    {
        $this->code = file_get_contents($file);
    }

    function isEmpty()
    {
        return $this->code != "" and sizeof($this->code) > 0;
    }

    function put($key, $value)
    {
        $this->code = "".str_replace("".$this->tag_open.$key.$this->tag_close, $value, $this->code);
    }

    function finalize()
    {
        $this->code = preg_replace('/\{[A-Za-z ]*\}/', "", $this->code);
        return $this->code."";
    }
}
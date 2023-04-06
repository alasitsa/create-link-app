<?php

class ParamNotFoundException extends Exception
{
    private string $param;

    public function __construct(string $param, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->param = $param;
    }

    public function __toString()
    {
        return __CLASS__ . ": Parameter \"$this->param\" not found\n";
    }
}
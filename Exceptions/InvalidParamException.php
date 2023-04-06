<?php


class InvalidParamException extends Exception
{
    private string $param;
    private string $value;

    public function __construct(string $param, string $value, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->param = $param;
        $this->value = $value;
    }

    public function __toString()
    {
        return __CLASS__ . ": Parameter \"$this->param\" could not be \"$this->value\"\n";
    }
}
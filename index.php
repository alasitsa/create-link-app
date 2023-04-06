<?php
require "Exceptions/ParamNotFoundException.php";
require "Exceptions/InvalidParamException.php";
require "constants.php";
require "functions.php";

$input = json_decode(file_get_contents("input.json"), true);

foreach ($input as $params) {
    try {
        echo link_to($params);
    } catch (InvalidParamException | ParamNotFoundException $e) {
        echo $e;
    }
}
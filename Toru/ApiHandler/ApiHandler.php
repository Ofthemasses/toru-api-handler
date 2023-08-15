<?php
namespace Toru\ApiHandler;
abstract class ApiHandler
{
    protected $allowed_inputs = [];

    public function setAllowedActions(){
        $allowed_inputs = [];
        $i = 0;

        while ($input = getenv("INPUT_$i")){
            $allowed_inputs[] = $input;
            $i++;
        }
    }

    abstract public function printResponse($input);
}
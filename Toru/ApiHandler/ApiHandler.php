<?php
namespace Toru\ApiHandler;
abstract class ApiHandler
{
    protected $allowed_inputs = [];

    public function __construct()
    {
        $this->setAllowedActions();
    }

    public function setAllowedActions(){
        $this->allowed_inputs= [];
        $i = 0;

        while ($input = getenv("INPUT_$i")){
            $this->allowed_inputs[] = $input;
            $i++;
        }
    }

    abstract public function printResponse($input);
}
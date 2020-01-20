<?php


namespace Gregdmat\LaravelTestUtilities\src\Asserts;


use Illuminate\Foundation\Testing\Assert as PHPUnit;
use Illuminate\Contracts\Validation\Rule;

trait ValidatorAsserts
{
    private $rules = [
        'required',
        'integer',
        'string',
        'bool'
    ];

    public function assertStructureAndValue(array $structure, $data, $currentKey = 'Undefined')
    {
        foreach ($structure as $key => $value) {
            if (is_array($value) && $key === '*') {
                PHPUnit::assertIsArray($data);

                foreach ($data as $keyItem => $dataItem) {
                    if($keyItem != '_rules')
                        $this->assertStructureAndValue($structure['*'], $dataItem, $keyItem);
                }
            }elseif (is_array($data)){
                if($key != '_rules')
                {
                    PHPUnit::assertArrayHasKey($key, $data);
                    $this->assertStructureAndValue($value, $data[$key], $key);
                }
            }elseif($value instanceof Rule){
                PHPUnit::assertTrue($value->passes($currentKey, $data), $value->message());
            }else{
                foreach ((array) $value as $rule)
                {
                    if(is_callable($rule)){
                        PHPUnit::assertTrue($rule(), "Failed at closure of $currentKey attribute.");
                    }
                    elseif(method_exists($this, $rule))
                        $this->$rule($currentKey, $data);
                }
            }
        }
    }

    private function required($key, $value)
    {
        PHPUnit::assertTrue(!empty($value), "$key can't be empty.");
    }

    private function integer($key, $value)
    {
        PHPUnit::assertTrue((is_int($value) || empty($value)), "$key is not integer.");
    }

    private function string($key, $value)
    {
        PHPUnit::assertTrue((is_string($value) || empty($value)), "$key is not string.");
    }

    private function bool($key, $value, $message = '')
    {
        if(empty($message))
            $message = "$key is not bool.";

        PHPUnit::assertTrue((is_bool($value) || empty($value)), $message);
    }
}

<?php


namespace Gregdmat\LaravelTestUtilities\Asserts;

use Illuminate\Foundation\Testing\Assert as PHPUnit;
use Illuminate\Support\Facades\Validator;

trait ValidatorAsserts
{
    private $rules = [
        'required',
        'integer',
        'string',
        'bool'
    ];

    public function assertStructureAndValue(array $structure, $data)
    {
        $validator = Validator::make($data, $structure);
        PHPUnit::assertFalse($validator->fails(), $this->getFirstError($validator));

    }

    private function getFirstError($validator)
    {
        $errors = $validator->errors()->messages();
        $keys = array_keys($validator->errors()->messages());
        return $errors[$keys[0]][0];
    }


}

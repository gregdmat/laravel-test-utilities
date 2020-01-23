<?php


namespace Gregdmat\LaravelTestUtilities\DataCases\Concerns;

use Faker\Generator as Faker;

abstract class TypeDataCases
{
    protected $config = '';
    protected $options;
    protected $cases;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function cases(): array
    {
        $this->cases = array();

        if (!empty($this->config)) {
            $config = config("ltu.data_cases." . $this->config);

            if (is_array($config)) {
                foreach ($config as $case => $value) {
                    if (
                        !(isset($this->options['except']) && !in_array($case, $this->options['except']) && $value)
                    )
                    {
                        array_push($this->cases, $this->$case());
                    }
                }
            }
        }

        return $this->cases;
    }
}

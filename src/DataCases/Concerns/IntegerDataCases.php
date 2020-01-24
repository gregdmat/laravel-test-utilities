<?php


namespace Gregdmat\LaravelTestUtilities\DataCases\Concerns;

class IntegerDataCases extends TypeDataCases
{
    protected $config = 'integer';

    protected function zero()
    {
        return 0;
    }

    protected function negative()
    {
        return rand(
            isset($this->options['negative.min']) ? $this->options['negative.min'] : -999999,
            isset($this->options['negative.max']) ? $this->options['negative.max'] : -1
        );
    }

    protected function positive()
    {
        return rand(
            isset($this->options['positive.min']) ? $this->options['positive.min'] : 1,
            isset($this->options['positive.max']) ? $this->options['positive.max'] : 999999
        );
    }
}

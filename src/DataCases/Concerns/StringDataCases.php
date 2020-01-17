<?php


namespace Gregdmat\LaravelTestUtilities\DataCases\Concerns;

use Illuminate\Support\Str;

class StringDataCases extends TypeDataCases
{
    protected $config = 'string';

    protected function empty()
    {
        return '';
    }

    protected function small()
    {
        $size = 1;

        if(isset($this->options['small']['size']))
            $size = $this->options['small']['size'];

        return Str::random($size);
    }

    protected function normal()
    {
        $size = 30;

        if(isset($this->options['normal']['size']))
            $size = $this->options['normal']['size'];

        return Str::random($size);
    }

    protected function long()
    {
        $size = 255;

        if(isset($this->options['long']['size']))
            $size = $this->options['long']['size'];

        return Str::random($size);
    }

    protected function null()
    {
        return null;
    }
}

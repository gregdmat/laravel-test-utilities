<?php


namespace Gregdmat\LaravelTestUtilities\DataCases;


use Gregdmat\LaravelTestUtilities\DataCases\Concerns\IntegerDataCases;
use Gregdmat\LaravelTestUtilities\DataCases\Concerns\StringDataCases;
use Illuminate\Database\Eloquent\Model;

class DataCases
{
    protected $options;
    protected $stringCases;
    protected $integerCases;

    public function __construct(array $options = [])
    {
        $this->options = $options;
        $this->stringCases = new StringDataCases($options);
        $this->integerCases = new IntegerDataCases($options);
    }

    public function get(array $stucture) : array
    {
        $cases = [];

        foreach ($stucture as $key => $item)
        {
            $concern = $item . 'Cases';
            if(isset($this->$concern))
            {
                $cases[$key] = $this->$concern->cases();
            }
        }

        return $cases;
    }

    public function make(array $structure, string $modelPath) : array
    {
        $higher = 0;
        $cases = $this->get($structure);

        array_map(function ($n) use (&$higher){
            if (count($n) > $higher)
                $higher = count($n);
        }, $cases);

        $attributes = array_keys($cases);
        $rows = array();

        for ($i = 0; $i < $higher; $i++)
        {
            $row = array();
            foreach ($attributes as $attribute)
            {
                if(isset($cases[$attribute][$i]))
                    $row[$attribute] = $cases[$attribute][$i];
            }

            array_push($rows, factory($modelPath)->make($row));
        }

        return $rows;
    }

    public function  create(array $structure, string $modelPath)
    {
        $rows = $this->make($structure, $modelPath);

        array_map(function ($n) {
            $n->save();
        }, $rows);

        return $rows;
    }
}

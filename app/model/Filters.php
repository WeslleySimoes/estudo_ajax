<?php 

namespace app\model;

class Filters
{
    protected $filters; 

    public function __construct()
    {
        $this->filters = [];
    }

    public function where($column,$operator,$value,$operator_logic = 'AND')
    {
        $formatter = '';

        if(is_array($value)) {   
            $num_str_value = array_map(function($value){
                return is_numeric($value) ? $value : "'$value'";
            },$value); 

            $formatter = '('.implode(',',$num_str_value).')';
        }elseif(is_bool($value)) {

            $formatter =  $value ? 1 : 0;

        }elseif(is_string($value)) {
            $formatter = "'{$value}'";
        }else {
            $formatter = $value;
        }

        $formatter = strip_tags($formatter);

        if(!isset($this->filters['where'])){
            $operator_logic = '';
        }


        $this->filters['where'][] = "{$operator_logic} {$column} {$operator} {$formatter}";
    }

    public function orderBy($column,$order = 'ASC')
    {
        $this->filters['orderBy'][] = "{$column} {$order}";
    }

    public function dump()
    {
        $filters  = !empty($this->filters['where']) ? ' WHERE'.implode(' ',$this->filters['where']) : '';
        $filters .= !empty($this->filters['orderBy']) ? ' ORDER BY '.implode(',',$this->filters['orderBy']) : '';

        return $filters;
    }
}

<?php
declare(strict_types= 1);

class Join {

    static function new($left, $right): Join
    {
        return new Join($left, $right);
    }

    var $_joined_left;
    var $_joined_right;
    var $_joining_left_table_field;
    var $_joining_right_table_field;
    var $_joining_criteria;

    function __construct($left, $right)
    {
        $this->_joined_left = $left;
        $this->_joined_right = $right;
    }

    function join($tableOrJoin) : Join
    {
        return Join::new($this, $tableOrJoin);
    }

    function on_eq(string $left_field, string $right_field) : Join
    {
        $this->_joining_left_table_field = $left_field;
        $this->_joining_right_table_field = $right_field;
        return $this;
    }

    function on(string $criteria) : Join
    {
        $this->_joining_criteria = $criteria;
        return $this;
    }

    function getSQL() : string
    {
        $terms = [
            '(',
            ') JOIN (',
            ') ON',
            ($this->_joining_criteria) 
                ? $this->_joining_criteria
                : $this->_joining_left_table_field.' = '.$this->_joining_right_table_field
        ];
        return implode(' ', $terms);
    }
}
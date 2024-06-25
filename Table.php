<?php
declare(strict_types= 1);

class Table {

    static function new(string $table_name, Query $query): Table
    {
        return new Table($table_name, $query);
    }

    var $_table_name;
    var $_query;

    function __construct(string $table_name, Query $query)
    {
        $this->_table_name = $table_name;
        $this->_query = $query;
    } 

    function name(string $table_name): Table
    {
        $this->_table_name = $table_name;
        return $this;
    }

    function join($tableOrJoin): Join {
        if ($tableOrJoin instanceof Table)
            return Join::new($this, $tableOrJoin);
        if ($tableOrJoin instanceof Join)
            return Join::new($this, $tableOrJoin);
        throw new Exception("Bad object to join.");
    }

    function where(string $clauses): Query
    {
        return $this->_query->where($clauses, $this);
    }

    function getSQL(): string
    {
        if (NULL === $this->_table_name) {
            throw new Exception("Unknown table");
        }
        return $this->_table_name;
    }
}
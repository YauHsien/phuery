<?php
declare(strict_types= 1);

class Query {

    static function new(): Query
    {
        return new Query();
    }

    /**
     * @param $_selected_fields string[]
     * @annotation Names as selected fields
     */
    var $_selected_fields = [];
    var $_from_table;
    var $_from_join;
    var $_where_clauses = [];

    /**
     * @param $fields string[]
     * @annotation To put select-fields into the query.
     */
    function select(array $fields) : Query
    {
        foreach($fields as $field) {
            $this->_selected_fields[] = $field;
        }
        return $this;
    }

    function from(string $table_name): Table
    {
        return Table::new($table_name, $this);
    }

    function where(string $clause, Table $table=NULL, Join $join=NULL) : Query
    {
        $this->_where_clauses[] = $clause;
        $this->_from_table = $table;
        $this->_from_join = $join;
        return $this;
    }

    function getSQL() : string
    {
        $terms = [
            'SELECT',
            implode(', ', $this->_selected_fields),
            'FROM'
            ($this->_from_table)
                ? $this->_from_table->getSQL()
                : $this->_from_join->getSQL(),
            'WHERE',
            implode(' and ', $this->_where_clauses)
        ];
        return implode(' ', $terms);
    }

}
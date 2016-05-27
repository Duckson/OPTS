<?php
namespace model;
class Query
{
    protected $table;
    protected $alias;
    protected $select_fields = [];
    protected $where = [];
    protected $joins = [];// самое интерсное

    public function __construct($table, $joins = [])
    {
        $this->table = $table;
        $this->alias = $table;
        $this->joins = $joins;
    }

    public static function fieldsFromArray($fields)
    {
        return "'" . join("','", $fields) . "'";
    }

    public function select($fields)
    {
        $this->select_fields = $fields;
        return $this;
    }

    public function where($conditions)
    {
        $this->where = $conditions;
        return $this;
    }

    // $on = [field_pk,field_fk]
    public function join($table_name, $on)
    {
        $this->joins[] = [$table_name, $on];
    }

    public function buildWhere()
    {
        $where = [];
        foreach ($this->where as $condition) {
            if (count($condition) == 2) {
                list($field, $value) = $condition;
                $operator = '=';
            } else {
                list($field, $value, $operator) = $condition;
            }
            $where[] = "`{$field}` {$operator} '{$value}'";
        }
        return $where;
    }

    public function buildOn($join)
    {
        return "'{$join[1][0]}' = '{$join[1][1]}'";
    }

    public function buildJoins()
    {
        $joins = [];
        foreach ($this->joins as $join) {
            $joins[] = "LEFT JOIN " . $join[0] . " ON(" . $this->buildOn($join) . ")";
        }
        return join(' ', $joins);
    }

    public function build()
    {
        $all_where = $this->buildWhere();
        $condition_str = "";
        if (count($all_where)) {
            $condition_str = ' WHERE ' . join(' AND ', $all_where);
        }
        return "SELECT " . Query::fieldsFromArray($this->select_fields) . " FROM `{$this->table}` " . $this->buildJoins() . "$condition_str";
    }
}
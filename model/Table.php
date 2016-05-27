<?php

namespace model;
class Table
{
    protected $db;
    protected $name;
    protected $joins;

    // $joins = [['table_name' => $table_name, 'on' => [$field_pk,$field_fk]], ...]
    public function __construct($db, $name, $joins = [])
    {
        $this->db = $db;
        $this->name = $name;
        $this->joins = $joins;
    }

    // пусть условие будет иметь вид
    // [field, value, operator]
    public function select($fields, $conditions = [])
    {
        $query = (new Query($this->name, $this->joins))->select($fields)->where($conditions)->build();
        $data = $this->db->query($query);
        if ($data) {
            while ($row = $data->fetch_assoc()) {
                $result[] = $row;
            }
            return $result;
        }
        echo $this->db->error;
        return false;
    }

    public function insert($values)
    {
        $fields = array_keys($values);
        $query = "INSERT INTO `{$this->name}` (" . Query::fieldsFromArray($fields) . ") values('" . join("','", $values) . "')";
        if ($this->db->query($query)) {
            return $this->db->insert_id;
        }
        return false;
    }

    public function update($values, $c_field, $c_value)
    {
        foreach ($values as $field=>$value){
            $set[] = $field . '=' . $value;
        }
        $query = 'UPDATE ' . $this->name . ' SET ' . join(',', $set) . ' WHERE ' . $c_field . '=' . $c_value;
        $result = $this->db->query($query);
        if($result) return true;
        return false;
    }

    public function delete($values)
    {
        foreach ($values as $field=>$value){
            $where[] = $field . '=' . $value;
        }
        $query = 'DELETE FROM ' . $this->name . ' WHERE ' . join(',', $where);
        $result = $this->db->query($query);
        if($result) return true;
        return false;
    }
}
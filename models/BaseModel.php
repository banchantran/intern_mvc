<?php
class BaseModel
{
    protected static $table = "";
    protected static $columns = false;

    public static function insert($data)
    {
        $db = DB::getInstance();
        return $db->insert(static::$table, $data);
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public static function update($values, $conditions)
    {
        $db = DB::getInstance();
        return $db->update(static::$table, $values, $conditions);
    }

    public static function findById($id)
    {
        $db = DB::getInstance();
        $table = static::$table;
        $sql = "SELECT * FROM {$table} WHERE id = $id AND del_flag = 0";
        // var_dump($sql);
        // exit;
        return $db->query($sql)->results();
    }

    public static function findByEmailAndName($name, $email)
    {
        $db = DB::getInstance();
        $table = static::$table;
        $sql = "SELECT * FROM {$table} WHERE name LIKE '%$name%' AND email like '%$email%' AND del_flag = 0";
        return $db->query($sql)->results();
    }

    public static function findByEmail($email)
    {
        $db = DB::getInstance();
        $table = static::$table;
        $sql = "SELECT * FROM {$table} WHERE email like '%$email%' AND del_flag = 0";
        return $db->query($sql)->results();
    }

}

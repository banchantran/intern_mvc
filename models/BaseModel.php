<?php
class BaseModel
{
    protected static $table = "";
    protected static $columns = false;
   
    public static function insert($data)
    {
        // TODO: Implement create() method.
        $db = DB::getInstance();
        return $db->insert(static::$table, $data);
        // $data = array_merge($data, [
        // 	'ins_id' => getSessionAdmin('id'),
        // 	'ins_datetime' => date('Y-m-d H:i:s')
        // ]);

        // check fillable

        // run exec insert db;
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

    public static function find($params = [])
    {
        $db = DB::getInstance();
        list('sql' => $sql, 'bind' => $bind) = self::selectBuilder($params);
        // var_dump($sql);
        // exit;
        return $db->query($sql, $bind)->results();
    }

    public static function findFirst($params = [])
    {
        $db = DB::getInstance();
        list('sql' => $sql, 'bind' => $bind) = self::selectBuilder($params);
        $results = $db->query($sql, $bind)->results();
        return isset($results[0]) ? $results[0] : false;
    }

    public static function findById($id)
    {
        return static::findFirst([
            'conditions' => "id = :id",
            'bind' => ['id' => $id]
        ]);
    }

    public static function findByEmailAndName($name, $email)
    {
        $db = DB::getInstance();
        $table = static::$table;
        $sql = "SELECT * FROM {$table} WHERE name LIKE '%$name%' AND email like '%$email%' AND del_flag = 0";
        return $db->query($sql)->results();
    }

    public static function selectBuilder($params = [])
    {
        $columns = array_key_exists('columns', $params) ? $params['columns'] : "*";
        $table = static::$table;
        $sql = "SELECT {$columns} FROM {$table}";
        list('sql' => $conds, 'bind' => $bind) = self::queryParamBuilder($params);
        $sql .= $conds;
        return ['sql' => $sql, 'bind' => $bind];
    }

    public static function queryParamBuilder($params = [])
    {
        $sql = "";
        $bind = array_key_exists('bind', $params) ? $params['bind'] : [];

        // where
        if (array_key_exists('conditions', $params)) {
            $conds = $params['conditions'];
            $sql .= " WHERE {$conds}";
        }

        // order
        if (array_key_exists('order', $params)) {
            $order = $params['order'];
            $sql .= " ORDER BY {$order}";
        }

        // limit
        if (array_key_exists('limit', $params)) {
            $limit = $params['limit'];
            $sql .= " LIMIT {$limit}";
        }

        // offset
        if (array_key_exists('offset', $params)) {
            $offset = $params['offset'];
            $sql .= " OFFSET {$offset}";
        }
        return ['sql' => $sql, 'bind' => $bind];
    }

}

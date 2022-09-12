<?php
class BaseModel
{
    // public $tableName;
    // public $fillable;

    // public function getAll($fields = [])
    // {
    // 	if (empty($fields)) {
    // 		$fields[] = 'id';
    // 	}

    // 	// TODO: Implement getAll() method.
    // 	return "query select {implode($fields) from $this->tableName} where del_flag = " . DELETED_OFF;
    // }
    protected static $table = "";
    protected static $columns = false;
    protected $_validationPassed = true, $_errors = [], $_skipUpdate = [];
    // protected static function getDb($setFetchClass = false)
    // {
    //     $db = DB::getInstance();
    //     if ($setFetchClass) {
    //         $db->setClass(get_called_class());
    //         $db->setFetchType(PDO::FETCH_CLASS);

    //     }
    //     return $db;
    // }
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

    public static function findByEmailAndName($name,$email) {
        $db = DB::getInstance();
        // $a = $db->findByParam(static::$table,['name'=>$name, 'email'=>$email]);
        // $a = list('sql' => $sql, 'bind' => $bind) = self::selectBuilder($params);
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

    public function save()
    {
        $save = false;
        // $this->beforeSave();
        // if ($this->_validationPassed) {
        $db = DB::getInstance();
        $values = $this->getValuesForSave();
        if ($this->isNew()) {
            $save = $db->insert(static::$table, $values);
            if ($save) {
                $this->id = $db->lastInsertId();
            }
        } else {
            $save = $db->update(static::$table, $values, ['id' => $this->id]);
        }
        // }
        return $save;
    }

    public function getValuesForSave()
    {
        $columns = static::getColumns();
        unset($columns[0]); // bo cot id di 
        $values = [];
        foreach ($columns as $column) {
            if (!in_array($column, $this->_skipUpdate)) {
                $values[$column] = $this->{$column};
            }
        }
        return $values;
    }

    public static function getColumns()
    {
        if (!static::$columns) {
            $db = DB::getInstance();
            $table = static::$table;
            $sql = "SHOW COLUMNS FROM {$table}";
            $results = $db->query($sql)->results();
            $columns = [];
            foreach ($results as $column) {
                $columns[] = $column->Field;
            }
            static::$columns = $columns;
        }
        return static::$columns;
    }

    // public function update($id, $data)
    // {
    // 	// TODO: Implement create() method.

    // 	$data = array_merge($data, [
    // 		'upd_id' => getSessionAdmin('id'),
    // 		'upd_datetime' => date('Y-m-d H:i:s')
    // 	]);

    // 	// check fillable

    // 	// run exec insert db;
    // }
}

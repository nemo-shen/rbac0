<?php 
class mysql extends mysqli{
    
    public function __construct($host, $user, $password, $database, $charset){
        parent::__construct($host, $user, $password, $database);
        parent::set_charset($charset) or die('数据库编码设置失败');
    }
    
    public function fetchOne ($field='*', $table, $where='', $order='') {
        if (is_array($field)) {
            $field = implode(',', $field); 
        }
        $sql = "SELECT {$field} FROM {$table}";
        if (!empty($where)) {
            $sql .= " WHERE {$where}";
        }
        
        if (!empty($order)) {
            $sql .= " ORDER BY {$order}";
        }
        $result = parent::query($sql);
        return $result->fetch_assoc();
    }
    
    
    /**
     * 查询多条数据
     * @param string $filed
     * @param string $table
     * @param string $where
     * @param string $limit
     * @param string $order
     * @return boolean|boolean
     */
    public function fetchAll ($filed='*', $table, $where='', $limit='', $order='') {
        if (is_array($filed)) {
            $filed = implode(',', array_values($filed));
        }
        $sql = "SELECT {$filed} FROM `{$table}`";
        if (!empty($where)) {
            $sql .= " WHERE {$where}";
        }
        if (!empty($limit)) {
            $sql .= " LIMIT {$limit}";
        }
        
        if (!empty($order)){
            $sql .= " ORDER BY {$order}";
        }
        $result = parent::query($sql);
        while ($results = $result->fetch_assoc()) {
            $res[] = $results;
        }
        if (!empty($res)){
            return $res;
        } else {
            return false;
        }
    }

    
    /**
     * 向MYSQL中添加数据
     * @param string $table
     * @param array $data
     * @throws Exception
     * @return boolean
     */
    public function insert ($table, $data=array()) {
        try {
            if (empty($table)) throw new Exception('数据添加失败');
            if (empty($data)) throw new Exception('数据添加失败');
            if (!is_array($data)) throw new Exception('数据必须为数组');
            if (!($field = implode(',', array_keys($data)))) throw new Exception('数据添加失败');
            if (!($value = array_values($data))) throw new Exception('数据添加失败');
            foreach ($value as $v) {
                if (is_string($v)){
                    $values[] = "'".addslashesed($v)."'";
                } else {
                    $values[] = $v;
                }
            }
            if (!($values = implode(',', $values))) throw new Exception('数据添加失败');
            $sql = "INSERT INTO `{$table}` ($field) VALUES($values)";
            $result = parent::query($sql);
            if ($result){
                return $this->insert_id;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    
    public function update ($table, $data, $where) {
        try {
            if (empty($table)) throw new Exception('数据编辑失败');
            if (empty($data)) throw new Exception('数据编辑失败');
            $datas = '';
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    $datas .= $key . "='" . addslashesed($value) . "',";
                } elseif(is_numeric($value)) {
                    $datas .= $key . "=" . $value . ",";
                } else {
                    throw new Exception('数据编辑失败');
                }
            }
            $datas = rtrim($datas, ',');
            $sql = "UPDATE `{$table}` SET {$datas}";
            if (!empty($where)){
                $sql .= " WHERE $where";
            }
            return parent::query($sql) ? true : false;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    
    public function delete ($table, $where='') {
            if (empty($table)) return false;
            if (empty($where)) return false;
            $sql = "DELETE FROM `{$table}` WHERE {$where}";
            return parent::query($sql) ? true : false;
    }
    
    public function __destruct(){
        $this->close();
    }
}
?>
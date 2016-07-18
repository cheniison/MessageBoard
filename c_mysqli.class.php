<?php

class c_mysqli{

    private $con;

    /*
    *function:show error
    */
    public function showErr($error)
    {
        die("ERROR: " . $error);
    }

    /*
    *function:connect to database
    */
    public function connectMysql($dbname, $config)
    {

        if(!($this->con = mysqli_connect($config['HOST'], $config['USERNAME'], $config['PASSWORD']))) {
            $this->showErr(mysqli_connenct_error());
        }

        if(!mysqli_select_db($this->con, $dbname)) {
            $this->showErr(mysqli_error($this->con));
        }
    }

    /*
    *function:make mysql query
    */
    public function mkQuery($sql)
    {
        if(!($query = mysqli_query($this->con, $sql))) {
            $this->showErr($sql . "<br />" . mysqli_error($this->con));
        } else {
            return $query;
        }
    }

    /*
    *function:return all things founded
    */
    public function findAll($query)
    {
        while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC))
        {
            $list[] = $rs;
        }
        return isset($list) ? $list : "";
    }

    /*
    *function:insert data
    */
    public function insertData($table, $arr)
    {
        foreach ($arr as $key => $value) {
            $keyArr[] = "`" . $key . "`";
            $valueArr[] = "'" . $value . "'";
        }

        $keys = implode(",", $keyArr);
        $values = implode(",", $valueArr);
        $sql = "INSERT INTO " . $table . "(" . $keys . ") VALUES(" . $values . ")";
        return $this->mkQuery($sql);
    }

    /*
    *function:update data
    */
    public function updateData($table, $arr, $where)
    {
        foreach ($arr as $key => $value) {
            $keyAndvalueArr[] = "`" . $key . "`='" . $value . "'";
        }

        $keyAndvalues = implode(",", $keyAndvalueArr);
        $sql = "UPDATE " . $table . " SET " . $keyAndvalues . " WHERE " . $where;
        $this->mkQuery($sql);
    }

    /*
    *function:delete data
    */
    public function delData($table, $where)
    {
        $sql = "DELETE FROM " . $table . " WHERE " . $where;
        $this->mkQuery($sql);
    }


    /*
    *function:colse connection
    */
    public function closeConnection()
    {
        mysqli_close($this->con);
    }
}

<?php 

class MyModels extends DB {

    function select_array($table = '',$data = '*', $where = NULL,$orderby = NULL,$start = NULL, $limit = NULL){
        $sql ="SELECT $data FROM $table";
        if (isset($where) && $where != NULL) {
        $fields = array_keys($where);
        $fields_list = implode("",$fields);
        $values = array_values($where);
        $isFields = true;
        $stringwhere = 'where';
        for ($i=0; $i < count($fields); $i++) {
        if (!$isFields) {
        $sql .= " and ";
        $stringwhere = '';
        }
        $isFields = false;
        $sql .= " ".$stringwhere." ".$fields[$i]." = ? ";
    }
        if ($orderby != "" && $orderby != NULL) {
        $sql .= " ORDER BY ".$orderby."";
        }

        if ($limit != NULL) {
        $sql .= " LIMIT ".$start.", ".$limit."";
        }
        
        $query = $this->conn->prepare($sql);
        $query->execute($values);
    }
        else{
        
        if ($orderby != '' && $orderby != NULL) {
        $sql .= " ORDER BY ".$orderby."";
        }
        if ($limit != NULL) {
        $sql .= " LIMIT ".$start.", ".$limit."";
        
        }
       
        $query = $this->conn->prepare($sql);
        $query->execute();
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    function add($table,$data=null) {
            $fields = array_keys($data);
            $fields_list = implode(',', array_map(function($field) {
                return "`$field`";
            }, $fields));
            $values = array_values($data);
            $qr = str_repeat('?,', count($fields)-1);
            $sql = "INSERT INTO `".$table."`(".$fields_list.") VALUES (${qr}?)";
             $query = $this->conn->prepare($sql);
             
             if ($query -> execute($values)) {
                return json_encode(
                    array(
                        'type'           => 'successfully',
                        'message'        => 'insert data success',
                    )
                );
             }
             else {
                return json_encode(
                    array(
                        'type'           => 'fails',
                        'message'        => 'insert data unsuccess',
                    
                    )
                );
             }
            
            
            
    }
    function update($table, $data = NULL, $where = NULL)
{
    if ($data !== NULL && $where !== NULL) {
        $fields = array_keys($data);
        $values = array_values($data);
        $where_array = array_keys($where);
        $values_where = array_values($where);
        $sql = "UPDATE $table SET ";
        $isFields = true;
        $isFields_where = true;
        $params = [];

        // Construct the SET clause
        for ($i = 0; $i < count($fields); $i++) {
            if (!$isFields) {
                $sql .= ", ";
            }
            $isFields = false;
            $sql .= $fields[$i] . " = ?";
            $params[] = $values[$i];
        }

        // Construct the WHERE clause
        if (!empty($where_array)) {
            $sql .= " WHERE ";
            for ($i = 0; $i < count($where_array); $i++) {
                if (!$isFields_where) {
                    $sql .= " AND ";
                }
                $isFields_where = false;
                $sql .= $where_array[$i] . " = ?";
                $params[] = $values_where[$i];
            }
        }

        $query = $this->conn->prepare($sql);
        if ($query->execute($params)) {
            return json_encode(
                array(
                    'type'    => 'successfully',
                    'message' => 'update data success',
                )
            );
        } else {
            return json_encode(
                array(
                    'type'    => 'fails',
                    'message' => 'update data unsuccess',
                )
            );
        }
    }
}
    function delete($table, $where = NULL)
    {
        $sql = "DELETE FROM $table ";
        if ($where !== NULL) {
            $where_array = array_keys($where);
            $values_where = array_values($where);
            $isFields_where = true;
            $params = [];

            // Construct the WHERE clause
            if (!empty($where_array)) {
                $sql .= " WHERE ";
                for ($i = 0; $i < count($where_array); $i++) {
                    if (!$isFields_where) {
                        $sql .= " AND ";
                    }
                    $isFields_where = false;
                    $sql .= $where_array[$i] . " = ?";
                    $params[] = $values_where[$i];
                }
            }

            $query = $this->conn->prepare($sql);
            if ($query->execute($params)) {
                return json_encode(
                    array(
                        'type'    => 'successfully',
                        'message' => 'delete data success',
                    )
                );
            } else {
                return json_encode(
                    array(
                        'type'    => 'fails',
                        'message' => 'delete data unsuccess',
                    )
                );
            }
        }
    }
    function select_row ($table,$data="*",$where) {
        $sql = "SELECT $data FROM $table ";
        if ($where != NULL) {
            $where_array = array_keys($where);
            $values_where = array_values($where);
            $isFields_where = true;
            $params = [];
            // Construct the WHERE clause
            if (!empty($where_array)) {
                $sql .= " WHERE ";
                for ($i = 0; $i < count($where_array); $i++) {
                    if (!$isFields_where) {
                        $sql .= " AND ";
                    }
                    $isFields_where = false;
                    $sql .= $where_array[$i] . " = ?";
                    $params[] = $values_where[$i];
                }
            }
            
            $query = $this->conn->prepare($sql);
            $query->execute($params);
            return $query->fetchColumn();
        }
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchColumn();
    }
    function select_row_orderbyDESC_limit ($table,$data="*",$where,$orderby,$limit) {
        $sql = "SELECT $data FROM $table ";
        if ($where != NULL) {
            $where_array = array_keys($where);
            $values_where = array_values($where);
            $isFields_where = true;
            $params = [];
            // Construct the WHERE clause
            if (!empty($where_array)) {
                $sql .= " WHERE ";
                for ($i = 0; $i < count($where_array); $i++) {
                    if (!$isFields_where) {
                        $sql .= " AND ";
                    }
                    $isFields_where = false;
                    $sql .= $where_array[$i] . " = ?";
                    $params[] = $values_where[$i];
                }
            }
            $sql .= " ORDER BY ".$orderby." DESC LIMIT ".$limit."";
            $query = $this->conn->prepare($sql);
            $query->execute($params);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    function select_row_orderbyASC_limit ($table,$data="*",$where,$orderby,$limit) {
        $sql = "SELECT $data FROM $table ";
        if ($where != NULL) {
            $where_array = array_keys($where);
            $values_where = array_values($where);
            $isFields_where = true;
            $params = [];
            // Construct the WHERE clause
            if (!empty($where_array)) {
                $sql .= " WHERE ";
                for ($i = 0; $i < count($where_array); $i++) {
                    if (!$isFields_where) {
                        $sql .= " AND ";
                    }
                    $isFields_where = false;
                    $sql .= $where_array[$i] . " = ?";
                    $params[] = $values_where[$i];
                }
            }
            $sql .= " ORDER BY ".$orderby." ASC LIMIT ".$limit."";
            
            $query = $this->conn->prepare($sql);
            $query->execute($params);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    function select_array_join_table ($table, $data = "*",$where = NULL,$orderby = NULL,$start = NULL, $limit = NULL, $table_join = NULL, $query_join = NULL ,$type_join = NULL) {
            $sql ="SELECT $data FROM $table";
            if (isset($where) && $where != NULL) {
                    $fields = array_keys($where);
                    $fields_list = implode("",$fields);
                    $values = array_values($where);
                    $isFields = true;
                    if ($table_join != NULL && $query_join != NULL &&$type_join != NULL) {
                        $sql .= ' '.$this->join_table($table_join,$query_join,$type_join).' ';
                     }
                    $stringwhere = 'where';
                    for ($i=0; $i < count($fields); $i++) {
                    if (!$isFields) {
                    $sql .= " and ";
                    $stringwhere = '';
                    }
                    $isFields = false;
                    $sql .= " ".$stringwhere." ".$fields[$i]." = ? ";
                }   
                    if ($orderby != "" && $orderby != NULL) {
                    $sql .= " ORDER BY ".$orderby."";
                    }
                    if ($limit != NULL) {
                    $sql .= " LIMIT ".$start." , ".$limit."";
                    }
                    
                    
                    $query = $this->conn->prepare($sql);
                    $query->execute($values);
            }
            else{
                if ($table_join != NULL && $query_join != NULL &&$type_join != NULL) {
                   $sql .= ' '.$this->join_table($table_join,$query_join,$type_join).' ';
                }
                if ($orderby != '' && $orderby != NULL) {
                $sql .= " ORDER BY ".$orderby."";
                }
                if ($limit != NULL) {
                $sql .= " LIMIT ".$start.", ".$limit."";
                }
                $query = $this->conn->prepare($sql);
                $query->execute();
                }
                return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    function selectPrice($id_mon_an,$size){
        $sql = "SELECT price FROM gia_mon_an WHERE id_mon_an = '$id_mon_an' AND size = '$size'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchColumn();
    }
    function query($query){
        $sql = $query;
        $query= $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    function checkuser ($username,$password) {
        $sql = "SELECT * FROM tai_khoan WHERE username='".$username."' AND password='".$password."' ";
        $qr = $this->conn->prepare($sql);
        $qr -> execute();
        $kq = $qr->fetchAll(PDO::FETCH_ASSOC);
        if (count($kq)>0) {
            return $kq[0]['type'];
        }
        else 
        return 2;
    }
    
    function getuserinfo ($username,$password) {
        $sql = "SELECT * FROM tai_khoan WHERE username='".$username."' AND password='".$password."' ";
        $qr = $this->conn->prepare($sql);
        $qr -> execute();
        $kq = $qr->fetchAll(PDO::FETCH_ASSOC);
        if ($kq==null) {
            $sql = "SELECT * FROM tai_khoan_kh WHERE username='".$username."' AND password='".$password."' ";
        }
        $qr = $this->conn->prepare($sql);
        $qr -> execute();
        $kq = $qr->fetchAll(PDO::FETCH_ASSOC);
        return $kq;
    }
    function createID ($table) {
        $sql = "SELECT CONCAT('CUSTOMER', LPAD(SUBSTRING(id, 9) + 1, 6, '0')) AS new_id FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->conn->prepare($sql);
        $query ->execute();
        $kq = $query ->fetchAll(PDO::FETCH_ASSOC);

        return $kq[0]['new_id'];
    }
    function pagination($total_page,$page){
        if ($total_page > 5) 
        {
            if ($page < 6) 
            {
                for ($i=1; $i <= 6 ; $i++) { 
                    $page_array[] = $i;
                }
                $page_array[] = "...";
                $page_array[] = $total_page;
            }
            else 
            {
                $end_limit = $total_page -5;
                if ($page > $end_limit) {
                    $page_array[] = 1;
                    $page_array[] = "...";
                    for ($i=$end_limit; $i < $total_page; $i++) { 
                        $page_array[] = $i;
                    }
                }
                else 
                {
                    $page_array[] = 1;
                    $page_array[] = "...";
                    for ($i=$page-1; $i <= $page+1 ; $i++) { 
                        $page_array[] = $i;
                    }
                    $page_array[] = "...";
                    $page_array[] = $total_page;
                }
            }
        }
        else 
        {
            for ($i=1; $i <= $total_page; $i++) 
            { 
                $page_array[] = $i;
            }
        }
        $page_link = "";
        $prev_link = "";
        $next_link = "";
        for ($i=0; $i < count($page_array); $i++) { 
            if ($page == $page_array[$i]) {
                $page_link .= '<li> 
                    <a href="javascript:void(0)" class="page-link active disabled btn text-dark" num-page="'.$page_array[$i].'">'.$page_array[$i].'</a>
                </li>';
                $prev_id = $page_array[$i] - 1;
                if ($prev_id <=0) {
                    $prev_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link disabled btn text-dark">❮</a>
                    </li>';
                }
                else
                {    
                    $prev_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link btn text-dark" num-page="'.$prev_id.'">❮</a>
                    </li>';
                }
                $next_id = $page_array[$i] + 1;
                if ($next_id > $total_page) {
                    $next_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link disabled btn text-dark">❯</a>
                    </li>';
                }
                else
                {
                    $next_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link btn text-dark" num-page="'.$next_id.'">❯</a>
                    </li>';
                }
            }
            else 
            {
                if ($page_array[$i]=="...") {
                    $page_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link disabled btn text-dark">...</a>
                    </li>';
                }
                else
                {
                    $page_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link btn text-dark" num-page="'.$page_array[$i].'">'.$page_array[$i].'</a>
                    </li>';
                }
            }
        }
        return $prev_link.$page_link.$next_link;
    }
}

?>
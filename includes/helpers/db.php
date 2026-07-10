<?php
    /**
     * adding function creating new record in DB
     * and add new element's data
     * @param string $table 
     * @param array $data
     * return array as assoc
     */
    if (!function_exists('adding')){
        function adding(string $table, array $data):array{
            $sql    = "INSERT INTO $table";
            $col = "";
            $val = "";
            foreach($data as $k => $v){
                $col .= "$k,";
                $val .= "'$v',";  
            }
            $col = rtrim($col, ',');
            $val = rtrim($val, ',');
            $sql .= " ($col) VALUES ($val) ;";
            mysqli_query($GLOBALS['connection'], $sql);
            $id = mysqli_insert_id($GLOBALS['connection']);
            $current = mysqli_query($GLOBALS['connection'], 
                        "select * from $table where id = $id");
            $fetch_curr = mysqli_fetch_assoc($current);
            return $fetch_curr;
        }
    }

/**
     * updating function update record in DB
     * @param int $id 
     * @param array $data
     * @param string $table
     * return array as assoc
     */
    if (!function_exists('update')){
        function update(int $id, string $table, array $data):array{
            $sql = "UPDATE $table SET ";
            $set = "";
            
            foreach($data as $fname => $val){
                $set .= "$fname = '$val',";
            }
            $set = rtrim($set, ',');
            $sql .= $set." where id = $id ;";
            mysqli_query($GLOBALS['connection'], $sql);
            $current = mysqli_query($GLOBALS['connection'], "select * from $table where id = $id");
            return mysqli_fetch_assoc($current);;
        }
    }

    /**
     * delete function to delete recorde
     * @param int $id
     * @param string $table
     * return mixed
     */

    if(!function_exists('delete')){
        function delete(int $id, string $table):mixed{
            return mysqli_query($GLOBALS['connection'],
                                "delete from $table where id = $id;");
        }
    }

    /**
     * fetch function to fetch recorde
     * @param int $id
     * @param string $table
     * return array
     */
    if(!function_exists('fetch')){
        function fetch(int $id, string $table):mixed{
            $query =  mysqli_query($GLOBALS['connection'],"select * from $table where id = $id;");
            return mysqli_fetch_assoc($query);;
        }
    }
    
    /**
     * search function to search for recorde
     * @param string $table
     * @param int $query
     * return array
     */
    if(!function_exists('search')){
        function search(string $table, string $query = "", string $col="*"):array{
            $find =  mysqli_query($GLOBALS['connection'], "select $col from $table $query;");
            $num_of_rows = mysqli_num_rows($find);
            return [
                'query' => $find,
                'rows'  => $num_of_rows
            ];
        }
    }

    /**
     * multi_rows function to multi_rows for recorde
     * @param string $table
     * @param int $query
     * return array of rows
     */
    if(!function_exists('multi_rows')){
        function multi_rows(string $table, string $where = ""):mixed{
            $where = $where == "" ? "" : " where $where";
            $query =  mysqli_query($GLOBALS['connection'],"select * from $table $where;");
            $rows = [];
            while($row = mysqli_fetch_assoc($query)){
                array_push($rows, $row);
            }
            return $ $rows;
        }
    }

    /**
     * paginate function to paginate for recorde
     * @param string $table
     * @param string $where
     * @param int $limit
     * return array ["query", "total_pages"] keys
     */
    if(!function_exists('paginate')){
        function paginate(string $table, string $where = "",string $col = "*", int $limit=3, array $req_append = []){
            $count_query = mysqli_query($GLOBALS['connection'],"select count($table.id) from $table $where;");
            $count = mysqli_fetch_assoc($count_query);
            $data_count = $count["count($table.id)"];
            $total_pages = ceil($data_count / $limit);
            if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
                $current_page = $_GET['page']-1;
            }else{
                $current_page = 0;
            }
           
             if($current_page >= $total_pages){
                $current_page = $total_pages == 0 ? $total_pages +1 : $total_pages-1;
            }
            $offset = $current_page * $limit;
            $query = mysqli_query($GLOBALS['connection'],"select $col from $table $where limit $offset,$limit;");
            $num_rows = mysqli_num_rows($query);
            return [
                'data'=>$query,
                'render_pages'=>render_paginate($total_pages, $req_append),
                'num_rows'=>$num_rows,
                'current_page'=>$current_page
                ];
        }
    }

    /**
     * render_pagitate function to render pagination for recorde 
     * @param int $total_pages
     * return string
     */
    if(!function_exists('render_paginate')){
        function render_paginate(int $total_pages, array $req_append):string{
            $appends = '';
            foreach($req_append as $name => $val){
                $appends .= $name.'='.$val.'&';
            }
            $appends .='page=';
            $render= "<ul class='pagination justify-content-center'>";
            if($total_pages > 0){
                for($i=1;$i<=$total_pages;$i++){
                    $active = (!empty(request('page')) && request('page') == $i) ||( $i == 1 && empty(request('page'))) ? 'active' : "";
                    $render.= "<li class='page-item '><a class='page-link $active' href=?$appends$i> $i</a></li>";
                    }
                $render.= "</ul>";
            }
            return $render;
        }
    }

    ////////////////////////////////////////////////////////////
//     if(!function_exists('paginate')){
//     function paginate(string $table, string $where = "", int $limit = 3){
//         $connection = $GLOBALS['connection'];

//         // بناء شرط WHERE بأمان
//         $where_clause = $where == "" ? "" : "WHERE $where";

//         // حساب العدد الكلي
//         $count_sql = "SELECT COUNT(id) AS total FROM $table $where_clause";
//         $count_result = mysqli_query($connection, $count_sql);
//         if(!$count_result){
//             // فشل الاستعلام
//             return ['data' => false, 'total_pages' => 0, 'error' => mysqli_error($connection)];
//         }
//         $data_count = (int) mysqli_fetch_assoc($count_result)['total'];

//         $total_pages = (int) ceil($data_count / $limit);

//         // تحديد الصفحة الحالية
//         $current_page = 1;
//         if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
//             $current_page = (int) $_GET['page'];
//         }

//         // التأكد أن الصفحة ضمن الحدود الصحيحة
//         if($current_page > $total_pages){
//             $current_page = $total_pages > 0 ? $total_pages : 1;
//         }

//         $offset = ($current_page - 1) * $limit;

//         $sql = "SELECT * FROM $table $where_clause LIMIT $offset, $limit";
//         $query = mysqli_query($connection, $sql);

//         return [
//             'data' => $query,
//             'total_pages' => $total_pages,
//             'current_page' => $current_page
//         ];
//     }
// }
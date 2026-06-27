<?php
    $routes_get  = isset($routes['get']) ? $routes['get'] : [];
    
    $gets = array_column($routes_get, 'segment');
    if(!isset($_POST['_method']) && !is_null(segment()) && !in_array(segment(), $gets)){
        $seg = segment();    
        if(preg_match('/^storage/i', $seg)){
                read_store($seg);
        }else{
                render('404.php');
        }
    }
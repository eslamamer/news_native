<?php
    if(!function_exists('config')){
        function config(string $path){
            $path_arr = explode('.', $path);
            if(count($path_arr) > 0){
                $include = include base_path("/../config/$path_arr[0].php");
                }
            return $include[$path_arr[1]];
        }
    }
    if(!function_exists('base_path')){
        function base_path(string $path){
            return getcwd().$path;
        }
    }
    
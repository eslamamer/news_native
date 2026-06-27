<?php
    if(!function_exists('upload_file')){
        function upload_file(array $from, string $to){
            $to = '/'.ltrim($to, '/');
            $to_path = config('files.path').$to;
            $from_path = '/'.ltrim($from['tmp_name'], '/');
            move_uploaded_file($from_path , $to_path);
            return $to;
        }
    }

    if(!function_exists('delete_file')){
        function delete_file(string $path){
            $path = '/'.ltrim($path, '/');
            $path = config('files.path').$path;
            if(file_exists($path )){
                unlink($path);
            }else{
                return false;
            }
        }
    }

    if(!function_exists('rename_file')){
        function rename_file(string $name){
        $exploded = explode('.', $name);
        $ext  = end($exploded);
        $new = date('Y-m-d h-i-s').".".$ext;
        return $new;
        }
    }

    if(!function_exists('icon_url')){
        function icon_url(string $path){
            $path = '/'.ltrim($path , '/');
            $path = '/storage/'.$path;
            return $path;
        }
    }


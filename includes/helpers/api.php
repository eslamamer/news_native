<?php
    if(!function_exists('api')){
        function api(array|null $data, $code = 200){
            header('Content-Type: application/json; charset=utf-8');
            http_response_code($code);
            return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }
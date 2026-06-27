<?php
    if(!function_exists('request')){
        function request(string $req = ''){
            if(isset($_FILES[$req]) && !empty($_FILES[$req])){
                return $_FILES[$req];
            }
            return isset($_REQUEST[$req]) ? $_REQUEST[$req] : null;
        }
    }
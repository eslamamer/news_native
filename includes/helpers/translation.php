<?php
    if(!function_exists('trans')){
        function trans(string $key){
            $default = has_session('lang') ? session('lang') : config('lang.default');
            $trans   = explode('.', $key);
            $path    = config('lang.path')."/$default/".$trans[0].".php";
            if(file_exists($path) && count($trans) > 0){
                $include = include $path;
                return isset($include[$trans[1]]) ? $include[$trans[1]] : $key ;
            }
            return $key;
        }
    }
    
    if(!function_exists('set_lang')){               
        function set_lang( $lang = null){
            session('lang', $lang);
        }
    }
    
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
    

    // if(!function_exists('trans')){
    //     function trans(string $key){
    //         static $cache = [];   // ← المفتاح: بتفضل موجودة بين كل استدعاءات trans() في نفس الطلب

    //         $default = has_session('lang') ? session('lang') : config('lang.default');
    //         $trans   = explode('.', $key);
    //         $file    = $trans[0];
    //         $path    = config('lang.path')."/$default/".$file.".php";

    //         // مفتاح فريد لكل تركيبة (لغة + ملف)، عشان لو اللغة اتغيرت وسط نفس الطلب
    //         $cache_key = $default.'.'.$file;

    //         if (!isset($cache[$cache_key])) {
    //             // أول مرة بس بيتم include للملف
    //             $cache[$cache_key] = file_exists($path) ? include $path : [];
    //         }

    //         $include = $cache[$cache_key];   // من الذاكرة مباشرة، مفيش include تاني

    //         return (count($trans) > 1 && isset($include[$trans[1]])) ? $include[$trans[1]] : $key;
    //     }
    // }
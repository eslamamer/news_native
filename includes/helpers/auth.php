<?php
    if(!function_exists('auth')){
        function auth(){
            if(has_session('admin')){
                return json_decode(session('admin'), true);
            }else{
                return null;
            }
        }
    }

    if(!function_exists('logout')){
        function logout(){
            remove_session('admin');
            redirect(ADMIN.'/signin');
        }
    }
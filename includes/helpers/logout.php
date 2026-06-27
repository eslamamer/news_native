<?php
    if(!function_exists('logout')){
        function logout(){
            remove_session('admin');
            redirect(ADMIN.'/signin');
        }
    }

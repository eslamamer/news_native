<?php
    if(!function_exists('view_img')){
        function view_img(string $url){
            render('admin.actions.view_img', ['image' => $url]);
        }
    }

    if(!function_exists('view_del')){
        function view_del(string $url){
            render('admin.actions.del_form', ['url' => $url]);
        }
    }
    
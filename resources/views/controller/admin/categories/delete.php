<?php
    $id = !is_null(request('id')) ? request('id') : redirect(aurl('categories')) ;
    $cat = fetch($id, 'categories');
    if(isset($cat['icon'])){
        delete_file($cat['icon']);
    }
    if(isset($cat)){
        delete($id, 'categories');
    }else{
        echo 'record not exists';
    }
    redirect(aurl('categories'));


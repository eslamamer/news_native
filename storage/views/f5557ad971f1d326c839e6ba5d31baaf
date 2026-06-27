<?php
    $id = !is_null(request('id')) ? request('id') : redirect(aurl('users')) ;
    $user = fetch($id, 'users');
    
    if(isset($user)){
        delete($id, 'users');
    }else{
        echo 'record not exists';
    }
    redirect(aurl('users'));


<?php
    $id = !is_null(request('id')) ? request('id') : redirect(aurl('comments')) ;
    $comment = fetch($id, 'comments');
    if(isset($comment)){
        delete($id, 'comments');
    }else{
        echo 'record not exists';
    }
    redirect(aurl('comments'));
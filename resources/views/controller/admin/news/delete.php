<?php
    $id = !is_null(request('id')) ? request('id') : redirect(aurl('categories')) ;
    $news = fetch($id, 'news');
    if(isset($news['image'])){
        delete_file($news['image']);
    }
    if(isset($new)){
        delete($id, 'news');
    }else{
        echo 'record not exists';
    }
    redirect(aurl('news'));


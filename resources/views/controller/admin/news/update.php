<?php

   $data = validate(
            [
                'title'       => 'require|string',
                'cat_id'      => 'require',
                'image'       => 'image' ,
                'description' => 'require|string',
                'content'     => 'require|string',
            ],
            [

                'title'       => trans('news.title'),
                'category'    => trans('cat.name'),
                'image'       => trans('news.image'),
                'description' => trans('news.description'),
                'content'     => trans('news.content'),
          ]
        );
//create function with this instructions
$id= request('id');
$news = fetch($id, 'news');
if(!empty($data['image']['name'])){
    if(!empty($news['image'])){
        delete_file($news['image']);  
    }
    $path = upload_file($data['image'], '/news/'.rename_file($data['image']['name']));
    $data['image']     = '/news/'.rename_file($data['image']['name']);
}else{
    unset($data['image']);
}
$data['user_id']   = auth()['id'];
$data['updated_at']= date('Y-m-d h-i-s');
var_dump($data);
update($id, 'news', $data);
redirect(aurl('news'));


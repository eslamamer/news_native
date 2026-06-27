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
if(!empty($data['image']['name'])){
    $file = rename_file($data['image']['name']);
    $path = upload_file($data['image'], '/news/'.$file);
    $data['image']     = $path;
}else{
    unset($data['image']);
}
$data['user_id']   = auth()['id'];
$data['created_at'] = date('Y-m-d h-i-s');
$data['updated_at']= date('Y-m-d h-i-s');
adding('news', $data);
redirect(aurl('news'));

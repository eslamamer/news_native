<?php

$data = validate(
            [
                'name'       => 'require|string',
                'icon'       => 'image' ,
                'description'=> 'require|string',
            ],
            [
                'name'       => trans('cat.name'  ),
                'icon'       => trans('cat.icon'),
                'description'=> trans('cat.description'),
            ]
        );
$id= request('id');
if(empty($data['icon']['tmp_name'])){
    unset($data['icon']);
}else{
    $category = fetch($id, 'categories');
    if(empty($category)){
        redirect(aurl('categories'));
    }
    delete_file($category['icon']);
    $data['icon'] = upload_file($data['icon'], '/categories/'.rename_file($data['icon']['name']));
}
update($id, 'categories', $data);
redirect(aurl('categories'));


<?php
   $data = validate(
            [
                'name'       => 'require|string',
                'icon'       => 'require|image' ,
                'description'=> 'require|string',
            ],
            [
                'name'       => trans('cat.name'  ),
                'icon'       => trans('cat.icon'),
                'description'=> trans('cat.description'),
            ]
        );
//create function with this instructions
$file = rename_file($data['icon']['name']);
$path = upload_file($data['icon'], '/categories/'.$file);
$data['icon'] = $path;
var_dump($data);
adding('categories', $data);
redirect(aurl('categories'));

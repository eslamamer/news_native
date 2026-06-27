<?php
    //var_dump(request('image'));
    //upload_file(request('image'), 'images/'.request('image')['name']);
    
    validate(
        [
            'name'    => 'require|string' ,
            'age'     => 'require|integer',
            'email'   => 'require|email'  ,
            'address' => 'require|string' ,
        ],
        [
            'name'    => trans('main.name'   ),
            'age'     => trans('main.age'    ),
            'email'   => trans('main.email'  ),
            'address' => trans('main.address'),
        ]
    );
        //var_dump($data) ;
        

    
   
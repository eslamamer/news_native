<?php
   $data = validate(
            [
                'name'     => 'require|string',
                'email'    => 'require|email|unique:users,email',
                'password' => 'require|password',
                'mobile'   => 'require|mobile|unique:users',
                'user_type'=> 'require|string|in:admin,user',
            ],
            [
                'name'     => trans('users.name'  ),
                'email'    => trans('users.email' ),
                'password' => trans('users.password'),
                'mobile'   => trans('users.mobile'),
                'user_type'=> trans('users.user_type'),
            ]
        );
//create function with this instructions
$data['password'] = encrypt($data['password']);

adding('users', $data);
remove_session('old');
redirect(aurl('users'));

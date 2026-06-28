<?php
$id= request('id');
$data = validate(
            [
                'name'     => 'require|string',
                'email'    => 'email|unique:users,email,'.$id ,
                'password' => 'password',
                'mobile'   => 'mobile|unique:users,mobile,'.$id,
                'user_type'=> 'require|string',
            ],
            [
                'name'     => trans('users.name'  ),
                'email'    => trans('users.email'),
                'password' => trans('users.password'),
                'mobile'   => trans('users.mobile'),
                'user_type'=> trans('users.user_type'),
           ]
        );

if(empty($data['password'])){
    unset($data['password']);
}else{
    $data['password'] = encrypt($data['password']);
}
if(empty($data['email'])){
    unset($data['email']);
}
if(empty($data['mobile'])){
    unset($data['mobile']);
}
update($id, 'users', $data);
redirect(aurl('users'));




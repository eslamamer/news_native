<?php
      $data =  validate(
        [
            'email'   => 'require|email'  ,
            'password'=> 'require|password' ,
        ],
        [
            'email'   => trans('admin.email'  ),
            'password'=> trans('admin.password'),
        ]
    );
    $user = mysqli_fetch_assoc(search('users', "where email = '".$data['email']."'")['query']);
    if(empty($user) || !empty($user) && (!pass_verify($data['password'], $user['password']) || $user['user_type'] != 'admin' )){
        session('errors', trans('admin.login_fail'));
        redirect(ADMIN.'/signin');
    }else{
        session('admin', json_encode($user, true));
        redirect(ADMIN);
   }
    // var_dump(session(ADMIN));   
    // }else{
    //     //session_flash('errors', [trans('validation.password')]);
    //     //redirect($_SERVER['HTTP_REFERER']);
    // }
    // $pass_verifcation = pass_verify($data['password'], $user['password']);
    //     if($pass_verifcation){
    //         session($user['user_type'], $user['user_type']);
    //         redirect(ADMIN);
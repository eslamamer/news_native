<?php
$id= request('id');
$data = validate(
            [
                'name'     => 'require|string',
                'email'    => 'require|email|unique:users,email,'.$id ,
                'password' => 'password',
                'mobile'   => 'require|mobile|unique:users,'.$id,
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
update($id, 'users', $data);
redirect(aurl('users'));





    // elseif(preg_match('/^unique/i', $rule)){
    //                     $table_ex = explode(':', $rule);
    //                     $table_feild = (count($table_ex) > 1) && isset($table_ex[1]) ? explode(',', $table_ex[1]) : "";
    //                     $table = $table_feild[0];
    //                     $sql = "where";
    //                     if(count($table_feild) > 1){
    //                         $feild = isset($table_feild[1]) ? $table_feild[1] : $attr;
    //                          $sql .= "$feild =".isset($values[$feild]) ? "'{$values[$feild]}'" : "'{$values[$attr]}'";
    //                      }else{
    //                        $sql .= isset($table_feild[2]) ? "&& id!=". $table_feild[2] : "";
    //                     }     
    //                     $user = search($table , $sql)['query'];
    //                     if(!is_null(mysqli_fetch_assoc($user))){
    //                         $attr_errors[] = str_replace(':attr', $trans_attr, trans('validation.exist'));
    //                     }
    //                 }


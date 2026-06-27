<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__."/../includes/app.php";
    view_init();























//echo session('lang');
//$last_add = adding("users", ['name'=>'ten', 'email'=>'ten@hh.com', 'password'=> 'three', 'mobile' => '012333333']);
//var_dump(updating(2, "users", ['name' => 'one' , 'email' => 'one@hh.com']));
//var_dump(delete(11, 'users'));
//var_dump(fetch(2, 'users'));
//var_dump(search('users', 'id = 5'));
//var_dump(multi_rows('users'));
// $count  = (count(paginate('users')));
// $i=0;
//  while($i < $count){
//   echo paginate('users')[$i]['email']."<br/>";
//   $i++;
//  }
// $users = paginate('users');
//  while($row = mysqli_fetch_assoc($users['data'])){
//   echo $row['email']."<br/>";
//  }
// echo render_paginate($users['total_pages']);
// echo "<br/>";
// print_r(apache_get_modules());
//echo "<br/>";
//session('user', 'hello');
//remove_session('user');
//remove_all_sessions();
//echo $_SESSION['user'];
/////////////////////////////////////////////////////////////////////////
// rout_get('/articl');
// rout_post('forms');
// rout_post('/rrr');
// echo "<pre>";
// global $routes;
// var_dump($routes);
//echo segment();
// echo "<pre>";


//symlink(config('files.path'),'storage');
//delete_file('storage/images/DSC.pdf');
//remove_folder('storage/images');


























ob_get_flush();
mysqli_close($connection);

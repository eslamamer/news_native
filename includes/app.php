<?php
    ob_start();
    $helpersPath =__DIR__.'/helpers/*.php';
    $files = glob($helpersPath);
    foreach ($files as $file) {
        require_once $file;
       //echo "$file <br/>";
    }
    session_save_path(config('session.session_save_path'));
    ini_set('session.gc_probability', 1);
    session_start(["cookie_lifetime" => config('session.expiration_time')]);
    
    has_session('lang') ? session('lang') : session('lang', 'ar');

    require_once __DIR__."/../routes/web.php"; 
    require_once __DIR__."/../includes/exeption_error.php";
    $connection = mysqli_connect(
                                config("database.server"),
                                config("database.name"),
                                config("database.password"),
                                config("database.database"),
                                config("database.port")
    );

    if(!$connection){
        die("connection failed".mysqli_connect_error());
    }

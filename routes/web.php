<?php
    include_once base_path('/../routes/admin.php');
    
    rout_get ('/'         , 'front.home'          );
    rout_get ('/signin'   , 'sign-in'             ); 
    rout_get ('/lang'     , 'controller.set_lang' );
    rout_get ('/about'    , 'about'               );
    rout_get ('/category' , 'front.category'      );
    rout_post('/art'      , 'art_sent'            );
    rout_post('/users'    , 'users'               );
    rout_post('/upload'   , 'controller.upload'   );
    
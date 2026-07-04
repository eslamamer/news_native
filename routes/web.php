<?php
    include_once base_path('/../routes/admin.php');
    
    rout_get ('/'         , 'front.home'                );
    rout_get ('/signin'   , 'sign-in'                   ); 
          
    rout_post ('/comment/news','front.categories.comments'         );
    rout_get ('/category' , 'front.categories.category' );
    rout_get ('/news'     , 'front.categories.news'     );
    rout_post('/art'      , 'art_sent'                  );
    rout_post('/users'    , 'users'                     );
          
          
      
    rout_get ('/lang'     , 'controller.set_lang'       );
    rout_post('/upload'   , 'controller.upload'         );
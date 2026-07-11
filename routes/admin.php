<?php
define('ADMIN', '/admin');

//admin auth routes
rout_get (ADMIN.'/logout', 'controller.admin.logout');
rout_post(ADMIN.'/login' , 'controller/admin/login' );

//admin config routes
rout_get(ADMIN          , 'admin.index');
rout_get(ADMIN.'/lang'  , 'controller.admin.admin_lang');
rout_get(ADMIN.'/signin', 'admin.signin' );
 
//admin categories routes
rout_get(ADMIN.'/categories'         , 'admin.categories.index');
rout_get(ADMIN.'/categories/create'  , 'admin.categories.create');
rout_get(ADMIN.'/categories/category', 'admin.categories.category');
rout_get(ADMIN.'/categories/edit'    , 'admin.categories.edit'  );

//admin categories CRUD routes
rout_post(ADMIN.'/categories/create', 'controller.admin.categories.create');
rout_post(ADMIN.'/categories/update', 'controller.admin.categories.update');
rout_post(ADMIN.'/categories/delete', 'controller.admin.categories.delete');

//admin categories routes
rout_get(ADMIN.'/comments'         , 'admin.comments.index'  );
rout_get(ADMIN.'/comments/comment' , 'admin.comments.comment');
rout_get(ADMIN.'/comments/edit'    , 'admin.comments.edit'   );

//admin comments CRUD routes
rout_post(ADMIN.'/comments/update', 'controller.admin.comments.update');
rout_post(ADMIN.'/comments/delete', 'controller.admin.comments.delete');

//admin news routes
rout_get(ADMIN.'/news'         , 'admin.news.index');
rout_get(ADMIN.'/news/create'  , 'admin.news.create');
rout_get(ADMIN.'/news/news'    , 'admin.news.news');
rout_get(ADMIN.'/news/edit'    , 'admin.news.edit'  );

//admin news CRUD routes
rout_post(ADMIN.'/news/create', 'controller.admin.news.create');
rout_post(ADMIN.'/news/update', 'controller.admin.news.update');
rout_post(ADMIN.'/news/delete', 'controller.admin.news.delete');

//admin users routes
rout_get(ADMIN.'/users'         , 'admin.users.index');
rout_get(ADMIN.'/users/create'  , 'admin.users.create');
rout_get(ADMIN.'/users/user'    , 'admin.users.user');
rout_get(ADMIN.'/users/edit'    , 'admin.users.edit'  );

//admin users CRUD routes
rout_post(ADMIN.'/user/create', 'controller.admin.user.create');
rout_post(ADMIN.'/user/update', 'controller.admin.user.update');
rout_post(ADMIN.'/user/delete', 'controller.admin.user.delete');




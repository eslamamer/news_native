<?php 
    $users = fetch(intval(request('id')), 'users');
    if(empty($users)){
        redirect(aurl('users'));
        exit();
    }
    $col       =  "users.id        as id,
                   news.id         as newsid,
                   users.name      as uname,
                   users.email,
                   users.user_type,
                   news.title,
                   users.mobile";
    $info = search('users', 
    "LEFT JOIN  news  on news.user_id = users.id 
     where users.id =".request('id'), $col)['query'];
    $all_info = mysqli_fetch_assoc($info);
    render('admin.layouts.header', ['title' => $all_info['uname']]);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{trans('users.user')}} - {{trans('admin.create')}}</h2>
        <a class="btn btn-info" href="{{aurl('users')}}">{{trans('users.users')}}</a>
    </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">{{trans('users.name')}}</label>
                <h3>{{$all_info['uname']}}</h3>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="email">{{trans('users.email')}}</label>
                <p><code>{{$all_info['email']}}</code></p>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="news">{{trans('news.title')}}</label>
                    <h5>{{$all_info['title']}}</h5>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="mobile">{{trans('users.mobile')}}</label>
                <p>{{$all_info['mobile']}}</p>    
        </div>
         <div class="col-md-12">
            <div class="form-group">
                <label for="user_type">{{trans('users.user_type')}}</label>
                <p>{{trans('users.'.$all_info['user_type'])}}</p>    
        </div>
</main>
<?php render('admin.layouts.footer'); ?>
<?php 
    render('admin.layouts.header', ['title' => trans('news.news')]);
    $news = fetch(intval(request('id')), 'news');
    if(empty($news)){
        redirect(aurl('news'));
    }
    $col       =  "news.id         as id,
                   users.id        as userid,
                   users.name      as auther,
                   categories.id   as catid,
                   categories.name as catname,
                   news.image,
                   news.title,
                   news.content,
                   news.created_at,
                   news.updated_at";
    $info = search('news', 
    "JOIN  categories on news.cat_id  = categories.id
     JOIN  users      on news.user_id = users.id 
     where news.id =".request('id'), $col)['query'];
    $all_info = mysqli_fetch_assoc($info)
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{trans('news.news')}} - {{trans('news.title')}}</h2>
        <a class="btn btn-info" href="{{aurl('news')}}">{{trans('news.news')}}</a>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">{{trans('news.title')}}</label>
                    <h3>{{$all_info['title']}}</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cat_id">{{trans('news.auther')}}</label>
                    <h4><a class="text-decoration-none" href="{{aurl('user?id='.$all_info['userid'])}}">{{$all_info['auther']}}</a></h4>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cat_id">{{trans('cat.name')}}</label>
                    <h4><a class="text-decoration-none" href="{{aurl('categories/category?id='.$all_info['catid'])}}">{{$all_info['catname']}}</a></h4>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image">{{trans('news.image')}}</label>
                    {{view_img(icon_url($all_info['image']))}}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content">{{trans('news.content')}}</label>
                <p>{{$all_info['content']}}</p>
            </div>
        </div>
</main>
<?php render('admin.layouts.footer'); ?>
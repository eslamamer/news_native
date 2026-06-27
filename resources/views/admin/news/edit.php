<?php render('admin.layouts.header', ['title' => trans('admin.edit')]);
    $id = intval(request('id'));
    $news = fetch($id, 'news');
    if(empty($news)){
        redirect(aurl('news'));
    }
    $cats = search('categories')['query'];
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{trans('news.news')}} - {{trans('admin.create')}}</h2>
        <a class="btn btn-info" href="{{aurl('news')}}">{{trans('news.news')}}</a>
    </div>
    <form action="{{aurl('/news/update?id=').$news['id']}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">{{trans('news.title')}}</label>
                    <input id="title" type="text" name="title" value="{{$news['title']}}" class="form-control mb-3" placeholder="{{trans('news.title')}}" />
                </div>
                {{ all_errors('title'); }}
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="auther">{{trans('news.auther')}}</label>
                    <input id="auther" type="text" name="auther" value="{{$news['auther']}}" class="form-control mb-3" placeholder="{{trans('news.auther')}}" />
                </div>
                {{ all_errors('title'); }}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cat_id">{{trans('cat.name')}}</label>
                    <select class="form-select" name="cat_id" id="cat_id">
                        <option disabled selected>{{trans('cat.select')}}</option>
                        <?php while($cat = mysqli_fetch_assoc($cats)): ?> 
                            <option <?php echo $cat['id'] == $news['cat_id'] ? 'selected' : "" ?> value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                {{ all_errors('category'); }}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image">{{trans('news.image')}}</label>
                    <input id="image" type="file" name="image" class="form-control mb-3" />
                </div>
                {{isset($news['image']) ? view_img(icon_url($news['image'])) : ""}}
                {{ all_errors('image'); }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content">{{trans('news.content')}}</label>
                <textarea id="content" name="content" class="form-control mb-3" placeholder="{{trans('news.content')}}">{{$news['content']}}</textarea>
            </div>
            {{ all_errors('content'); }}
        </div>
        <input type="submit" class="btn btn-success" value="{{trans('admin.create')}}"/>
    </form>
</main>
<?php render('admin.layouts.footer'); ?>
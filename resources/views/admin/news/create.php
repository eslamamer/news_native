<?php render('admin.layouts.header', ['title' => trans('news.category')]);
    $cats = search('categories')['query'];
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{trans('news.news')}} - {{trans('admin.create')}}</h2>
        <a class="btn btn-info" href="{{aurl('news')}}">{{trans('news.news')}}</a>
    </div>
    <form action="{{aurl('/news/create')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title">{{trans('news.title')}}</label>
                    <input id="title" type="text" name="title" value="{{old_values('title')}}" class="form-control mb-3" placeholder="{{trans('news.title')}}" />
                </div>
                {{ all_errors('title'); }}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cat_id">{{trans('cat.name')}}</label>
                    <select class="form-select" name="cat_id" id="cat_id">
                        <option disabled selected>{{trans('cat.select')}}</option>
                        <?php while($cat = mysqli_fetch_assoc($cats)): ?> 
                            <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
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
                {{ all_errors('image'); }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{trans('news.description')}}</label>
                <textarea id="description" name="description" class="form-control mb-3" placeholder="{{trans('news.description')}}">{{old_values('description')}}</textarea>
            </div>
            {{ all_errors('description'); }}
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content">{{trans('news.content')}}</label>
                <textarea id="content" name="content" class="form-control mb-3" placeholder="{{trans('news.content')}}">{{old_values('content')}}</textarea>
            </div>
            {{ all_errors('content'); }}
        </div>
        <input type="submit" class="btn btn-success" value="{{trans('admin.create')}}"/>
    </form>
</main>
<?php render('admin.layouts.footer'); ?>
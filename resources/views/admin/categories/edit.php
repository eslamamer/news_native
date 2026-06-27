<?php render('admin.layouts.header', ['title' => trans('admin.edit')]);
    $id = intval(request('id'));
    $category = fetch($id, 'categories');
    if(empty($category)){
        redirect(aurl('categories'));
    }
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{trans('cat.categories')}} - {{trans('admin.edit')}}</h2>
        <a class="btn btn-info" href="{{aurl('categories')}}">{{trans('cat.categories')}}</a>
    </div>
    <form action="{{aurl('/categories/update?id='.$category['id'])}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{trans('cat.name')}}</label>
                    <input id="name" type="text" name="name" value="{{$category['name']}}" class="form-control mb-3" placeholder="{{trans('cat.name')}}" />
                </div>
                {{ all_errors('name'); }}
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="icon">{{trans('cat.icon')}}</label>
                    <input id="icon" type="file" value="{{$category['icon']}}" name="icon" class="form-control mb-3" />
                    {{view_img(icon_url($category['icon']))}}
                </div>
                {{ all_errors('icon'); }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{trans('cat.description')}}</label>
                <textarea id="description" name="description" class="form-control mb-3" placeholder="{{trans('cat.description')}}">{{$category['description']}}</textarea>
            </div>
            {{ all_errors('description'); }}
        </div>
        <input type="submit" class="btn btn-success" value="{{trans('cat.save')}}"/>
    </form>
</main>
<?php render('admin.layouts.footer'); ?>
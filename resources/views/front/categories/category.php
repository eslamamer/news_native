<?php $cat = fetch(request('cat_id'), 'categories');
    if(empty($cat)){
      redirect('/');
    }
    render('front.layout.header', ['title' => trans('cat.'.$cat['name'])]);
?>
<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
  <div class="col-lg-6 px-0">
    <h1 class="display-4 fst-italic">
      {{$cat['name']}}
    </h1>
    <p class="lead my-3">
     {{$cat['description']}}
    </p>
    <p class="lead mb-0">
      <a href="#" class="text-body-emphasis fw-bold">Continue reading...</a>
    </p>
  </div>
</div>

<div class="row mb-2">
  <?php 
    $news_list = paginate('news','where cat_id = '.request('cat_id'))['data'];
    while($news = mysqli_fetch_assoc($news_list)):
  ?>
  <div class="col-md-6">
    <div
      class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
        <h3 class="mb-0">{{$news['title']}}</h3>
        <div class="mb-1 text-body-secondary">{{$news['updated_at']}}</div>
        <p class="card-text mb-auto">{{$news['description']}}</p>
        <a
          href="{{url('news?cat_id='.request('id').'&&id='.$news['id'])}}"
          class="icon-link gap-1 icon-link-hover stretched-link">
          {{trans('news.more')}}
          <svg class="bi" aria-hidden="true">
            <use xlink:href="#chevron-right"></use>
          </svg>
        </a>
      </div>
      <div class="col-auto d-none d-lg-block">

        <?php
          if(!empty($news['image'])){
            $img = url('/storage'.$news['image']);
          }elseif(!empty($news['icon'])){
            $img = url('/storage'.$news['icon']);
          }else{
            $img = url('/assets/images/icon.png');
          }
        ?>
        <img style="width:200px; height:100%;" src="{{$img}}" alt="icon">
        <!-- <svg
          aria-label="Placeholder: Thumbnail"
          class="bd-placeholder-img"
          height="250"
          preserveAspectRatio="xMidYMid slice"
          role="img"
          width="200"
          xmlns="http://www.w3.org/2000/svg">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#55595c"></rect>
          <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
        </svg> -->
      </div>
    </div>
  </div>
  <?php endwhile ?>
</div>

{{render('front.layout.footer')}}
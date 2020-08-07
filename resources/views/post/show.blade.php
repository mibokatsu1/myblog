@if($item !== '')
    <div class="headcopy">Title</div><hr>
    <div class="text">{{ $item->title }}</div>

    <div class="headcopy">Message</div><hr>
    <div class="text">{{ $item->message }}</div>
@endif


<div class="test">
      Hellow World
    </div>

    <div class="links">
      <a href="https://laravel.com/docs"><button class='btn btn-default'>Docs</button></a>
      <a href="https://laracasts.com"><button class='btn btn-primary'>Laracasts</button></a>
      <a href="https://laravel-news.com"><button class='btn btn-success'>News</button></a>
      <a href="https://blog.laravel.com"><button class='btn btn-info'>Blog</button></a>
      <a href="https://nova.laravel.com"><button class='btn btn-warning'>Nova</button></a>
      <a href="https://forge.laravel.com"><button class='btn btn-danger'>Forge</button></a>
      <a href="https://vapor.laravel.com"><button class='btn btn-link'>Vapor</button></a>
      <a href="https://github.com/laravel/laravel"><button class='btn btn-primary'>GitHub</button></a>
    </div>
  </div>
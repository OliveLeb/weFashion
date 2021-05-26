<nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand logo" href="{{route('home')}}">We Fashion</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('discount.products')}}">Solde</a>
        </li>
        @foreach ($categories as $id=>$category)
            <li class="nav-item">
                <a class="nav-link" href="{{route('category.products',$id)}}">{{$category}}</a>
            </li>
        @endforeach
    </ul>
  </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light bg-light border-bottom">
    @if(Route::is('admin.*'))
        <span class="navbar-brand logo">We Fashion</span>
    @else
        <a class="navbar-brand logo" href="{{route('home')}}">We Fashion</a>
    @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">


        <ul class="navbar-nav mr-auto">
            @if(Route::is('admin.*'))

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.products.index')}}">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">Catégories</a>
                </li>

            @else

                <li class="nav-item">
                    <a class="nav-link" href="{{route('discount.products')}}">Solde</a>
                </li>

                @foreach ($categories as $id=>$category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('category.products',$id)}}">{{$category}}</a>
                    </li>
                @endforeach

            @endif
        </ul>

        <div><hr class="dropdown-divider"></div>

        <ul class="navbar-nav ml-auto">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Route::is('admin.*'))
                            <li>
                                <a class="dropdown-item" href="{{route('home')}}"><i class="fas fa-tshirt go-to"></i> Home</a>
                            </li>
                            @else
                            <li>
                                <a href="{{route('admin.products.index')}}" class="dropdown-item"><i class="fas fa-table go-to"></i> Dashboard</a>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt log-out"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
  </div>
</nav>

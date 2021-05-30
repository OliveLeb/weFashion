
@if (count($products) !== 0)
<div class='products-count'>{{$products->total()}} résultats</div>
<ul class='row'>
    @foreach ($products as $product)
        <li class='col-md-4'>
            <div class="card my-3 p-2">
                @if ($product->is_discounted)
                    <span class="discount">En solde !</span>
                @endif
                <a href="{{route('show.product',$product->id)}}">
                    <div class="img-container">
                        <img src="{{asset('images/'.$product->picture->link)}}" alt="">
                    </div>
                </a>
                <div class="card-body">
                    <h5 class="card-title"><a href="{{route('show.product',$product->id)}}">{{$product->name}}</a></h5>
                    <span>{{$product->price}} €</span>
                </div>
            </div>
        </li>
    @endforeach
</ul>

@else

<div class='no-data'>
    <p>Oups ! Aucun produit ne correspond à votre recherche.</p>
</div>

@endif

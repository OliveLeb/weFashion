@extends('layouts.master')

@section('content')

<article class="row">

    <div class="col-md-6">
        <img src="{{asset('images/'.$product->picture->link)}}" alt="" >
    </div>
    <div class="col-md-6">
        <h2>{{$product->name}}</h2>
        <p>{{$product->description}}</p>
        <p>{{$product->price}} €</p>
        @if ($product->is_discounted)
            DISCOUNT!
        @endif
    </div>


</article>


@endsection

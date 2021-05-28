@extends('layouts.master')

@section('content')

<article class="row product-detail">

    <div class="col-md-6">
        <img src="{{asset('images/'.$product->picture->link)}}" alt="" >
    </div>
    <div class="col-md-6">
        <h2>{{$product->name}}</h2>
        <p>{{$product->description}}</p>
        <p>{{$product->price}} €</p>
        @if ($product->is_discounted)
            En solde !
        @endif
        <form action="">
            @csrf
            <select name="" id="">
                <option value="" disabled selected>Taille</option>
                @foreach ($product->sizes as $size)
                 <option value="{{$size->id}}">{{$size->size}}</option>
                @endforeach
            </select>
        </form>
        <button type="button" class="btn">Acheter</button>
    </div>


</article>

@endsection

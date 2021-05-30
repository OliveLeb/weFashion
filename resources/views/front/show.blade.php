@extends('layouts.master')

@section('content')

<article class="row product-detail">

    <div class="col-md-6">
        <div>
            <img src="{{asset('images/'.$product->picture->link)}}" alt="" >
        </div>
    </div>
    <div class="col-md-6">
        <h2>{{$product->name}}</h2>
        <p class="my-5">{{$product->description}}</p>
        <p class="my-5">{{$product->price}} €</p>
        @if ($product->is_discounted)
            <p>En solde !</p>
        @endif
        <form action="#" class="d-flex flex-column">
            @csrf
            <select class="form-select my-5">
                <option value="" disabled selected>Taille</option>
                @foreach ($product->sizes as $size)
                 <option value="{{$size->id}}">{{$size->size}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn">Acheter</button>
        </form>
    </div>


</article>


@endsection

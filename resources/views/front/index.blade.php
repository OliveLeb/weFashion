@extends('layouts.master')

@section('content')

<section class="container h-100">
    @include('partials.listing')

    {{$products->links()}}

</section>


@endsection

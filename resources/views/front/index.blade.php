@extends('layouts.master')

@section('content')

<section class="container h-100">
    @include('partials.listing')
</section>

{{$products->links()}}

@endsection

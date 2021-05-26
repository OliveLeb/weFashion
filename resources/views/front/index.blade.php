@extends('layouts.master')

@section('content')

<div class="container">
    @include('partials.listing')
</div>

{{$products->links()}}

@endsection

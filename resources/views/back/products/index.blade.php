@extends('layouts.master')

@section('content')


<div class='admin-title mb-5'>
    <h1>Produits</h1>
    <a class="btn btn-primary mb-3" href="{{route('admin.products.create')}}">Ajouter un produit</a>
</div>
@if(Session::has('success'))
<div class='alert'>
    <p>{{Session::get('success')}}</p>
</div>
@endif

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Categorie</th>
            <th>Prix</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Show</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($products as $product)
        <tr>
            <td><a href="{{route('admin.products.edit',$product->id)}}">{{$product->name}}</a></td>
            <td>
                @foreach ($product->categories as $category)
                        {{$category->category}},
                @endforeach
            </td>
            <td>{{$product->price}} €</td>
            <td>
                {{$product->is_discounted ? 'Soldé' : 'Stantard'}}
            </td>
            <td><a href="{{route('admin.products.edit',$product->id)}}"><i class="fas fa-edit text-primary"></i></a></td>
            <td><a href="{{route('admin.products.show',$product)}}"><i class="fas fa-eye text-primary"></i></a></td>
            <td>
            <form action="{{route('admin.products.destroy',$product->id)}}" method="POST" class="delete">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn"><i class="fas fa-trash-alt text-danger"></i></button>
            </form>
            </td>
        </tr>
    @empty
        <tr><td>Aucun Produit à afficher</td></tr>
    @endforelse
    </tbody>
</table>

{{$products->links()}}
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection

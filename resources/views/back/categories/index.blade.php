@extends('layouts.master')

@section('content')

<div class='admin-title mb-5'>
    <h1>Catégories</h1>
</div>

<div class ="my-5">
    <form action="{{route('admin.categories.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Nouvelle catégorie" name="category" required maxlength="45">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Ajouter la catégorie</button>
            </div>
        </div>
    </form>
</div>

@if(Session::has('success'))
<div class='alert'>
    <p>{{Session::get('success')}}</p>
</div>
@endif

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Catégorie</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>
                    <form action="{{route('admin.categories.update',$category)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" class="form-control" value={{$category->category}} name="category" required>
                        <input type="submit" id="{{'form-category-'.$category->id}}" >
                    </form>
                </td>
                <td><label for="{{'form-category-'.$category->id}}" tabindex="0" class="btn">edit</label></td>
                <td>
                    <form action="{{route('admin.categories.destroy',$category)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn"><i class="fas fa-trash-alt text-danger"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

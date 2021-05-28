@extends('layouts.master')

@section('content')

<h1>Ajouter un produit</h1>
<form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <section class="col-md-6">
            <div class="form-group">
                <label for="name">Nom : <sup class="error">*</sup></label>
                <input type="text" class="form-control" placeholder="Nom du produit" name="name" value="{{old('name')}}">
                @if($errors->name) <span class="error">{{$errors->first('name')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="description">Description : <sup class="error">*</sup></label>
                <textarea name="description" class="form-control" id="" cols="30" rows="10" value="{{old('description')}}"></textarea>
                @if($errors->description) <span class="error">{{$errors->first('description')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="price">Prix : <sup class="error">*</sup></label>
                <input type="number" class="form-control" name="price" id="" step="0.01">
                @if($errors->price) <span class="error">{{$errors->first('price')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="reference">Référence : <sup class="error">*</sup></label>
                <input type="text" class="form-control" name="reference" id="">
                @if($errors->reference) <span class="error">{{$errors->first('reference')}}</span> @endif
            </div>
        </section>
        <section class="col-md-6">

            <div class="form-group">
                <label for="picture">Choisisser un fichier <sup class="error">*</sup></label>
                <input type="file" class="form-control-file" id="picture" name="picture">
                @if($errors->picture) <span class="error">{{$errors->first('picture')}}</span> @endif
            </div>

            <div class="my-5">
                <h6>Catégories : <sup class="error">*</sup></h6>
                @foreach ($categories as $category)
                <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="{{'categories'.$category->id}}" name="categories[]" value="{{$category->id}}"
                        {{(is_array(old('categories')) && in_array($category->id,old('categories'))) ? 'checked' : ''}}>
                        <label class="form-check-label" for="{{'categories'.$category->id}}">{{$category->category}}</label>
                </div>
                @endforeach
                @if($errors->categories) <span class="error">{{$errors->first('categories')}}</span> @endif
            </div>

            <div class="my-5">
                <h6>Tailles : <sup class="error">*</sup></h6>
                @foreach ($sizes as $size)
                <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="{{'sizes'.$size->id}}" name="sizes[]" value="{{$size->id}}"
                        {{(is_array(old('sizes')) && in_array($size->id,old('sizes'))) ? 'checked' : ''}}>
                        <label class="form-check-label" for="{{'sizes'.$size->id}}">{{$size->size}}</label>
                </div>
                @endforeach
                @if($errors->sizes) <span class="error">{{$errors->first('sizes')}}</span> @endif
            </div>

            <div class="my-5">
                <h6>Status : <sup class="error">*</sup></h6>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_discounted" id="is_discounted1" value="1" {{old('is_discounted') ? 'checked' : ''}}>
                    <label class="form-check-label" for="is_discounted1">En solde</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_discounted" id="is_discounted2" value="0" {{! old('is_discounted') ? 'checked' : ''}}>
                    <label class="form-check-label" for="is_discounted2">Standard</label>
                </div>
            </div>

            <div class="my-5">
                <h6>Publication : <sup class="error">*</sup></h6>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="is_published" value="1" {{old('is_published') ? 'checked': ''}}>
                    <label for="is_published">Publier</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="is_published" value="0" {{! old('is_published') || old('is_published') == '' ? 'checked' : ''}}>
                    <label for="is_published">Brouillon</label>
                </div>
            </div>
        </section>
    </div>
    <sup class="error">* Ces champs sont requis.</sup>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

@endsection

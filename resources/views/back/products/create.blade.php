@extends('layouts.master')

@section('content')

<h1>Ajouter un produit</h1>
<form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <section class="col-md-6">
            <div class="form-group">
                <label for="name">Nom : <sup class="error">*</sup></label>
                <input type="text" class="form-control" placeholder="Nom du produit" name="name" value="{{old('name')}}" required>
                @if($errors->name) <span class="error">{{$errors->first('name')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="description">Description : <sup class="error">*</sup></label>
                <textarea name="description" class="form-control" id="" cols="30" rows="10" required>{{old('description')}}</textarea>
                @if($errors->description) <span class="error">{{$errors->first('description')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="price">Prix : <sup class="error">*</sup></label>
                <input type="number" class="form-control" name="price" id="" step="0.01" required>
                @if($errors->price) <span class="error">{{$errors->first('price')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="reference">Référence : <sup class="error">*</sup></label>
                <input type="text" class="form-control" name="reference" id="" required>
                @if($errors->reference) <span class="error">{{$errors->first('reference')}}</span> @endif
            </div>
        </section>
        <section class="col-md-6">

            <div class="form-group">
                <label for="picture">Choisisser un fichier</label>
                <input type="file" class="form-control-file add-picture" id="picture" name="picture">
                @if($errors->picture) <span class="error">{{$errors->first('picture')}}</span> @endif
            </div>

            <div class="my-5">
                <h6>Catégories : <sup class="error">*</sup></h6>
                @foreach ($categories as $id=>$category)
                <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="{{'categories'.$id}}" name="categories[]" value="{{$id}}"
                        {{(is_array(old('categories')) && in_array($id,old('categories'))) ? 'checked' : ''}}>
                        <label class="form-check-label" for="{{'categories'.$id}}">{{$category}}</label>
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
                    <input type="radio" class="form-check-input publish" name="is_published" value="1" {{old('is_published') ? 'checked': ''}}>
                    <label for="is_published">Publier</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="is_published" value="0" {{! old('is_published') || old('is_published') == '' ? 'checked' : ''}}>
                    <label for="is_published">Brouillon</label>
                </div>
            </div>
        </section>
    </div>
    <p><sup class="error">* Ces champs sont requis.</sup><p>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

@endsection

@section('scripts')
    @parent
    {{-- disable publish option if no picture has been added --}}
    <script src="{{asset('js/disable.js')}}"></script>
@endsection

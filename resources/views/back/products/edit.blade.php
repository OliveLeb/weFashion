@extends('layouts.master')

@section('content')

<h1>Modifier un produit</h1>
<form action="{{route('admin.products.update',$product)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <section class="col-md-6">
            <div class="form-group">
                <label for="name">Nom : <sup class="error">*</sup></label>
                <input type="text" class="form-control" placeholder="Nom du produit" name="name" value="{{old('name') ?? $product->name}}">
                @if($errors->name) <span class="error">{{$errors->first('name')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="description">Description : <sup class="error">*</sup></label>
                <textarea name="description" class="form-control" id="" cols="30" rows="10" >{{old('description') ?? $product->description}}</textarea>
                @if($errors->description) <span class="error">{{$errors->first('description')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="price">Prix : <sup class="error">*</sup></label>
                <input type="number" class="form-control" name="price" id="" step="0.01" value="{{old('price') ?? $product->price}}">
                @if($errors->price) <span class="error">{{$errors->first('price')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="reference">Référence : <sup class="error">*</sup></label>
                <input type="text" class="form-control" name="reference" id="" value="{{old('reference') ?? $product->reference}}">
                @if($errors->reference) <span class="error">{{$errors->first('reference')}}</span> @endif
            </div>
        </section>
        <section class="row col-md-6">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="picture">Choisisser un fichier</label>
                    <input type="file" class="form-control-file add-picture" id="picture" name="picture" value={{$product->picture->link}}>
                    @if($errors->picture) <span class="error">{{$errors->first('picture')}}</span> @endif
                </div>
                <div class="my-5">
                    <h6>Catégories : <sup class="error">*</sup></h6>
                    @foreach ($categories as $id=>$category)
                    <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="{{'categories'.$id}}" name="categories[]" value="{{$id}}"
                            {{
                            (
                                old('categories') ? in_array($id,old('categories')) :
                                in_array($id,$product->categories()->pluck('id')->all())
                            )
                            ? 'checked' : ''
                            }}>
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
                            {{
                                ( old('sizes') ? in_array($size->id,old('sizes')) : in_array($size->id,$product->sizes()->pluck('id')->all()) )
                                ? 'checked' : ''
                            }}>
                            <label class="form-check-label" for="{{'sizes'.$size->id}}">{{$size->size}}</label>
                    </div>
                    @endforeach
                    @if($errors->sizes) <span class="error">{{$errors->first('sizes')}}</span> @endif
                </div>

                <div class="my-5">
                    <h6>Status : <sup class="error">*</sup></h6>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_discounted" id="is_discounted1" value="1" {{( old('is_discounted') ?? $product->is_discounted ) ? 'checked' : ''}}>
                        <label class="form-check-label" for="is_discounted1">En solde</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_discounted" id="is_discounted2" value="0" {{ ! (old('is_discounted') ?? $product->is_discounted ) ? 'checked' : ''}}>
                        <label class="form-check-label" for="is_discounted2">Standard</label>
                    </div>
                </div>

                <div class="my-5">
                    <h6>Publication : <sup class="error">*</sup></h6>
                    <div class="form-check">
                        <input type="radio" class="form-check-input publish" name="is_published" value="1"
                        {{(old('is_published') ?? $product->is_published ) == true ? 'checked': ''}}
                        {{!$product->picture->link ? 'disabled' : ''}}
                        >
                        <label for="is_published">Publié</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="is_published" value="0" {{(old('is_published')  ?? $product->is_published) == false ? 'checked' : ''}}>
                        <label for="is_published">Brouillon</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h6>Image actuelle :</h6>
                @if ($product->picture->link)
                    <figure>
                        <img src="{{asset('images/'.$product->picture->link)}}" alt="">
                    </figure>
                @else
                    <p>Aucune image associée au produit actuellement.</p>
                @endif

            </div>
        </section>
    </div>
    <p><sup class="error">* Ces champs sont requis.</sup><p>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

@endsection

@section('scripts')
    @parent
    {{-- disable publish option if no picture has been added --}}
    <script src="{{asset('js/disable.js')}}"></script>
@endsection

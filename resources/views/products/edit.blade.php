@extends('layouts.main')
@section('title','Edit product')
@section('content')

  <!--start wrapper-->
    <div class="wrapper">
        <div class="card">
            <h5 class="mb-0">Edit product</h5>
        <div class="card-body">
            <form action="{{route('products.update',$product->id)}}" method="POST"  enctype="multipart/form-data" >
                {{ csrf_field() }}
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label  for="exampleInputPassword1">Category</label>
                            <select type="text" id="selectBox"  class="form-control" name="category" >
                                <option value="" selected disabled>Select Value</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}> {{ $category->name }}</option>
                            @endforeach
                            </select>
                            <span style="color:red;">
                                @if ($errors->has('category'))
                                <li>{{ $errors->first('category') }}</li>
                            @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div  class="form-group">
                            <label for="exampleInputPassword1">Sub Category</label>
                            <select type="text" class="form-control" id="selectSubBox"  name="subcategory">
                                <option value="{{ $product->subcategory_id }}">{{ $product->subcategory->name }}</option>
                            </select>
                            <span style="color:red;">
                                @if ($errors->has('subcategory'))
                                <li>{{ $errors->first('subcategory') }}</li>
                            @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div  class="form-group">
                            <label for="exampleInputPassword1">Product</label>
                            <input value="{{$product->name}}" type="text" class="form-control" name="name"  />
                            <span style="color:red;">
                                @if ($errors->has('name'))
                                <li>{{ $errors->first('name') }}</li>
                            @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div  class="form-group">
                            <label for="exampleInputPassword1">Price</label>
                            <input type="number" value="{{$product->price}}" class="form-control" name="price"  />
                            <span style="color:red;">
                                @if ($errors->has('price'))
                                <li>{{ $errors->first('price') }}</li>
                            @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div  class="form-group">
                    <label for="image">Image</label>
                    <div class="custom-file">
                        <label for="image" style="cursor: pointer;" class="alert alert-success w-100 text-center">Choose Image</label>
                        <input accept="image/*" type="file" class="custom-file-input" id="image" name="image" style='opacity: 0; position: absolute; z-index: -1;'>
                        <img id="blah" src="{{ asset($product->image)}}" alt="your image" class="m-auto text-center d-none img-fluid" style="width: 50px;height:50px;" />
                    </div>
                    <span style="color:red;">
                        @if ($errors->has('image'))
                        <li>{{ $errors->first('image') }}</li>
                    @endif
                    </span>
                </div>
                <div   class="form-group">
                <button type="submit" class="btn btn-outline-success w-100 mt-3 d-block">Update</button>
                </div>
            </form>
        </div>
        </div>
  </div>
@endsection
  @section('scripts')
  <script>
    $(document).ready(function() {
        $("#selectBox").on('change', function() {
            var SectionId = $(this).val();
            //console.log(SectionId);
            if (SectionId) {
                $.ajax({
                    url: "{{ URL('section') }}/" + SectionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('#selectSubBox').empty();
                        console.log(data);
                        $.each(data, function(key, value) {

                            $('#selectSubBox').append('<option value="' +
                                key + '">' + value + '</option>');
                                //console.log(key);
                        });
                    },
                });

            } else {
                console.log('AJAX load did not work');
            }
        });

    });

  </script>
  <script>
      var blah = document.getElementById('blah');

      image.onchange = evt => {
          blah.classList.toggle('d-none')
          blah.classList.toggle('d-block')
    const [file] = image.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
  </script>
  @endsection


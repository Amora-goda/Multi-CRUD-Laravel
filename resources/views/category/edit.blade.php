@extends('layouts.main')
@section('title','Edit Category')
@section('content')

  <!--start wrapper-->
<div class="wrapper">
     <div class="card">
        <h5 class="mb-0">{{__('main.editcategory')}}</h5>
       <div class="card-body">
                        <form action="{{route('categories.update',$categories->id)}}" method="post"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputPassword1">{{__('main.category')}}</label>
                                <input type="text" class="form-control" name="name" value={{$categories->name}} />
                                <small id="category_error" class="form-text text-danger"></small>
                            </div>


                            <div class="form-group">
                                <label for="image">{{__('main.image')}}</label>
                                <div class="custom-file">
                                    <label for="image" style="cursor: pointer;" class="alert alert-success w-100 text-center">{{__('main.chooseimage')}}</label>
                                    <input accept="image/*" type="file" class="custom-file-input" id="image" name="image" style='opacity: 0; position: absolute; z-index: -1;'>
                                    <img id="blah"  src="{{ asset($categories->image)}}"  alt="your image" class="m-auto text-center d-block img-fluid" style="width: 50px;height:50px;" />
                                </div>
                                <small id="image_error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{__('main.update')}}</button>
                            </div>
                        </form>
      </div>
     </div>
  </div>

  <script>

    image.onchange = evt => {
  const [file] = image.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
</script>


@endsection


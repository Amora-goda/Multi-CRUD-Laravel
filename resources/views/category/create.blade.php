@extends('layouts.main')
@section('title','Add Category')
@section('content')

  <!--start wrapper-->
<div class="wrapper">
     <div class="card">


       <div class="card-body">
        <h5 class="mb-0">{{__('main.categoriestable')}}</h5>
                        <form action="{{route('categories.store')}}" method="post"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputPassword1">{{__('main.category')}}</label>
                                <input type="text" class="form-control" name="name"  />

                                <small id="category_error" class="form-text text-danger"></small>
                            </div>


                            <div class="form-group">
                                <label for="image">{{__('main.image')}}</label>
                                <div class="custom-file">
                                    <label for="image" style="cursor: pointer;" class="alert alert-success w-100 text-center">{{__('main.chooseimage')}}</label>
                                    <input accept="image/*" type="file" class="custom-file-input" id="image" name="image" style='opacity: 0; position: absolute; z-index: -1;'>
                                    <img id="blah" src="#" alt="your image" class="m-auto text-center d-none img-fluid" style="width: 50px;height:50px;" />
                                </div>
                                <small id="image_error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-outline-success w-100 mt-3 d-block">{{__('main.save')}}</button>
                            </div>
                        </form>
      </div>
     </div>
  </div>
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

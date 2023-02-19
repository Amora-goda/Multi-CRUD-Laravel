@extends('layouts.main')
@section('title','Category')
@section('content')
@include('layouts.alerts')


  <!--start wrapper-->
<div class="wrapper">

    <div class="card">
        <div class="card-body">
            <h5 class="mb-0">{{__('main.subcategorytable')}}</h5>
            <button type="button" class="btn btn-outline-success w-100 d-block mb-4" data-bs-toggle="modal" data-bs-target="#addSubcategory">
                {{__('main.add subcategory')}}
            </button>
        </div>
          <div class="table-responsive mt-3">
            <table class="table align-middle mb-0">
              <thead class="table-light">
               <tr>
                <th>{{__('main.id')}}</th>
                <th>{{__('main.category')}}</th>
                 <th>{{__('main.subcategory')}}</th>
                 <th>{{__('main.actions')}}</th>
               </tr>
               </thead>
               <tbody>
            </tbody>
              </table>
          </div>

<!-- model store -->
<div class="modal fade" id="addSubcategory" tabindex="-1" aria-labelledby="addSubcategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="addSubcategoryLabel">{{__('main.add subcategory')}}</h5>
                <button type="button" class="btn-close btn border-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subForm">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('main.category')}}</label>
                            <select name="category_id" id="SlectBox"  class="form-control SlectBox" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">
                                <!--placeholder-->
                                <option value="" selected disabled>Select Value</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        <small id="category_error" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('main.subcategory')}}</label>
                        <input type="text" id="name"  class="form-control name_sub" name="name" />
                        <small id="name_error" class="form-text text-danger"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('main.close')}}</button>
                <button type="button" id="save_subcategory" class="btn btn-success">{{__('main.save')}}</button>
            </div>
        </div>
    </div>
</div>
<!-- end model store -->

<!-- model Edit -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close btn border-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="subFormUpdate" action="">
                    <input type="hidden" name="" id="idSub">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                            <select name="category_id" id="EditSlectBox"  class="form-control SlectBox" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">
                                <!--placeholder-->
                                <option value="" selected disabled>Select Value</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        <small id="category_error" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Sub Category</label>
                        <input type="text" class="form-control" name="name" id='nameEdit' />
                        <small id="name_error" class="form-text text-danger"></small>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" id="edit_subcategory" class="btn btn-success">Edit</button>
            </div>
        </div>
    </div>
</div>
<!-- end model Edit -->

<!-- model delete -->
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete SubCategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Confirm to Delete Data ?</h4>
                <input type="hidden" id="deleteing_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary delete_subcategory">Yes Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- end model delete -->
        {{-- </div>
            <div class="d-flex justify-content-center">
            {{ $subcategories->links() }}
           </div> --}}
      </div>
@endsection

@section('scripts')

<script>
    featch_data()


    function featch_data() {
        $.ajax({
            type: "GET",
            url: '/featchData',
            dataType: "json",
            success: function(response) {
                $('tbody').html("");
                //console.log(1234578)
               // console.log(response)
                $.each(response.subcategories, function(key, item) {
                  // console.log( item.name )

                    $("tbody").append('<tr>\
                                            <td>' + (key + 1) + '</td>\
                                            <td>' + item.category.name + '</td>\
                                            <td>' + item.name + '</td>\
                                            <td> <button subcategory_id="' + item.id + '"  class="delete_btn btn btn-outline-danger">{{__('main.delete')}}</button>\
                                            <button subcategory_id="' + item.id + '"  class="edit_btn btn btn-outline-primary">{{__('main.edit')}}</button>\
                                            </td>\
                                            </tr>\
                                            '

                    )
                })
            },
            error: function() {
                console.log('Error')
            }
        })
    }




    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        $(document).on('click', '#save_subcategory', function(e) {
            e.preventDefault();
            //console.log(123)
            $('#name_error').text('');
            $('#category_error').text('');

            var data = {
                'name': $('.name_sub').val(),
                'category_id':$('.SlectBox').val()
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
            console.log(data)
            $.ajax({
                type: 'POST',
                url: "/sub_categories",
                data: data,
                dataType:'json',
                success: function(data) {
                    $('#save_subcategory').prop('disabled', true);

                        //console.log(data.status);
                        featch_data()
                        $('#addSubcategory').modal('hide');

                        $('#name').text('');

                        toastr.success('Your Subcategory Added Successfully')
                        //$('#success_msg').show();
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                   // console.log(response.errors)
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });


        $(document).on('click', '.edit_btn', function(e) {
            e.preventDefault();
            var subcategory_id = $(this).attr('subcategory_id');
            var id = $(this).attr('subcategory_id');
            //console.log(id);

            $.ajax({
                type: 'GET',
                url: "edit/" + id,
                success: function(hamada) {
                   //console.log(hamada)
                    //console.log(hamada.subcategories.name)
                    //console.log(item)
                    $('#nameEdit').val(hamada.subcategories.name)
                    $('#EditSlectBox').val(hamada.subcategories.category_id)
                   // console.log(hamada.subcategories.category.name)
                    $('#idSub').val(hamada.subcategories.id)
                    $('#EditModal').modal('show');

                },
                error: function() {
                    console.log('Error')
                }
            });
        });

        $(document).on('click', '#edit_subcategory', function(e) {
            var id = $('#idSub').val();


            e.preventDefault();
            $('#name_error').text('');
            $('#category').text('');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data = {
                'name': $('#nameEdit').val(),
                'category_id':$('#EditSlectBox').val(),

            }
           // console.log(data)

            $.ajax({
                type: 'PUT',
                url: "update/" + id,
                data: data,
                success: function(data) {
                    $('#edit_subcategory').prop('disabled', true);

                       // console.log(data)
                        $('#EditModal').modal('hide');
                        featch_data()
                        $('#EditModal').find('input').val('');
                        toastr.success('Your SubCategory Updated Successfully')
                        //$('#success_msg').show();

                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    console.log(response.errors)
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var subcategory_id = $(this).attr('subcategory_id');
            $('#DeleteModal').modal('show');
            $('#deleteing_id').val(subcategory_id);
        });

        $(document).on('click', '.delete_subcategory', function(e) {
            e.preventDefault();
            var subcategory_id = $("#deleteing_id").val();

            $.ajax({
                type: 'DELETE',
                url: "delete/" + subcategory_id,
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': subcategory_id
                },
                success: function(data) {
                    if (data.status == true) {
                    $('.delete_subcategory').prop('disabled', true);

                        featch_data()

                        $('#DeleteModal').modal('hide');
                        toastr.success('Your subcategory Deleted Successfully')

                    }

                },
                error: function(reject) {}
            });
        });
    })
    </script>
    @endsection

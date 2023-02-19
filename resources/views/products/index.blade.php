@extends('layouts.main')
@section('title','Products')
@section('content')
@include('layouts.alerts')

  <!--start wrapper-->
<div class="wrapper">

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{$error}}</div>
    @endforeach
@endif

    <div class="card">
        <div class="card-body">
            <h5 class="mb-0">Products Table</h5>
            <div class="ms-auto">
                <a href="{{route('products.create')}}" class="form-control btn btn-outline-primary w-100 mt-5">Add Product</a>
            </div>
        </div>
          <div class="table-responsive mt-3">
            <table class="table align-middle mb-0">
              <thead class="table-light">
               <tr>
                 <th>Category</th>
                 <th>Sub Category</th>
                 <th>Product</th>
                 <th>Price</th>
                 <th>Photo</th>
                 <th>Actions</th>
               </tr>
               </thead>
               <tbody>
                @forelse($products as $product)

                <tr>
                    <td>{{$product->categories->name }}</td>
                    <td>{{$product->subcategory->name }}</td>
                    <th>{{$product->name }}</th>
                    <th>{{$product->price }}</th>
                    <td>
                        <div style="background-image:url({{ $product->image }});width: 5rem;height: 5rem;background-size: cover;background-position: center;border-radius: 50%;"></div>
                    </td>

                    <td>
                        @can('edit article')
                        <a  href="{{ route('products.edit', $product->id) }}"  class="btn btn-sm btn-outline-warning">Edit</a>
                        @endcan
                        @can('delete article')
                        <a   prodId={{$product->id}}  class="delete_btn btn btn-sm btn-outline-danger">Delete</a>
                        @endcan

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">No products defined.</td>
                </tr>
                @endforelse
            </tbody>
              </table>
          </div>
        </div>
      </div>

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
                    <button type="button" class="btn btn-outline-danger delete_product">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>

$(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var $this = $(this);
            var product_id = $(this).attr('prodId');
            console.log(product_id)
            $('#DeleteModal').modal('show');
            $('#deleteing_id').val(product_id);
            $('.delete_product').on('click', function() {
            var product_id = $("#deleteing_id").val();
            $.ajax({
                url: '{{ url('products') }}/' + product_id,
                type: 'post',
                data: {
                    '_method': 'delete',
                    '_token': "{{csrf_token()}}",
                },
                success: function (data) {
                        $('#DeleteModal').modal('hide');
                        $this.closest('tr').remove();
                        toastr.success('Your Product Deleted Successfully')
                },
                error: function (error) {
                    //  Error logic goes here..
                }
            });
            });
        });

</script>
@endsection


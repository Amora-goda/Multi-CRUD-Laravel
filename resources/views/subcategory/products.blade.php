@extends('layouts.main')
@section('title','Category')


@include('layouts.alerts')


<div class="wrapper">

        <!--start content-->
                 <div class="card">
                     <div class="card-body">
                         <div class="d-flex align-items-center">
                             <h5 class="mb-0">Products Table</h5>
                             <div class="ms-auto">
                                 <button type="button" class="form-control btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#addProduct" >Create Products</button>
                             </div>
                         </div>
                         <div class="table-responsive mt-3">
                             <table class="table align-middle mb-0">
                                 <thead class="table-light">
                                     <tr>
                                         <th>Product</th>
                                         <th>Price</th>
                                         <th>Image</th>
                                         <th>Sub Category</th>
                                         <th>Description</th>
                                         <th>Actions</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
          <!-- model store -->
          <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="addProductLabel">Create subcategory</h5>
                        <button type="button" class="btn-close btn border-0" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" wire:submit.prevent="storeProduct">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Products_id </label>
                                <input type="number" id="prod_id"  class="form-control" wire:model="prod_id">
                                @error('prod_id')
                                   <span class="text-danger" style='font-size:11.5px;'>{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Products</label>
                                <input type="text" id="product"  class="form-control" wire:model="name">
                                @error('product')
                                   <span class="text-danger" style='font-size:11.5px;'>{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Price</label>
                                <input type="number" id="price" class="form-control"  wire:model="price" />
                                @error('price')
                                   <span class="text-danger" style='font-size:11.5px;'>{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="custom-file">
                                    <label for="image" style="cursor: pointer;" class="alert alert-success w-100 text-center">Choose Image</label>
                                    <input accept="image/*" type="file" class="custom-file-input" id="image" wire:model="image" style='opacity: 0; position: absolute; z-index: -1;'>
                                    <img id="blah" alt="your image" class="m-auto text-center d-block img-fluid" style="width: 50px;height:50px;" />
                                </div>
                                @error('image')
                                   <span class="text-danger" style='font-size:11.5px;'>{{$message}}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <input type="text" id="desc" class="form-control" wire:model="desc" />
                                @error('desc')
                                   <span class="text-danger" style='font-size:11.5px;'>{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success mt-4">Add Product</button>

                            </div>

                        </form>
                </div>

            </div>
        </div>
        <!-- end model store -->
 </div>






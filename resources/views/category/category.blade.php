@extends('layouts.main')
@section('title','Category')
@section('content')
@include('layouts.alerts')


  <!--start wrapper-->
<div class="wrapper">

    <div class="card">
        <div class="card-body">
            <h5 class="mb-0">{{__('main.categoriestable')}}</h5>
            @can('create article')
            <div class="ms-auto">
                <a href="{{route('categories.create')}}" class="form-control btn btn-outline-primary w-100 mt-5">{{__('main.add category')}}</a>
            </div>
            @endcan
        </div>
          <div class="table-responsive mt-3">
            <table class="table align-middle mb-0">
              <thead class="table-light">
               <tr>
                 <th>{{__('main.category')}}</th>
                 {{-- <th>Sub Category</th> --}}
                 <th>{{__('main.subcategory')}}</th>
                 <th>{{__('main.actions')}}</th>
               </tr>
               </thead>
               <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div style="background-image:url({{ $category->image }});width: 5rem;height: 5rem;background-size: cover;background-position: center;border-radius: 50%;"></div>
                    <td>
                        <a  href="{{ route('categories.edit', $category->id) }}"  class="btn btn-sm btn-outline-success">{{__('main.edit')}}</a>
                        <a  href="{{ route('categories.delete', $category->id) }}"  class="btn btn-sm btn-outline-danger">{{__('main.delete')}}</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9">No categories defined.</td>
                </tr>
                @endforelse
            </tbody>
              </table>
          </div>
        </div>
      </div>


@endsection



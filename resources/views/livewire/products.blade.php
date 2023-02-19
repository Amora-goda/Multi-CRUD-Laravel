{{-- @extends('layouts.main') --}}
@section('title','Category')



<div>

    <div class="flex items-center justify-end py-4 text-right">
        <x-jet-button wire:click="showCreateModal">
            {{ __('Create product') }}
        </x-jet-button>
    </div>

    <table class="w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">{{ __('Sub Producs') }}</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">{{ __('Product') }}</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">{{ __('Price') }}</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">{{ __('Image') }}</th>
            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-blue-500 tracking-wider">{{ __('Actions') }}</th>
        </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($products as $product)
        <tr>
            <td class="px-6 py-3 border-b border-gray-200">{{ $product->subcategory->name }}</td>
            <td class="px-6 py-3 border-b border-gray-200">{{ $product->name }}</td>
            <td class="px-6 py-3 border-b border-gray-200">{{ $product->price }}</td>
            <td class="px-6 py-3 border-b border-gray-200"><img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" width="80"></td>
            <td class="px-6 py-3 border-b border-gray-200">

                    <x-jet-button class="mr-1" wire:click="showUpdateModal({{ $product->id }})">
                        {{ __('Edit') }}
                    </x-jet-button>

                    <x-jet-danger-button wire:click="showDeleteModal({{ $product->id }})">
                        {{ __('Delete') }}
                    </x-jet-danger-button>

            </td>
        </tr>
        @empty
        <tr>
            <td class="px-6 py-3 border-b border-gray-200" colspan="4">No products found!</td>
        </tr>
        @endforelse
        </tbody>
    </table>

    <div class="pt-4">
        {{ $products->links() }}
    </div>

    <x-jet-dialog-modal wire:model="modalFormVisible">

        <x-slot name="title">
            {{ $modalId ? __('Update product') : __('Create product') }}
        </x-slot>

        <x-slot name="content">



            <div class="mt-4">
                <x-jet-label for="category" value="{{ __('Category') }}"></x-jet-label>
                <select  id="selcategory" onchange="selectCategory(event)" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
                    <option value="">select value</option>
                    @foreach($categories as $sub)
                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                    @endforeach
                </select>
                @error('category')<span class="text-red-900 text-sm font-extrabold">{{ $message }}</span>@enderror
            </div>


            <div class="mt-4">
                <x-jet-label for="subcategory" value="{{ __('Sub Category') }}"></x-jet-label>
                <select id="selsubcategory" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" wire:model="subcategory">

                </select>
                @error('subcategory')<span class="text-red-900 text-sm font-extrabold">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4" >
                <x-jet-label for="product" value="{{ __('Product') }}" />
                <x-jet-input id="product" class="block mt-1 w-full" type="text" name="product" wire:model.defer="product"/>
                @error('product')<span class="text-red-900 text-sm font-extrabold">{{ $message }}</span>@enderror
            </div>

            <div class="mt-4" >
                <x-jet-label for="price" value="{{ __('Price') }}" />
                <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price" wire:model.defer="price"/>
                @error('price')<span class="text-red-900 text-sm font-extrabold">{{ $message }}</span>@enderror
            </div>


            <div class="mt-4">
                <x-jet-label for="image" value="{{ __('Image') }}"></x-jet-label>

                <div class="flex py-3">
                    @if ($image)
                        <div class="mt-1 mx-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                <img src="{{ asset('images/' . $image) }}" width="200">
                            </span>
                        </div>
                    @endif

                    {{-- @if ($product_image)
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                <img src="{{ $product_image->temporaryUrl() }}" width="200">
                            </span>
                        </div>
                    @endif --}}
                </div>

                <input type="file" name="product_image" accept="image/*" class="form-input flex-1 block w-full rounded-none rounded-r-md transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                {{-- @error('product_image')<span class="text-red-900 text-sm font-extrabold">{{ $message }}</span>@enderror --}}
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')">{{ __('Cancel') }}</x-jet-secondary-button>

            @if ($modalId)
                <x-jet-button class="ml-2" wire:click="update">{{ __('Update product') }}</x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="store">{{ __('Create product') }}</x-jet-button>
            @endif

        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="confirmproductDeletion">

        <x-slot name="title">
            {{ __('Delete product') }}
        </x-slot>

        <x-slot name="content">

            {{ __('Are you sure you want to delete this product?') }}

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmproductDeletion')">{{ __('Cancel') }}</x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="destroy">{{ __('Delete product') }}</x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>

</div>

@section('scripts')
<script>
$(document).ready(function() {
    $("#selcategory").on('change', function() {
        var SectionId = $(this).val();
        console.log(SectionId);
        if (SectionId) {
            $.ajax({
                url: "{{ URL('section') }}/" + SectionId,
                type: "GET",
                dataType: "json",
                success: function(data) {

                    $('#selsubcategory').empty();
                    console.log(data);
                    $.each(data, function(key, value) {

                        $('#selsubcategory').append('<option value="' +
                            value + '">' + value + '</option>');
                            //console.log(key);
                    });
                },
            });

        } else {
            console.log('AJAX load did not work');
        }
    });

});
// function selectCategory(event){
//     console.log(event.target.value)
//     var category_id=event.target.value

// }

</script>

@endsection


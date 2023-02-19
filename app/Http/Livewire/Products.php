<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Products extends Component
{
    use WithPagination, WithFileUploads;
    public $modalFormVisible = false;
    public $confirmproductDeletion  = false;
    public $subcategory;
    public $product;
    public $price;
    public $image;
    public $product_image;
    public $product_image_name;


    // public $listeners = ['showCreateModal'];
    public $modalId;

    public function rules()
    {
        return [


            'product' => ['required','string' ],
            'price' => ['required'],
            'product_image' => [Rule::requiredIf(!$this->modalId), 'max:1024']
        ];
    }

    public function modalFormReset()
    {
        $this->price = null;
        $this->subcategory= null;
        $this->product= null;
        $this->image = null;
        $this->product_image = null;

        $this->product_image_name = null;
        $this->modalId = null;

    }

    public function showUpdateModal($id){
        $this->modalFormReset();
        $this->modalFormVisible = true;
        $this->modalId = $id;
        $this->loadModalData();
    }
    public function modelData()
    {
        $data = [
            'subcategory_id' => $this->subcategory,
            'price' => $this->price,
            'name'=>$this->product,
            // 'category'=>$this->category,
        ];
        if ($this->product_image != ''){
            $data['image'] = $this->product_image_name;
        }
        dd($data);
        // return $data;
    }

    public function loadModalData()
    {
        $data = Product::find($this->modalId);
        $this->subcategory = $data->subcategory_id;
        $this->product = $data->name;
        $this->price = $data->price;
        $this->image = $data->image;

    }


    public function store()
    {

        $this->validate();
        if ($this->product_image != '') {
            $this->product_image_name = md5($this->product_image . microtime()).'.'.$this->product_image->extension();
            $this->product_image->storeAs('/', $this->product_image_name, 'uploads');
        }

        Product::create($this->modelData());
        dd(123);
        $this->modalFormReset();
        $this->modalFormVisible = false;

                    // Set Flash Message
            $this->dispatchBrowserEvent('alert',[
                'type'=>'success',
                'message'=>"Product Created Successfully!!"
            ]);

    }

    public function update()
    {
        $this->validate();
        $product = Product::where('id', $this->modalId)->first();
        if ($this->product_image != '') {
            if ($product->image != '') {
                if (File::exists('images/' . $product->image)) {
                    unlink('images/' . $product->image);
                }
            }
            $this->product_image_name = md5($this->product_image . microtime()) . '.' . $this->product_image->extension();
            $this->product_image->storeAs('/', $this->product_image_name, 'uploads');
        }

        $product->update($this->modelData());

        $this->modalFormVisible = false;
        $this->modalFormReset();

        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Product updeted Successfully!!"
        ]);

    }

//__________________
    public function showCreateModal(){
        $this->modalFormReset();
        $this->modalFormVisible = true;
        //dd(1234);
    }

    public function all_products(){
        return Product::latest('id')->with(['subcategory'])->paginate(5);
    }
    public function all_sub(){
        return Subcategory::get();
    }

    public function all_category(){
        return Category::get();
    }
    public function showDeleteModal($id)
    {
        $this->confirmproductDeletion = true;
        $this->modalId = $id;
    }

    public function destroy()
    {
        $product = Product::where('id', $this->modalId)->first();
        if ($product->image != '') {
            if (File::exists('images/' . $product->image)) {
                unlink('images/' . $product->image);
            }
        }

        $product->delete();
        $this->confirmproductDeletion = false;
        $this->resetPage();
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Product Deleted Successfully!!"
        ]);

    }


    public function render()
    {
        return view('livewire.products',[
           'products'=> $this->all_products(),
           'subcategories'=> $this->all_sub(),
           'categories'=>$this->all_category(),
        ]);
    }
}

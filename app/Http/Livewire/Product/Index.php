<?php

namespace App\Http\Livewire\Product;

use App\Brand;
use App\Category;
use App\Department;
use App\Product;
use App\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $name;
    public $pricefrom;
    public $pricetill;
    public $stocktill;
    public $brand;
    public $department;
    public $brandarray = array();

    public function mount()
    {
        if(request('getbrand')){
            $this->brandarray[] = intval(request('getbrand'));
        }else if(request('getsubcat')){
            foreach (SubCategory::findOrFail(intval(request('getsubcat')))->brands()->select('id')->get() as $item) {
                $this->brandarray[] = $item->id;
            }
        }else if(request('getcat')){
            foreach (Category::findOrFail(intval(request('getcat')))->subcategories as $subcat) {
                foreach ($subcat->brands()->select('id')->get() as $item) {
                    $this->brandarray[] = $item->id;
                }
            }
        }
        $this->name = '';
        $this->pricefrom = Product::min('price')/100;
        $this->pricetill = Product::max('price')/100;
        $this->stocktill = Product::max('stock');
    }
    public function render()
    {
        $products = Product::where('warehouse', 0)
                    ->where('title_ge', 'LIKE', '%'.$this->name.'%')
                    ->where('price', '>=', $this->pricefrom ? $this->pricefrom*100 : 0)
                    ->where('price', '<=', $this->pricetill ? $this->pricetill*100 : 0)
                    ->where('stock', '<=', $this->stocktill ?? 0)
                    ->where('brand_id', 'LIKE', '%'.$this->brand.'%');
                    if ($this->department) {
                        $products = $products->where('department_id', $this->department);
                    }
                    if ($this->brandarray) {
                        $products = $products->whereIn('brand_id', $this->brandarray);
                    }
                    
                    $products = $products->paginate(30);
                    $brands = Brand::all();
                    $departments = Department::all();
        return view('livewire.product.index', compact('brands', 'products', 'departments'));
    }
}

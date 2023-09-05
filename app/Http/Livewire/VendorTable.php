<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Engine;
use App\Models\Product;
use App\Models\Service;
use App\Models\Vendor;
use App\Models\PreludeNumber;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
// ... import other necessary models

class VendorTable extends Component
{
    public $edatas, $pdatas1, $pdatas2, $pdatas3, $pdatas4, $pdatas5, $pdatas6, $sdatas, $bdatas;

    public function mount() 
    {
        $this->vendors = Vendor::orderBy('name','ASC')->get() ?? collect();
        $this->pdatas = Product::all() ?? collect();
        $this->cdatas = Contact::all() ?? collect();
        $this->bdatas = Brand::all() ?? collect();
        $this->edatas = Engine::all() ?? collect();
        $this->sdatas = Service::all() ?? collect();
        $this->pdatas1 = Product::where('major_group','=',"1")->get() ?? collect();
        $this->pdatas2 = Product::where('major_group','=',"2")->get() ?? collect();
        $this->pdatas3 = Product::where('major_group','=',"3")->get() ?? collect();
        $this->pdatas4 = Product::where('major_group','=',"4")->get() ?? collect();
        $this->pdatas5 = Product::where('major_group','=',"5")->get() ?? collect();
        $this->pdatas6 = Product::where('product_misc','=',"1")->get() ?? collect();
    }

    public function render()
    {
        return view('livewire.vendor-table');
    }
}

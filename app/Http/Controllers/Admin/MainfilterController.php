<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Engine;
use App\Models\Product;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class MainfilterController extends Controller
{
    //
    public function index()
    {
        $vendors = Vendor::all();
        $pdatas = Product::all();
        $cdatas = Contact::all();
        $bdatas = Brand::all();
        $edatas = Engine::all();
        $sdatas = Service::all();
        $pdatas1 = Product::where('major_group','=',"1")->get();
        $pdatas2 = Product::where('major_group','=',"2")->get();
        $pdatas3 = Product::where('major_group','=',"3")->get();
        $pdatas4 = Product::where('major_group','=',"4")->get();
        $pdatas5 = Product::where('major_group','=',"5")->get();
        $pdatas6 = Product::where('product_misc','=',"1")->get();

//            ,function(Builder $query)
//    {
//        $query->where('name','like','zeze engine parts');
//
//    }
//


        return view('admin.vendorlookup.index', compact('vendors','pdatas1','pdatas6','pdatas2','pdatas3','pdatas4','pdatas5','pdatas','cdatas','bdatas','edatas','sdatas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show()
    {
        $vendors = Vendor::all();
        $pdatas = Product::all();
        $cdatas = Contact::all();
        $bdatas = Brand::all();
        $edatas = Engine::all();
        $sdatas = Service::all();
        $pdatas1 = Product::where('major_group','=',"1")->get();
        $pdatas2 = Product::where('major_group','=',"2")->get();
        $pdatas3 = Product::where('major_group','=',"3")->get();
        $pdatas4 = Product::where('major_group','=',"4")->get();
        $pdatas5 = Product::where('major_group','=',"5")->get();
        $pdatas6 = Product::where('product_misc','=',"1")->get();

//            ,function(Builder $query)
//    {
//        $query->where('name','like','zeze engine parts');
//
//    }
//


        return view('admin.vendorlookup.index', compact('vendors','pdatas1','pdatas6','pdatas2','pdatas3','pdatas4','pdatas5','pdatas','cdatas','bdatas','edatas','sdatas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor

     */
    public function getVendors(Request $request)

    {

        $pdatas = Product::all();


        $cdatas = Contact::all();
        $bdatas = Brand::all();
        $edatas = Engine::all();
        $sdatas = Service::all();

      $input = Product::where('id',"=", $request->product_id)->get('name');
      $input1 = Service::where('id',"=", $request->service_id)->get('name');
      $input2 = Brand::where('id',"=", $request->brand_id)->get('name');
      $input3 = Engine::where('id',"=", $request->engine_id)->get('name');
        $input4 = Product::where('id',"=", $request->product_misc_id)->get('name');
        $input5 = Product::where('major_group',"=", $request->major_group)->get('name');

        if($request->product_misc_id != "0"){
            $vendors = Vendor::with('vendorProducts')
                ->whereHas('vendorProducts',function (Builder $q) use ($request) {
                    $q->where('id','=',$request->product_misc_id);
                })->get();
            $s12 = "16";

        }else

      if($request->major_group != "0"){
          $vendors = Vendor::with('vendorProducts')
              ->whereHas('vendorProducts',function (Builder $q) use ($request) {
                  $q->where('major_group','=',$request->major_group);
              })->get();
          $s12 = "15";

      }else

        if($request->product_id != "0" && $request->service_id != "0"  && $request->brand_id != "0" && $request->brand_id != "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorProducts', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->product_id);
                })
                ->whereHas('vendorServices', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->service_id);
                })
                ->whereHas('vendorBrands', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->brand_id);
                })
                ->whereHas('vendorEngines', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->engine_id);
                })->get();
            $s12 = "1";

            //            return '1productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
        }
        elseif($request->product_id == "0" && $request->service_id != "0"  && $request->brand_id != "0" && $request->engine_id == "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorServices', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->service_id);
                })
                ->whereHas('vendorBrands', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->brand_id);

                })->get();
            $s12 = "2";

            //            return '2productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
        }
        elseif($request->product_id == "0" && $request->service_id != "0"  && $request->brand_id == "0" && $request->engine_id != "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorServices', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->service_id);
                })
                ->whereHas('vendorEngines', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->engine_id);
                })->get();
            $s12 = "3";

//            return '3productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
        }
        elseif($request->product_id == "0" && $request->service_id == "0"  && $request->brand_id != "0" && $request->engine_id != "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorBrands', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->brand_id);
                })
                ->whereHas('vendorEngines', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->engine_id);
                })->get();
            $s12 = "4";

//            return '4productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
        }
        elseif($request->product_id != "0" && $request->service_id == "0"  && $request->brand_id != "0" && $request->engine_id == "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorProducts', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->product_id);
                })
                ->whereHas('vendorBrands', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->brand_id);
                })->get();
//            return '5productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
            $s12 = "5";

        }
        elseif($request->product_id != "0" && $request->service_id == "0"  && $request->brand_id == "0" && $request->engine_id != "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorProducts', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->product_id);
                })
                ->whereHas('vendorEngines', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->engine_id);
                })->get();
            $s12 = "6";

//            return '6productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
        }
        elseif($request->product_id != "0" && $request->service_id != "0"  && $request->brand_id != "0" && $request->engine_id == "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorProducts', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->product_id);
                })
                ->whereHas('vendorServices', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->service_id);
                })
                ->whereHas('vendorBrands', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->brand_id);
                })->get();
//            return '7productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
            $s12 = "7";

        }
        elseif($request->product_id != "0" && $request->service_id != "0"  && $request->brand_id == "0" && $request->engine_id == "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorProducts', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->product_id);
                })
                ->whereHas('vendorServices', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->service_id);
                })->get();
//            return '8productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
            $s12 = "8";

        }
        elseif($request->product_id != "0" && $request->service_id == "0"  && $request->brand_id == "0" && $request->engine_id == "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorProducts', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->product_id);
                })->get();
            $s12 = "9";

//            return '9productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
        }
        elseif($request->product_id == "0" && $request->service_id != "0"  && $request->brand_id == "0" && $request->engine_id == "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorServices', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->service_id);
                })->get();
            $s12 = "10";

//            return '10productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
        }
        elseif($request->product_id == "0" && $request->service_id == "0"  && $request->brand_id != "0" && $request->engine_id == "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorBrands', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->brand_id);
                })->get();
            $s12 = "11";

//            return '11productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;
        }
        elseif($request->product_id == "0" && $request->service_id == "0"  && $request->brand_id == "0" && $request->engine_id != "0")
        {
            $vendors = Vendor::with('vendorProducts', 'vendorServices', 'vendorBrands', 'vendorEngines', 'vendorContacts')
                ->whereHas('vendorEngines', function (Builder $q) use ($request) {
                    $q->where('id', '=', $request->engine_id);
                })->get();
            $s12 = "12";

            //            return '12productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;

        }
        else{
            $vendors = Vendor::with('vendorProducts','vendorServices','vendorBrands','vendorEngines','vendorContacts')
                ->whereHas ('vendorProducts', function(Builder $q) use($request) {
                    $q->where('id', '=', $request->product_id);})

                ->orWhereHas('vendorServices', function (Builder  $q) use($request){
                    $q->where('id', '=', $request->service_id);
                }  )

                ->orWhereHas('vendorBrands', function (Builder  $q) use($request){
                    $q->where('id', '=', $request->brand_id);
                }  )

                ->orWhereHas('vendorEngines', function (Builder  $q) use($request) {
                    $q->where('id', '=', $request->engine_id);
                })->get();
//        return '13productid '.$request->product_id.' serviceid '.$request->service_id.' brandid '.$request->brand_id.' engineid '.$request->engine_id;

$s12 = " Search Parameters Not set";}

            return view('admin.vendorlookup.show', compact('vendors','s12','input','input1','input2','input3','input4','input5','pdatas','cdatas','bdatas','edatas','sdatas'));
    }
}

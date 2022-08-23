<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVendorRequest;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\Address;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Engine;
use App\Models\Note;
use App\Models\PreludeNumber;
use App\Models\Product;
use App\Models\Service;
use App\Models\Vendor;
use App\Models\VendorNumber;
use App\Models\Warranty;
use Gate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('vendor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Vendor::query()->select(sprintf('%s.*', (new Vendor())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'vendor_show';
                $editGate = 'vendor_edit';
                $deleteGate = 'vendor_delete';
                $crudRoutePart = 'vendors';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('ranking', function ($row) {
                return $row->ranking ? $row->ranking : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.vendors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vendors.create');
    }

    public function store(StoreVendorRequest $request)
          {
              $request->validate([
                  'name' => 'required',
              ]);



              $vid = Vendor::create(['name'=>$request->Vname,
                  'ranking'=>$request->ranking
              ]);

              $lastid = $vid->id;

              Contact::create(['name'=>$request->name,
                  'website'=>$request->website,
                  'email'=>$request->email,
                  'phone'=>$request->phone,
                  'extension'=>$request->extension,
                  'address'=>$request->address,
                  'city'=>$request->city,
                  'state'=>$request->state,
                  'zip'=>$request->zip,
                  'vendor_id'=>$lastid
              ]);


              if ($request->mpage = 1){
                  return redirect()->route('admin.vendors.show',$lastid)
                      ->with('success','Vendor Created Successfully/ Must Create Contact');}

              return redirect()->route('admin.vendors.index')
                  ->with('success','Vendor created successfully.');
          }



    public function edit(Vendor $vendor)
    {
        abort_if(Gate::denies('vendor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $vendor->update($request->all());

        return back();
    }

    public function show(Vendor $vendor)
    {
        $pdatas1 = Product::all();
        $cdatas1 = Contact::all();
        $bdatas1 = Brand::all();
        $edatas1 = Engine::all();
        $sdatas1 = Service::all();




        $pdatas = Product::whereHas('vendors', function(Builder $q) use($vendor) {
            $q->where('id', $vendor->id);})->orderBy('name', 'asc')->get();

        $cdatas = Contact::whereHas('vendor', function(Builder $q) use($vendor) {
            $q->where('id', $vendor->id);})->get();


        $bdatas = Brand::whereHas('vendors', function(Builder $q) use($vendor) {
            $q->where('id', $vendor->id);})->orderBy('name', 'asc')->get();

        $edatas = Engine::whereHas('vendors', function(Builder $q) use($vendor) {
            $q->where('id', $vendor->id);})->orderBy('name', 'asc')->get();

        $sdatas = Service::whereHas('vendors', function(Builder $q) use($vendor) {
            $q->where('id', $vendor->id);})->orderBy('name', 'asc')->get();

        //  $url = Storage::disk('local')->get();
       // $pdfs = Note::where([['vendor_id',$vendor->id],['title','=','null']])->get();
        $pdfs = Note::where('vendor_id',$vendor->id)->where('title',null)->get();
        $notes = Note::where('vendor_id',$vendor->id)->where('note',null)->get();
       // $notes = Note::where([['vendor_id',$vendor->id],['note','=','null']])->get();

        $warranties = Warranty::where('vendor_id',$vendor->id)->get();

        $addresses = Address::where('vendor_id',$vendor->id)->get();
        $vendornumbers = VendorNumber::where('vendor_id',$vendor->id)->get();
        $preludenumbers = PreludeNumber::where('vendor_id',$vendor->id)->get();

        return view('admin.vendors.show', compact('preludenumbers','pdfs','vendornumbers','addresses','warranties','notes','vendor','pdatas','cdatas','bdatas','edatas','sdatas','pdatas1','cdatas1','bdatas1','edatas1','sdatas1'))
            ->with('i', (request()->input('page', 1) - 1) * 20);

    }

    public function destroy(Vendor $vendor)
    {
        abort_if(Gate::denies('vendor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendor->delete();

        return back();
    }

    public function massDestroy(MassDestroyVendorRequest $request)
    {
        Vendor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function assign()
    {


        // $products = Product::latest()->paginate(5);
        $services = Service::all();
        $vendors = Vendor::all();
        //
        //$vendors = Vendor::has('products')->get();


        //  $test =   $products->vendors->first->body;

        return view('admin.vendors.assign',compact('services','vendors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignsla(Request $request)
    {

        if(isset($request->service_id)){

            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);

            $vend->vendorServices()->attach($request->service_id);
            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','services Assigned successfully');

        }
        if(isset($request->engine_id)){

            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);

            $vend->vendorEngines()->attach($request->engine_id);

            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','Engine Assigned successfully');

        }
        if(isset($request->contact_id)){
            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);

            $vend->vendorContacts()->attach($request->contact_id);

            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','Contact Assigned successfully');


        }
        if(isset($request->product_id)){
            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);

            $vend->vendorProducts()->attach($request->product_id);


            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','Products Assigned successfully');

        }
        if(isset($request->brand_id)){
            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);

            $vend->vendorBrands()->attach($request->brand_id);

            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','Brands Assigned successfully');

        }
        else
            return 'nothing';
        //
    }
    /**
     * Store a newly created resource in storage.
     *@param  \App\Models\Service  $sdata
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignsde(Request $request)
    {

        if(isset($request->service_id)){

            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);

            $vend->vendorServices()->detach($request->service_id);
            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','services deassigned successfully');

        }
        if(isset($request->engine_id)){

            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);

            $vend->vendorEngines()->detach($request->engine_id);

            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','Engine deassigned successfully');

        }
        if(isset($request->contact_id)){
            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);

            $vend->vendorContacts()->detach($request->contact_id);

            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','Contact deassigned successfully');


        }
        elseif(isset($request->product_id)){

            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);


            $vend->vendorProducts()->detach($request->product_id);


            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','Products deassigned successfully');

        }
        elseif(isset($request->brand_id)){
            $vendorupdated = $request->vendor_id;
            $vend = Vendor::find($request->vendor_id);

            $vend->vendorBrands()->detach($request->brand_id);

            return redirect()->route('admin.vendors.show',$vendorupdated)
                ->with('success','Brands deassigned successfully');

        }
        else
            return 'nothing';





        //
    }
}

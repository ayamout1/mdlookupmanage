<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVendorNumberRequest;
use App\Http\Requests\StoreVendorNumberRequest;
use App\Http\Requests\UpdateVendorNumberRequest;
use App\Models\Vendor;
use App\Models\VendorNumber;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VendorNumberController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('vendor_number_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VendorNumber::with(['vendor'])->select(sprintf('%s.*', (new VendorNumber())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'vendor_number_show';
                $editGate = 'vendor_number_edit';
                $deleteGate = 'vendor_number_delete';
                $crudRoutePart = 'vendor-numbers';

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
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });
            $table->addColumn('vendor_name', function ($row) {
                return $row->vendor ? $row->vendor->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'vendor']);

            return $table->make(true);
        }

        $vendors = Vendor::get();

        return view('admin.vendorNumbers.index', compact('vendors'));
    }

    public function create()
    {
        abort_if(Gate::denies('vendor_number_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vendorNumbers.create', compact('vendors'));
    }

    public function store(StoreVendorNumberRequest $request)
    {
        $vendorNumber = VendorNumber::create($request->all());

        return back();
    }

    public function edit(VendorNumber $vendorNumber)
    {
        abort_if(Gate::denies('vendor_number_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vendorNumber->load('vendor');

        return view('admin.vendorNumbers.edit', compact('vendorNumber', 'vendors'));
    }

    public function update(UpdateVendorNumberRequest $request, VendorNumber $vendorNumber)
    {
        $vendorNumber->update($request->all());

        return redirect()->route('admin.vendors.show',$request->vendor_id);
    }

    public function show(VendorNumber $vendorNumber)
    {
        abort_if(Gate::denies('vendor_number_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendorNumber->load('vendor');

        return view('admin.vendorNumbers.show', compact('vendorNumber'));
    }

    public function destroy(VendorNumber $vendorNumber)
    {
        abort_if(Gate::denies('vendor_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendorNumber->delete();

        return back();
    }

    public function massDestroy(MassDestroyVendorNumberRequest $request)
    {
        VendorNumber::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Models\Vendor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Address::with(['vendor'])->select(sprintf('%s.*', (new Address())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'address_show';
                $editGate = 'address_edit';
                $deleteGate = 'address_delete';
                $crudRoutePart = 'addresses';

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
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->editColumn('zipcode', function ($row) {
                return $row->zipcode ? $row->zipcode : '';
            });
            $table->addColumn('vendor_name', function ($row) {
                return $row->vendor ? $row->vendor->name : '';
            });

            $table->editColumn('vendor.ranking', function ($row) {
                return $row->vendor ? (is_string($row->vendor) ? $row->vendor : $row->vendor->ranking) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'vendor']);

            return $table->make(true);
        }

        $vendors = Vendor::get();

        return view('admin.addresses.index', compact('vendors'));
    }

    public function create()
    {
        abort_if(Gate::denies('address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addresses.create', compact('vendors'));
    }

    public function store(StoreAddressRequest $request)
    {
        $address = Address::create($request->all());

        return back();
    }

    public function edit(Address $address)
    {
        abort_if(Gate::denies('address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $address->load('vendor');

        return view('admin.addresses.edit', compact('address', 'vendors'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->all());

        return redirect()->route('admin.addresses.index');
    }

    public function show(Address $address)
    {
        abort_if(Gate::denies('address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->load('vendor');

        return view('admin.addresses.show', compact('address'));
    }

    public function destroy(Address $address)
    {
        abort_if(Gate::denies('address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddressRequest $request)
    {
        Address::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWarrantyRequest;
use App\Http\Requests\StoreWarrantyRequest;
use App\Http\Requests\UpdateWarrantyRequest;
use App\Models\Vendor;
use App\Models\Warranty;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WarrantyController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('warranty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Warranty::with(['vendor'])->select(sprintf('%s.*', (new Warranty())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'warranty_show';
                $editGate = 'warranty_edit';
                $deleteGate = 'warranty_delete';
                $crudRoutePart = 'warranties';

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
            $table->editColumn('warranty', function ($row) {
                return $row->warranty ? $row->warranty : '';
            });
            $table->addColumn('vendor_name', function ($row) {
                return $row->vendor ? $row->vendor->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'vendor']);

            return $table->make(true);
        }

        return view('admin.warranties.index');
    }

    public function create()
    {
        abort_if(Gate::denies('warranty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.warranties.create', compact('vendors'));
    }

    public function store(StoreWarrantyRequest $request)
    {
        $warranty = Warranty::create($request->all());

        return redirect()->route('admin.warranties.index');
    }

    public function edit(Warranty $warranty)
    {
        abort_if(Gate::denies('warranty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $warranty->load('vendor');

        return view('admin.warranties.edit', compact('vendors', 'warranty'));
    }

    public function update(UpdateWarrantyRequest $request, Warranty $warranty)
    {
        $warranty->update($request->all());

        return redirect()->route('admin.warranties.index');
    }

    public function show(Warranty $warranty)
    {
        abort_if(Gate::denies('warranty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warranty->load('vendor');

        return view('admin.warranties.show', compact('warranty'));
    }

    public function destroy(Warranty $warranty)
    {
        abort_if(Gate::denies('warranty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warranty->delete();

        return back();
    }

    public function massDestroy(MassDestroyWarrantyRequest $request)
    {
        Warranty::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

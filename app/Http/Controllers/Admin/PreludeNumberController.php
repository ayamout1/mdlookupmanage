<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPreludeNumberRequest;
use App\Http\Requests\StorePreludeNumberRequest;
use App\Http\Requests\UpdatePreludeNumberRequest;
use App\Models\PreludeNumber;
use App\Models\Vendor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PreludeNumberController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('prelude_number_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PreludeNumber::with(['vendor'])->select(sprintf('%s.*', (new PreludeNumber())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'prelude_number_show';
                $editGate = 'prelude_number_edit';
                $deleteGate = 'prelude_number_delete';
                $crudRoutePart = 'prelude-numbers';

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

        return view('admin.preludeNumbers.index', compact('vendors'));
    }

    public function create()
    {
        abort_if(Gate::denies('prelude_number_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.preludeNumbers.create', compact('vendors'));
    }

    public function store(StorePreludeNumberRequest $request)
    {
        $preludeNumber = PreludeNumber::create($request->all());

        return back();
    }

    public function edit(PreludeNumber $preludeNumber)
    {
        abort_if(Gate::denies('prelude_number_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $preludeNumber->load('vendor');

        return view('admin.preludeNumbers.edit', compact('preludeNumber', 'vendors'));
    }

    public function update(UpdatePreludeNumberRequest $request, PreludeNumber $preludeNumber)
    {
        $preludeNumber->update($request->all());

        return redirect()->route('admin.vendors.show',$request->vendor_id);
    }

    public function show(PreludeNumber $preludeNumber)
    {
        abort_if(Gate::denies('prelude_number_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $preludeNumber->load('vendor');

        return view('admin.preludeNumbers.show', compact('preludeNumber'));
    }

    public function destroy(PreludeNumber $preludeNumber)
    {
        abort_if(Gate::denies('prelude_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $preludeNumber->delete();

        return back();
    }

    public function massDestroy(MassDestroyPreludeNumberRequest $request)
    {
        PreludeNumber::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

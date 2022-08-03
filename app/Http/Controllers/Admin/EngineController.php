<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEngineRequest;
use App\Http\Requests\StoreEngineRequest;
use App\Http\Requests\UpdateEngineRequest;
use App\Models\Engine;
use App\Models\Vendor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EngineController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('engine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Engine::with(['vendors'])->select(sprintf('%s.*', (new Engine())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'engine_show';
                $editGate = 'engine_edit';
                $deleteGate = 'engine_delete';
                $crudRoutePart = 'engines';

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
            $table->editColumn('vendor', function ($row) {
                $labels = [];
                foreach ($row->vendors as $vendor) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $vendor->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'vendor']);

            return $table->make(true);
        }

        $vendors = Vendor::get();

        return view('admin.engines.index', compact('vendors'));
    }

    public function create()
    {
        abort_if(Gate::denies('engine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id');

        return view('admin.engines.create', compact('vendors'));
    }

    public function store(StoreEngineRequest $request)
    {
        $engine = Engine::create($request->all());
        $engine->vendors()->sync($request->input('vendors', []));

        return redirect()->route('admin.engines.index');
    }

    public function edit(Engine $engine)
    {
        abort_if(Gate::denies('engine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendors = Vendor::pluck('name', 'id');

        $engine->load('vendors');

        return view('admin.engines.edit', compact('engine', 'vendors'));
    }

    public function update(UpdateEngineRequest $request, Engine $engine)
    {
        $engine->update($request->all());
        $engine->vendors()->sync($request->input('vendors', []));

        return redirect()->route('admin.engines.index');
    }

    public function show(Engine $engine)
    {
        abort_if(Gate::denies('engine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $engine->load('vendors');

        return view('admin.engines.show', compact('engine'));
    }

    public function destroy(Engine $engine)
    {
        abort_if(Gate::denies('engine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $engine->delete();

        return back();
    }

    public function massDestroy(MassDestroyEngineRequest $request)
    {
        Engine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

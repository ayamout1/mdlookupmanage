<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEngineRequest;
use App\Http\Requests\UpdateEngineRequest;
use App\Http\Resources\Admin\EngineResource;
use App\Models\Engine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EngineApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('engine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EngineResource(Engine::with(['vendors'])->get());
    }

    public function store(StoreEngineRequest $request)
    {
        $engine = Engine::create($request->all());
        $engine->vendors()->sync($request->input('vendors', []));

        return (new EngineResource($engine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Engine $engine)
    {
        abort_if(Gate::denies('engine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EngineResource($engine->load(['vendors']));
    }

    public function update(UpdateEngineRequest $request, Engine $engine)
    {
        $engine->update($request->all());
        $engine->vendors()->sync($request->input('vendors', []));

        return (new EngineResource($engine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Engine $engine)
    {
        abort_if(Gate::denies('engine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $engine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

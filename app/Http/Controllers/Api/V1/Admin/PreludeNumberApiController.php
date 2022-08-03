<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePreludeNumberRequest;
use App\Http\Requests\UpdatePreludeNumberRequest;
use App\Http\Resources\Admin\PreludeNumberResource;
use App\Models\PreludeNumber;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreludeNumberApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prelude_number_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PreludeNumberResource(PreludeNumber::with(['vendor'])->get());
    }

    public function store(StorePreludeNumberRequest $request)
    {
        $preludeNumber = PreludeNumber::create($request->all());

        return (new PreludeNumberResource($preludeNumber))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PreludeNumber $preludeNumber)
    {
        abort_if(Gate::denies('prelude_number_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PreludeNumberResource($preludeNumber->load(['vendor']));
    }

    public function update(UpdatePreludeNumberRequest $request, PreludeNumber $preludeNumber)
    {
        $preludeNumber->update($request->all());

        return (new PreludeNumberResource($preludeNumber))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PreludeNumber $preludeNumber)
    {
        abort_if(Gate::denies('prelude_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $preludeNumber->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarrantyRequest;
use App\Http\Requests\UpdateWarrantyRequest;
use App\Http\Resources\Admin\WarrantyResource;
use App\Models\Warranty;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WarrantyApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('warranty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WarrantyResource(Warranty::with(['vendor'])->get());
    }

    public function store(StoreWarrantyRequest $request)
    {
        $warranty = Warranty::create($request->all());

        return (new WarrantyResource($warranty))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Warranty $warranty)
    {
        abort_if(Gate::denies('warranty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WarrantyResource($warranty->load(['vendor']));
    }

    public function update(UpdateWarrantyRequest $request, Warranty $warranty)
    {
        $warranty->update($request->all());

        return (new WarrantyResource($warranty))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Warranty $warranty)
    {
        abort_if(Gate::denies('warranty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $warranty->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

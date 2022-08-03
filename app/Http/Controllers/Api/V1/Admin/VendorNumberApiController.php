<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVendorNumberRequest;
use App\Http\Requests\UpdateVendorNumberRequest;
use App\Http\Resources\Admin\VendorNumberResource;
use App\Models\VendorNumber;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorNumberApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vendor_number_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VendorNumberResource(VendorNumber::with(['vendor'])->get());
    }

    public function store(StoreVendorNumberRequest $request)
    {
        $vendorNumber = VendorNumber::create($request->all());

        return (new VendorNumberResource($vendorNumber))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VendorNumber $vendorNumber)
    {
        abort_if(Gate::denies('vendor_number_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VendorNumberResource($vendorNumber->load(['vendor']));
    }

    public function update(UpdateVendorNumberRequest $request, VendorNumber $vendorNumber)
    {
        $vendorNumber->update($request->all());

        return (new VendorNumberResource($vendorNumber))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VendorNumber $vendorNumber)
    {
        abort_if(Gate::denies('vendor_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vendorNumber->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

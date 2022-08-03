@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vendor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vendors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.vendor.fields.id') }}
                        </th>
                        <td>
                            {{ $vendor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vendor.fields.name') }}
                        </th>
                        <td>
                            {{ $vendor->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vendor.fields.ranking') }}
                        </th>
                        <td>
                            {{ $vendor->ranking }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vendors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#vendor_addresses" role="tab" data-toggle="tab">
                {{ trans('cruds.address.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendor_contacts" role="tab" data-toggle="tab">
                {{ trans('cruds.contact.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendor_notes" role="tab" data-toggle="tab">
                {{ trans('cruds.note.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendor_prelude_numbers" role="tab" data-toggle="tab">
                {{ trans('cruds.preludeNumber.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendor_vendor_numbers" role="tab" data-toggle="tab">
                {{ trans('cruds.vendorNumber.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendor_warranties" role="tab" data-toggle="tab">
                {{ trans('cruds.warranty.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendor_brands" role="tab" data-toggle="tab">
                {{ trans('cruds.brand.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendor_engines" role="tab" data-toggle="tab">
                {{ trans('cruds.engine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendor_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#vendor_services" role="tab" data-toggle="tab">
                {{ trans('cruds.service.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="vendor_addresses">
            @includeIf('admin.vendors.relationships.vendorAddresses', ['addresses' => $vendor->vendorAddresses])
        </div>
        <div class="tab-pane" role="tabpanel" id="vendor_contacts">
            @includeIf('admin.vendors.relationships.vendorContacts', ['contacts' => $vendor->vendorContacts])
        </div>
        <div class="tab-pane" role="tabpanel" id="vendor_notes">
            @includeIf('admin.vendors.relationships.vendorNotes', ['notes' => $vendor->vendorNotes])
        </div>
        <div class="tab-pane" role="tabpanel" id="vendor_prelude_numbers">
            @includeIf('admin.vendors.relationships.vendorPreludeNumbers', ['preludeNumbers' => $vendor->vendorPreludeNumbers])
        </div>
        <div class="tab-pane" role="tabpanel" id="vendor_vendor_numbers">
            @includeIf('admin.vendors.relationships.vendorVendorNumbers', ['vendorNumbers' => $vendor->vendorVendorNumbers])
        </div>
        <div class="tab-pane" role="tabpanel" id="vendor_warranties">
            @includeIf('admin.vendors.relationships.vendorWarranties', ['warranties' => $vendor->vendorWarranties])
        </div>
        <div class="tab-pane" role="tabpanel" id="vendor_brands">
            @includeIf('admin.vendors.relationships.vendorBrands', ['brands' => $vendor->vendorBrands])
        </div>
        <div class="tab-pane" role="tabpanel" id="vendor_engines">
            @includeIf('admin.vendors.relationships.vendorEngines', ['engines' => $vendor->vendorEngines])
        </div>
        <div class="tab-pane" role="tabpanel" id="vendor_products">
            @includeIf('admin.vendors.relationships.vendorProducts', ['products' => $vendor->vendorProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="vendor_services">
            @includeIf('admin.vendors.relationships.vendorServices', ['services' => $vendor->vendorServices])
        </div>
    </div>
</div>

@endsection
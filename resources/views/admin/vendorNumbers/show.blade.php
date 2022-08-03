@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vendorNumber.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vendor-numbers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.vendorNumber.fields.id') }}
                        </th>
                        <td>
                            {{ $vendorNumber->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vendorNumber.fields.number') }}
                        </th>
                        <td>
                            {{ $vendorNumber->number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vendorNumber.fields.vendor') }}
                        </th>
                        <td>
                            {{ $vendorNumber->vendor->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vendor-numbers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
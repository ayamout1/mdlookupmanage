@extends('admin.admin_master')
@section('admin')

    <div style="padding-top: 30px"></div>
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.vendorNumber.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vendor-numbers.update", [$vendorNumber->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="number">{{ trans('cruds.vendorNumber.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="text" name="number" id="number" value="{{ old('number', $vendorNumber->number) }}">
                @if($errors->has('number'))
                    <span class="text-danger">{{ $errors->first('number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendorNumber.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vendor_id">{{ trans('cruds.vendorNumber.fields.vendor') }}</label>
                <select class="form-control select2 {{ $errors->has('vendor') ? 'is-invalid' : '' }}" name="vendor_id" id="vendor_id">
                    @foreach($vendors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('vendor_id') ? old('vendor_id') : $vendorNumber->vendor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('vendor'))
                    <span class="text-danger">{{ $errors->first('vendor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendorNumber.fields.vendor_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

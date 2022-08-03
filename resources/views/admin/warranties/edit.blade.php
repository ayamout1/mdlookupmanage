@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.warranty.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.warranties.update", [$warranty->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="warranty">{{ trans('cruds.warranty.fields.warranty') }}</label>
                <input class="form-control {{ $errors->has('warranty') ? 'is-invalid' : '' }}" type="text" name="warranty" id="warranty" value="{{ old('warranty', $warranty->warranty) }}">
                @if($errors->has('warranty'))
                    <span class="text-danger">{{ $errors->first('warranty') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.warranty.fields.warranty_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vendor_id">{{ trans('cruds.warranty.fields.vendor') }}</label>
                <select class="form-control select2 {{ $errors->has('vendor') ? 'is-invalid' : '' }}" name="vendor_id" id="vendor_id">
                    @foreach($vendors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('vendor_id') ? old('vendor_id') : $warranty->vendor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('vendor'))
                    <span class="text-danger">{{ $errors->first('vendor') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.warranty.fields.vendor_helper') }}</span>
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
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_misc">{{ trans('cruds.product.fields.product_misc') }}</label>
                <input class="form-control {{ $errors->has('product_misc') ? 'is-invalid' : '' }}" type="text" name="product_misc" id="product_misc" value="{{ old('product_misc', '') }}">
                @if($errors->has('product_misc'))
                    <span class="text-danger">{{ $errors->first('product_misc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_misc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="major_group">{{ trans('cruds.product.fields.major_group') }}</label>
                <input class="form-control {{ $errors->has('major_group') ? 'is-invalid' : '' }}" type="text" name="major_group" id="major_group" value="{{ old('major_group', '') }}">
                @if($errors->has('major_group'))
                    <span class="text-danger">{{ $errors->first('major_group') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.major_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vendors">{{ trans('cruds.product.fields.vendor') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('vendors') ? 'is-invalid' : '' }}" name="vendors[]" id="vendors" multiple>
                    @foreach($vendors as $id => $vendor)
                        <option value="{{ $id }}" {{ in_array($id, old('vendors', [])) ? 'selected' : '' }}>{{ $vendor }}</option>
                    @endforeach
                </select>
                @if($errors->has('vendors'))
                    <span class="text-danger">{{ $errors->first('vendors') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.vendor_helper') }}</span>
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
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.vendor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vendors.update", [$vendor->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.vendor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $vendor->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ranking">{{ trans('cruds.vendor.fields.ranking') }}</label>
                <input class="form-control {{ $errors->has('ranking') ? 'is-invalid' : '' }}" type="number" name="ranking" id="ranking" value="{{ old('ranking', $vendor->ranking) }}" step="1">
                @if($errors->has('ranking'))
                    <span class="text-danger">{{ $errors->first('ranking') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.ranking_helper') }}</span>
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
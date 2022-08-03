@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.engine.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.engines.update", [$engine->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.engine.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $engine->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vendors">{{ trans('cruds.engine.fields.vendor') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('vendors') ? 'is-invalid' : '' }}" name="vendors[]" id="vendors" multiple>
                    @foreach($vendors as $id => $vendor)
                        <option value="{{ $id }}" {{ (in_array($id, old('vendors', [])) || $engine->vendors->contains($id)) ? 'selected' : '' }}>{{ $vendor }}</option>
                    @endforeach
                </select>
                @if($errors->has('vendors'))
                    <span class="text-danger">{{ $errors->first('vendors') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.engine.fields.vendor_helper') }}</span>
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
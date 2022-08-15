@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.contact.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.contacts.update", [$contact->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">{{ trans('cruds.contact.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $contact->name) }}">
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contact.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="website">{{ trans('cruds.contact.fields.website') }}</label>
                    <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $contact->website) }}">
                    @if($errors->has('website'))
                        <span class="text-danger">{{ $errors->first('website') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contact.fields.website_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('cruds.contact.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $contact->email) }}">
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contact.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="phone">{{ trans('cruds.contact.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $contact->phone) }}">
                    @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contact.fields.phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="extension">Extension</label>
                    <input class="form-control {{ $errors->has('extension') ? 'is-invalid' : '' }}" type="text" name="extension" id="extension" value="{{ old('extension', $contact->extension) }}">
                    @if($errors->has('extension'))
                        <span class="text-danger">{{ $errors->first('extension') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="address">{{ trans('cruds.contact.fields.address') }}</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $contact->address) }}">
                    @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contact.fields.address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="city">{{ trans('cruds.contact.fields.city') }}</label>
                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $contact->city) }}">
                    @if($errors->has('city'))
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contact.fields.city_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="state">{{ trans('cruds.contact.fields.state') }}</label>
                    <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $contact->state) }}">
                    @if($errors->has('state'))
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contact.fields.state_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="zipcode">{{ trans('cruds.contact.fields.zipcode') }}</label>
                    <input class="form-control {{ $errors->has('zipcode') ? 'is-invalid' : '' }}" type="text" name="zipcode" id="zipcode" value="{{ old('zipcode', $contact->zipcode) }}">
                    @if($errors->has('zipcode'))
                        <span class="text-danger">{{ $errors->first('zipcode') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contact.fields.zipcode_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="vendor_id">{{ trans('cruds.contact.fields.vendor') }}</label>
                    <select class="form-control select2 {{ $errors->has('vendor') ? 'is-invalid' : '' }}" name="vendor_id" id="vendor_id">
                        @foreach($vendors as $id => $entry)
                            <option value="{{ $id }}" {{ (old('vendor_id') ? old('vendor_id') : $contact->vendor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('vendor'))
                        <span class="text-danger">{{ $errors->first('vendor') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contact.fields.vendor_helper') }}</span>
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

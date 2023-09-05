@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="col-12">
                <!-- Start of Row -->
                <div class="row">
                    <div class="container">
                        <!-- Start of Inner Row -->
                        <div class="row">
                            <!-- Add Vendor Section -->
                            <div class="col-sm">
                                <p>
                                    <a class="popup-form btn btn-primary" href="#addVendor" style="width: 200px;">Add Vendor</a>
                                </p>
                            </div>

                            <!-- Form for Filters -->
                            <form action="{{ route('admin.mainfilter.getVendors') }}" method="POST">
                                <!-- Engine / Make Filter -->
                                <div class="col-sm">
                                    <h6>Engine / Make</h6>
                                    <select class="form-control select2" name="engine_id">
                                        <option value="0"></option>
                                        @forelse($edatas as $edata)
                                            <option value="{{ $edata->id }}">{{ $edata->name }}</option>
                                        @empty
                                            <option value="">No options available</option>
                                        @endforelse
                                    </select>
                                </div>

                                <!-- Major Group Filter -->
                                <div class="col-sm">
                                    <h6>Major Group</h6>
                                    <select class="form-control select2" name="major_group">
                                        <option value="0"></option>
                                        <option value="1">Engine Parts</option>
                                        <!-- ... other options ... -->
                                    </select>
                                </div>

                                <!-- Product Search Filter -->
                                <div class="col-sm">
                                    <h6>Product Search</h6>
                                    <select class="form-control select2" name="product_id">
                                        <option value="0"></option>
                                        @forelse($pdatas1 as $pdata)
                                            <option value="{{ $pdata->id }}">{{ $pdata->name }}</option>
                                        @empty
                                            <option value="">No options available</option>
                                        @endforelse
                                    </select>
                                </div>

                                <!-- Misc. Product Search Filter -->
                                <div class="col-sm">
                                    <h6>Misc. Product Search</h6>
                                    <select class="form-control select2" name="product_misc_id">
                                        <option value="0"></option>
                                        @forelse ($pdatas6 as $pdata)
                                            <option value="{{ $pdata->id }}">{{ $pdata->name }}</option>
                                        @empty
                                            <option value="">No options available</option>
                                        @endforelse
                                    </select>
                                </div>

                                <!-- Services Search Filter -->
                                <div class="col-sm">
                                    <h6>Services Search</h6>
                                    <select class="form-control select2" name="service_id">
                                        <option value="0"></option>
                                        @forelse($sdatas as $sdata)
                                            <option value="{{ $sdata->id }}">{{ $sdata->name }}</option>
                                        @empty
                                            <option value="">No options available</option>
                                        @endforelse
                                    </select>
                                </div>

                                <!-- Brand Search Filter -->
                                <div class="col-sm">
                                    <h6>Brand Search</h6>
                                    <select class="form-control select2" name="brand_id">
                                        <option value="0"></option>
                                        @forelse($bdatas as $bdata)
                                            <option value="{{ $bdata->id }}">{{ $bdata->name }}</option>
                                        @empty
                                            <option value="">No options available</option>
                                        @endforelse
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-sm">
                                    <p>
                                        <button type="submit" class="btn btn-primary">LookUp</button>
                                        <a class="btn btn-primary" href="{{route('admin.mainfilter.index')}}">Clear Search</a>
                                    </p>
                                </div>
                            </form>  <!-- End of Form -->

                        </div>  <!-- End of Inner Row -->
                    </div>
                </div>  <!-- End of Row -->
            </div>
        </div>
    </div>
</div>

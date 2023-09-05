<div class="card mfp-hide mfp-popup-form mx-auto"  id="addVendor">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Add New Vendor</h2>
                            </div>

                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.vendors.store') }}" method="POST" class="was-validated">


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Vendor Name:</strong>
                                    <input type="text" name="name" class="form-control" required  placeholder="Vendor Name">
                                    <div class="invalid-feedback">Vendor Name Required</div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Ranking:</strong>
                                    <select class="form-select" name="ranking" required  aria-label="select example">
                                        <option value="">Select Ranking</option>
                                        <option value="1">Preffered</option>
                                        <option value="2">Alternative</option>
                                        <option value="3">Dealer</option>
                                        <option value="4">Misc</option>
                                    </select>
                                    <div class="invalid-feedback">Must Select Ranking</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Contact Name:</strong>

                                        <input type="text" class="form-control" id="validationCustom01" name="cname" placeholder="Name" required />
                                        <div class="invalid-feedback">Name Required</div>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Website:</strong>
                                        <input type="text" name="website" class="form-control" placeholder="Website">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        <input type="text" name="email" class="form-control" placeholder="email">

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Phone:</strong>
                                        <input type="text" name="phone" class="form-control" placeholder="phone" required>
                                        <div class="invalid-feedback">phone Required</div>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Extension:</strong>
                                        <input type="text" name="extension" class="form-control" placeholder="Extension">
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Address:</strong>
                                        <input type="text" name="address" class="form-control" placeholder="address">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>City:</strong>
                                        <input type="text" name="city" class="form-control" placeholder="city">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>State:</strong>
                                        <input type="text" name="state" class="form-control" placeholder="state">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Zip code:</strong>
                                        <input type="text" name="zipcode" class="form-control" placeholder="zipcode">
                                    </div>
                                </div>
{{--                                <input type="hidden" name="vendor_id" value="{{$vendor->id}}">--}}
{{--                                <input type="hidden" name="vendor_page" value="1">--}}


                            </div>
                        </div>

                        <input type="hidden" name="mpage" value="1"/>
                        @csrf
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> </form>
                </div>



                </div>
            </div>
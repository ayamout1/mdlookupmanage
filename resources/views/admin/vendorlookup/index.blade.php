@extends('admin.admin_master')
@section('admin')


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">


                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">MDD</a></li>
                                <li class="breadcrumb-item active">Dashboard </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->





                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
            <div class="row">
            <div class="card">
                <div class="card-body">
                <div class="col-12">

                    <div class="row">
                        <div class="container">
                            <div class="row"><div class="col-sm">
<p>
                                <a class="popup-form btn btn-primary" href="#addVendor" style="width: 200px;">Add Vendor</a></p></div>
                                <div class="col-sm">
                                    <h6>Engine / Make</h6>
                                        <form action="{{ route('admin.mainfilter.getVendors') }}" method="POST">
                                            <select class="form-control select2" name="engine_id" aria-label="Default select example">
                                                <option value="0"></option>
                                                @foreach($edatas as $edata)
                                                    <option value="{{$edata->id}}">{{$edata->name}}</option>
                                                @endforeach
                                            </select>
                                </div>
                                <div class="col-sm">
                                    <h6>Major Group</h6>
                                    <select class="form-control select2"  name="major_group" >

                                        <option value="0" style="display: none; !important"></option>

                                            <option value="1">Engine Parts</option>
                                            <option value="2">Turbo Chargers</option>
                                            <option value="3">Fuel Injection</option>
                                            <option value="4">Filtration</option>
                                            <option value="5">Services</option>
                                            <option value="6">Miscellaneous</option>

                                    </select>
                                </div>
                                <style>

                                    .select2-container .select2-results__group{
                                    font-weight: 2000;
                                    background-color: yellow;}
                                </style>
                                <div class="col-sm" >
                                    <h6>Product Search</h6>
                                    <select class="form-control select2" name="product_id">

                                        <option value="0"></option>
                                        <optgroup label="Engine">
                                        @foreach($pdatas1 as $pdata)

                                            <option value="{{$pdata->id}}">{{$pdata->name}}</option>
                                        @endforeach
                                        </optgroup>
                                        <optgroup label="Turbo Chargers">
                                        @foreach($pdatas2 as $pdata)

                                            <option value="{{$pdata->id}}">{{$pdata->name}}</option>
                                        @endforeach
                                        </optgroup>
                                            <optgroup label="Fuel Injection">
                                        @foreach($pdatas3 as $pdata)

                                            <option value="{{$pdata->id}}">{{$pdata->name}}</option>
                                        @endforeach
                                            </optgroup>
                                            <optgroup label="Filtration">
                                        @foreach($pdatas4 as $pdata)

                                            <option value="{{$pdata->id}}">{{$pdata->name}}</option>
                                        @endforeach
                                            </optgroup>
                                            <optgroup label="Services">
                                        @foreach($pdatas5 as $pdata)

                                            <option value="{{$pdata->id}}">{{$pdata->name}}</option>
                                        @endforeach
                                            </optgroup>

                                    </select>
                                </div>
                                <div class="col-sm">
                                    <h6>Misc. Product Search</h6>
                                    <select class="form-control select2" name="product_misc_id" >

                                        <option value="0"></option>
                                        @foreach($pdatas6 as $pdata)
                                            <option value="{{$pdata->id}}">{{$pdata->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm">
                                   <h6> Services Search</h6>
                                    <select class="form-control select2" name="service_id" aria-label="Default select example">
                                        <option value="0"></option>
                                        @foreach($sdatas as $sdata)
                                            <option value="{{$sdata->id}}">{{$sdata->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <h6>Brand Search</h6>
                                    <select class="form-control select2" name="brand_id" aria-label="Default select example">
                                        <option value="0"></option>
                                        @foreach($bdatas as $bdata)
                                            <option value="{{$bdata->id}}">{{$bdata->name}}</option>
                                        @endforeach
                                    </select>@csrf
                                </div>

                                <div class="col-sm">
                                    <p><button type="submit" class="btn btn-primary">LookUp</button>  <a class="btn btn-primary" href="{{route('admin.mainfilter.index')}}"> Clear Search</a> </p>
                                    </div></form>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
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



                <div class="card">
                    <div class="card-body" >
                        <h1 style="margin-left:85%">Vendor Search</h1>
                        <div class="table-responsive" >
                        <table id="table" class="table table-striped table-bordered nowrap display">
                                <thead>
                                <tr>
                                    <th>Ranking</th>
                                    <th>Vendor (Click Vendor for details)</th>
                                    <th>Phone</th>
                                    <th>Extension</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Website</th>



                                </tr>
                                </thead>

                                <tbody>

                                <tr>


                                    @foreach($vendors as $ven)
                                        @foreach($ven->vendorContacts as $cname)
                                            @if ($loop->first)
                                                @if($ven->ranking == 1)
                                                    <td><span style="display: none">{{$ven->ranking}}</span>Preferred</td>
                                                @elseif($ven->ranking == 2)
                                                    <td><span style="display: none">{{$ven->ranking}}</span>Alternative</td>
                                                @elseif($ven->ranking == 3)
                                                    <td><span style="display: none">{{$ven->ranking}}</span>Dealer</td>
                                                @else($vendor->ranking == 4)
                                                    <td><span style="display: none">{{$ven->ranking}}</span>Miscellaneous</td>
                                                @endif

                                                <td><a class="" href="{{ route('admin.vendors.show',$ven->id) }}"  onMouseOver="this.style.color='red'" onMouseOut="this.style.color='blue'">{{ $ven->name }}</a></td>


                                                <td><a href="tel:{{ $cname->phone  ?? 'no contact'}}"onMouseOver="this.style.color='red'" onMouseOut="this.style.color='blue'">{{ $cname->phone  ?? 'no contact'}}</a></td>
                                                <td>{{$cname->extension}}</td>

                                                <td>{{ $cname->name  ?? 'no contact'}}</td>

                                                <td><a href="mailto:{{ $cname->email  ?? 'no contact'}}" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='blue'">{{ $cname->email  ?? 'no contact'}}</a></td>

                                                @if (str_contains($cname->website,'http' ))
                                                    <td><a href="{{$cname->website  ?? 'no contact'}}" target="_blank"onMouseOver="this.style.color='red'" onMouseOut="this.style.color='blue'">{{ $cname->website  ?? 'no contact'}}</a></td>
@else
                                                        <td><a href="http://{{$cname->website  ?? 'no contact'}}" target="_blank"onMouseOver="this.style.color='red'" onMouseOut="this.style.color='blue'">{{ $cname->website  ?? 'no contact'}}</a></td>
                                            @endif
@endif






                                </tr>


                                @endforeach
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>



@endsection

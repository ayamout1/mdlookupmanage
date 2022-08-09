@extends('admin.admin_master')
@section('admin')


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">MDD</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                <p> You are looking for |
                    @forelse($input3 as $inpu)
                        {{$inpu->name}} |
                    @empty

                    @endforelse
                    @forelse($input2 as $inpu)
                        {{$inpu->name}} |
                    @empty

                    @endforelse
                    @forelse($input1 as $inpu)
                        {{$inpu->name}} |
                    @empty

                    @endforelse
                    @forelse($input as $inpu)
                        {{ $inpu->name }} |

                    @empty

                    @endforelse
                    @forelse($input4 as $inpu)
                        {{ $inpu->name }} |

                    @empty

                    @endforelse
                    @forelse($input5 as $inpu)
                        {{ $inpu->name }} |

                    @empty

                    @endforelse




                </p>Your Search Criteria | @if($s12 == '1')
                                                            Product, Services, Brand, and Engine
                            @elseif($s12 == '2')
                                                            Services, Brand, Engine
                            @elseif($s12 == '3')
                                                       Engine, Services
                            @elseif($s12 == '4')
                                                        Brand, Engine
                            @elseif($s12 == '5')
                                                        Product, Brand
                            @elseif($s12 == '6')
                                                        Product, Engine
                            @elseif($s12 == '7')
                                                        Product, Service, Brand
                            @elseif($s12 == '8')
                                                        Product, Service
                            @elseif($s12 == '9')
                                                            Product
                            @elseif($s12 == '10')
                                                        Service
                            @elseif($s12 == '11')
                                                            Brand
                            @elseif($s12 == '12')
                                                        Engine
                            @elseif($s12 == '13')
                                                        Not Set
                            @elseif($s12 == '15')
                                                    Major Group
                            @elseif($s12 == '16')
                                                    Product Miscellaneous
                            @else None
                            @endif



                            <p><a class="btn btn-primary" href="{{route('admin.mainfilter.index')}}"> Clear Search</a></p>
{{--                            <p>  <a class="popup-form btn btn-primary" href="#addVendor" style="width: 200px;">Add Vendor</a></p>--}}


                        </div></div></div></div>

            <div class="card mfp-hide mfp-popup-form mx-auto"  id="addVendor">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Add New Vendor</h2>
                            </div>

                        </div>
                    </div>--}}

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
                                    <strong>Name:</strong>
                                    <input type="text" name="name" class="form-control" required  placeholder="Name">
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
                            </div>

                            <input type="hidden" name="mpage" value="1"/>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>@csrf </form>
                            </div>
                        </div>



                </div>
            </div>


                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="table-responsive" >
                                                <table id="table" class="table table-striped table-bordered nowrap display">
                                                    <thead>
                                                    <tr>
                                                        <th>Ranking</th>
                                                        <th>Vendor (Click Vendor for details)</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Website</th>


                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr>
                                                        @foreach($vendors as $vendor)
                                                            @foreach($vendor->vendorContacts as $cname)
                                                                @if ($loop->first)
                                                                    @if($vendor->ranking == 1)
                                                                        <td><span style="display: none">{{$vendor->ranking}}</span>Preferred</td>
                                                                    @elseif($vendor->ranking == 2)
                                                                        <td><span style="display: none">{{$vendor->ranking}}</span>Alternative</td>
                                                                    @elseif($vendor->ranking == 3)
                                                                        <td><span style="display: none">{{$vendor->ranking}}</span>Dealer</td>
                                                                    @else($vendor->ranking == 4)
                                                                        <td><span style="display: none">{{$vendor->ranking}}</span>Miscellaneous</td>
                                                                    @endif
                                                                    <td><a href="{{ route('admin.vendors.show',$vendor->id) }}">{{ $vendor->name }}</a></td>




                                                                    <td>{{ $cname->name  ?? 'no contact'}}</td>
                                                                        <td><a href="tel:{{ $cname->phone  ?? 'no contact'}}">{{ $cname->phone  ?? 'no contact'}}</a></td>
                                                                <td><a href="mailto:{{ $cname->email  ?? 'no contact'}}">{{ $cname->email  ?? 'no contact'}}</a></td>

                                                                        <td><a href="{{ $cname->website  ?? 'no contact'}}" target="_blank">{{ $cname->website  ?? 'no contact'}}</a></td>





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
                                </div>



                <!-- end col -->

                <!-- end row -->
            </div>

        </div>

    <!-- End Page-content -->
    @endsection

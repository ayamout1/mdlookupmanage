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



            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg">

                                            <h1>{{ $vendor->name }}</h1>
                                            <ul>

                                            @if($vendor->ranking == 1)
                                                <li>Preferred</li>
                                            @elseif($vendor->ranking == 2)
                                                <li>Alternative</li>
                                            @elseif($vendor->ranking == 3)
                                                <li>Dealer</li>
                                            @else($vendor->ranking == 4)
                                                <li>Miscellaneous</li>
                                            @endif
                                            @foreach($cdatas as $cdata)
                                            @if(isset($cdata->website))


                                                        @if (str_contains($cdata->website,'http' ))
                                                            <td><a href="{{$cdata->website}}" target="_blank">{{ $cdata->website}}</a></td>
                                                        @else
                                                            <td><a href="http://{{$cdata->website}}" target="_blank">{{ $cdata->website}}</a></td>
                                                        @endif
                                            @endif
                                            @endforeach



                                                </ul>
                                                </ul>



                                        </div>
                                        <div class="col-lg">
                                            <button class="btn btn-primary show-page modal-btne" data-page="edit" id="edit" href="#editmode">Edit</button>
                                            <button class="btn btn-primary show-page modal-btns" data-page="save" id="save" href="#savemode">Save</button>

                                        </div>

                                    </div></div>
                                                </div>

                                            </div>

                                    </div>
                                </div> <!-- end col -->


{{--contact and vendor info row--}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist" id="myTab">
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#home" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Contact Info</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#locations" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Locations</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#notes" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">PDF's</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#note" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Notes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#warranty" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Warranty</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#preludenumber" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Prelude Number</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#vendornumber" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Vendor Number</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane" id="home" role="tabpanel">


                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">

                                            <thead>
                                            <tr>
                                                <th>Contact Name</th>
                                                <th>Location</th>
                                                <th>Phone</th>
                                                <th>Ext</th>
                                                <th>Email</th>
{{--                                                <th>Website</th>--}}
                                                <th class="khara d-none">Edit Contact</th>
                                                @can('delete')  <th class="khara d-none">Delete Contact</th>@endcan
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cdatas as $cdata)
                                                <tr>
                                                    <td>{{ $cdata->name  ?? 'no name on file'}}</td>
                                                    <td>{{ $cdata->city  ?? 'no city on file'}}</td>
                                                    <td><a href="tel{{ $cdata->phone  ?? 'no contact'}}">{{ $cdata->phone  ?? 'no phone number on file'}}</a></td>
                                                    <td>{{ $cdata->extension  ?? 'no Extension on file'}}</td>
                                                    <td><a href="mailto: {{ $cdata->email}} ">{{ $cdata->email  ?? 'no email on file'}}</a></td>
{{--                                                    <td><a href="{{ $cdata->website}}">{{ $cdata->website ?? 'no website on file'}}</a></td>--}}
{{--                                                    <td class="khara d-none">  <a class="popup-form btn btn-primary" href="{{ route('admin.contacts.edit',$cdata->id) }} ">Edit Contact</a></td>--}}
                                                    <form action="{{ route('admin.contacts.edit',$cdata->id) }}" id="editcontact" method="GET">

                                                        <td class="khara d-none">@csrf

                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                           <button type="submit" class="btn btn-danger">Edit Contact</button>
                                                        </td></form>
{{--                                                    <form action="{{ route('admin.contacts.destroy',$cdata->id) }}" id="contactdelete" method="POST">--}}

{{--                                                        <td class="khara d-none">@csrf--}}
{{--                                                            @method('DELETE')--}}
{{--                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">--}}
{{--                                                            <input type="hidden" name="vendor_page" value="1">--}}
{{--                                                            @can('delete')  <button type="submit" class="btn btn-danger">Delete Contact</button>@endcan--}}
{{--                                                        </td></form>--}}
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <div class="contactadd d-none" id="contact-form">
                                            <div class="card-body">
                                                <h4 class="mb-4">Add Contact</h4>
                                                <form action="{{ route('admin.contacts.store') }}" name="contactForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>Name:</strong>

                                                                <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Name" required />
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
                                                                <div class="invalid-feedback">Name Required</div>
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
                                                        <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                        <input type="hidden" name="vendor_page" value="1">

                                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                                                            </button>
                                                        </div>
                                                    </div>

                                                </form></div></div>

                                    </div>
                                    <div class="khara d-none"><a class="btn btn-primary" href="#contact-form" onclick="contactadd()" id="contactadd">Add Contact</a></div>

</div>
                                <div class="tab-pane" id="locations" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">

                                            <thead>
                                            <tr>


                                                <th>City</th>
                                                <th>Address</th>
                                                <th class="khara d-none">Edit</th>
                                                <th class="khara d-none">Delete</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($addresses as $address)
                                                <tr>
                                                    <td >{{ $address->city ?? 'no name on file'}}</td>

                                                    <td >    <a href="http://maps.google.com/?q={{ $address->address.', '.$address->city.', '.$address->state.', '.$address->zipcode  ?? 'no contact'}}" target="_blank">{{ $address->address.', '.$address->city.', '.$address->state.',  '.$address->zipcode  ?? 'no contact'}}</a></td>
                                                    <form id="addressedit" action="{{ route('admin.addresses.edit',$address->id) }}" method="GET">
                                                        <td class="khara d-none">@csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </td></form>
                                                    <form id="addressdelete" action="{{ route('admin.addresses.destroy',$address->id) }}" method="POST">
                                                        <td class="khara d-none">@csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </td></form>

                                                </tr>
                                            @endforeach
                                            @foreach($cdatas as $cdata)
                                                <tr>
                                                    <td>{{$cdata->city}}</td>
{{--                                                    <td>{{ $cdata->name  ?? 'no name on file'}}</td>--}}
{{--                                                    <td><a href="tel{{ $cdata->phone  ?? 'no contact'}}">{{ $cdata->phone  ?? 'no phone number on file'}}</a></td>--}}
{{--                                                    <td><a href="mailto: {{ $cdata->email}} ">{{ $cdata->email  ?? 'no email on file'}}</a></td>--}}
                                                    <td><a href="http://maps.google.com/?q={{ $cdata->address.', '.$cdata->city.', '.$cdata->state.', '.$cdata->zipcode  ?? 'no address on file'}}" target="_blank">{{ $cdata->address.', '.$cdata->city.', '.$cdata->state.',  '.$cdata->zipcode  ?? 'no address onn file'}}</a></td>
{{--                                                                                                        <td><a href="{{ $cdata->website}}">{{ $cdata->website ?? 'no website on file'}}</a></td>--}}
{{--                                                                                                        <td class="khara d-none">  <a class="popup-form btn btn-primary" href="{{ route('admin.contacts.edit',$cdata->id) }} ">Edit Contact</a></td>--}}
                                                    <form action="{{ route('admin.contacts.edit',$cdata->id) }}" id="editcontact" method="GET">

                                                        <td class="khara d-none">@csrf

                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            <button type="submit" class="btn btn-danger">Edit Contact</button>
                                                        </td></form>
                                                    <form action="{{ route('admin.contacts.destroy',$cdata->id) }}" id="contactdelete" method="POST">

                                                        <td class="khara d-none">@csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            @can('delete')  <button type="submit" class="btn btn-danger">Delete Contact</button>@endcan
                                                        </td></form>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
       <div class="khara d-none"> <button class="btn btn-primary" onclick="locationadd()" id="addloc">Add Location</button></div>
                                        {{--        <div class="card mfp-hide mfp-popup-form mx-auto" id="address-form">--}}
                                        <div class="addloc d-none">
                                            <div class="card-body">
                                                <h4 class="mb-4">Add Address</h4>
                                                <form id="addressForm" action="{{route('admin.addresses.ajaxstore')}}"  name="addressForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row">

                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>Contact Name:</strong>
                                                                <input type="text" name="contact" id="contact" class="form-control" placeholder="Contact">


                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>Phone:</strong>
                                                                <input type="text" name="phone" id="phone" class="form-control" placeholder="phone">


                                                            </div>
                                                        </div>                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>Email:</strong>
                                                                <input type="text" name="email" id="email" class="form-control" placeholder="email">


                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>Address:</strong>
                                                                <input type="text" name="address" id="address" class="form-control" placeholder="address" required>
                                                                <div class="invalid-feedback">Address Required</div>
                                                                <div class="valid-feedback">Looks good!</div>

                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>City:</strong>
                                                                <input type="text" name="city" id="city" class="form-control" placeholder="city" required>
                                                                <div class="invalid-feedback">City Required</div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>State:</strong>
                                                                <input type="text" name="state" id="state" class="form-control" placeholder="state" required>
                                                                <div class="invalid-feedback">State Required</div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>Zip code:</strong>
                                                                <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="zipcode" required>
                                                                <div class="invalid-feedback">Zipcode Required</div>
                                                                <div class="valid-feedback">Looks good!</div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="vendor_id" id="vendor_id" value="{{$vendor->id}}">
                                                        <input type="hidden" name="vendor_page" value="1">

                                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                                                            </button>
                                                        </div>
                                                    </div>

                                                </form></div></div>

                                    </div></div>


                                <div class="tab-pane" id="notes" role="tabpanel">

                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">

                                            <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>
                                                    {{ trans('cruds.note.fields.file') }}
                                                </th>

                                                <th class="khara d-none">Edit</th>
                                                <th class="khara d-none">Delete</th>

                                            </tr>
                                            </thead>
                                        <tbody>
                                        @foreach($pdfs as $pdf)
                                                <tr>
                                                <td>{{$pdf->note}}</td>
                                                    <td>
                                                        @foreach($pdf->media as $mediafile)
                                                            <a href="{{ $mediafile->getUrl() }}" target="_blank">
                                                                Download
                                                            </a>
                                                        @endforeach
                                                    </td>
                                                    <form action="{{ route('admin.notes.edit',$pdf->id) }}" method="GET">

                                                        <td class="khara d-none">@csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="note_page" value="2">
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </td></form>
                                                    <form action="{{ route('admin.notes.destroy',$pdf->id) }}" method="POST">

                                                        <td class="khara d-none">@csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </td></form>

                                                </tr>
                                        @endforeach
                                        </tbody>
                                        </table>
                                     <p class="khara d-none"><a class="popup-form btn btn-primary" href="#notes-form">Add Attachment</a></p>

                                </div>
                                </div>
                                <div class="tab-pane" id="note" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">

                                            <thead>
                                            <tr>
                                                <th>Notes</th>
                                                <th class="khara d-none">Edit</th>
                                                <th class="khara d-none">Delete</th>

                                            </tr>
                                            </thead>
                                            <tbody>



                                            @foreach($notes->sortBy('ranking') as $note)

                                                <tr>
                                                    <td>
                                                        {{$note->title}}
                                                    </td>
                                                    <form action="{{ route('admin.notes.edit',$note->id) }}" method="GET">
                                                        <td class="khara d-none">@csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="note_page" value="1">
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </td></form>
                                                    <form action="{{ route('admin.notes.destroy',$note->id) }}" method="POST">
                                                        <td class="khara d-none">@csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </td></form>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                    </div>


                                    <p class="khara d-none">  <a class="popup-form btn btn-primary" href="#addnote">Add Note</a></p>

                                </div>
                                <div class="tab-pane" id="warranty" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">

                                            <thead>
                                            <tr>
                                                <th>Warranty Info</th>
                                                <th>Download</th>
                                                <th class="khara d-none">Edit</th>
                                                <th class="khara d-none">Delete</th>

                                            </tr>
                                            </thead>
                                            <tbody>



                                            @foreach($warranties as $warranty)
                                                <tr>
                                                    <td>
                                                        {{$warranty->warranty}}
                                                    </td>
                                                    <td> @foreach($warranty->media as $mediafile)
                                                        <a href="{{ $mediafile->getUrl() }}" target="_blank">
                                                            Download
                                                        </a>
                                                    @endforeach</td>
                                                    <form action="{{ route('admin.warranties.edit',$warranty->id) }}" method="Gets">
                                                        <td class="khara d-none">@csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </td></form>
                                                    <form action="{{ route('admin.warranties.destroy',$warranty->id) }}" method="POST">
                                                        <td class="khara d-none">@csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </td></form>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="khara d-none">  <a class="popup-form btn btn-primary" href="#warranty-form">Add Warranty info</a></p>

                                </div>
                                <div class="tab-pane active" id="preludenumber" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">

                                            <thead>
                                            <tr>
                                                <th>Prelude</th>
                                                <th class="khara d-none">Edit</th>
                                                <th class="khara d-none">Delete</th>

                                            </tr>
                                            </thead>
                                            <tbody>



                                            @foreach($preludenumbers as $preludenumber)
                                                <tr>
                                                <td>
                                                    {{$preludenumber->number}}
                                                </td>
                                                    <form action="{{ route('admin.prelude-numbers.edit',$preludenumber->id) }}" method="GET">
                                                        <td class="khara d-none">@csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            <button type="submit" class="btn btn-primary">Edit</button>
                                                        </td></form>
                                                    <form action="{{ route('admin.prelude-numbers.destroy',$preludenumber->id) }}" method="POST">
                                                        <td class="khara d-none">@csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="vendor_page" value="1">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </td></form>
                                            </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="khara d-none">  <a class="popup-form btn btn-primary" href="#preludenumber-form">Add Prelude Number</a></p>

                                </div>
                                <div class="tab-pane" id="vendornumber" role="tabpanel">

                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">

                                            <thead>
                                            <tr>
                                                <th>Vendor Number</th>
                                                <th class="khara d-none">Edit</th>
                                                <th class="khara d-none">Delete</th>

                                            </tr>
                                            </thead>
                                            <tbody>



                                        @foreach($vendornumbers as $vendornumber)
                                        <tr>
                                            <td>{{$vendornumber->number}}</td>

                                            <form action="{{ route('admin.vendor-numbers.edit',$vendornumber->id) }}" method="GET">
                                                <td>@csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                    <input type="hidden" name="vendor_page" value="1">
                                                    <button type="submit" class="btn btn-primary khara d-none">Edit</button>
                                                </td></form>
                                            <form action="{{ route('admin.vendor-numbers.destroy',$vendornumber->id) }}" method="POST">
                                                <td>@csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                    <input type="hidden" name="vendor_page" value="1">
                                                    <button type="submit" class="btn btn-danger khara d-none" >Delete</button>
                                                </td></form>
                                        </tr>
                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="khara d-none"><a class="popup-form btn btn-primary" href="#vendornumber-form">Add Vendor Number</a></p>

                                </div>
                            </div>


                        </div>



                </div>
                </div>
            </div>
            {{--END contact and vendor info row--}}
             <!-- end col -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            <ul class="nav nav-tabs" role="tablist" id="myTab1">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#engines" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Engines</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#products" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Products</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#brands" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Brands</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#services" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Services</span>
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="engines" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">

                                            <thead>

                                            <tr>

                                                <th><h4 class="card-title">Engines</h4></th>
                                                <th class="khara d-none"><h4 class="card-title">Delete From Vendor</h4></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($edatas as $edata)
                                                <tr>

                                                    <td> {{$edata->name}} </td>
                                                    <td> <form method="POST">



                                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                            <input type="hidden" name="engine_id" value="{{$edata->id}}">

                                                            @csrf


                                                            {{--                                                    <button type="submit" class="btn btn-primary"  formaction="{{ route('products.assign.la') }}">Submit</button>--}}
                                                            <div class="khara d-none"> <button type="submit" class="btn btn-primary" formaction="{{ route('admin.vendors.s.assign.de') }}">Deactivate</button></div>

                                                        </form></td>
                                                </tr>
                                            @endforeach
                                            <form method="POST">
                                                <input type="hidden" name="vendor_id" value="{{$vendor->id}}">

                                                <tr>
                                                    <td class="khara d-none"><select class="form-select" name="engine_id" aria-label="Default select example">
                                                            <option selected="">ADD Engine</option>

                                                            @foreach($edatas1 as $edata)

                                                                <option value="{{$edata->id}}">{{$edata->name}}</option>

                                                            @endforeach
                                                        </select>
                                                    </td>



                                                    @csrf


                                                    <td class="khara d-none"> <button type="submit" class="btn btn-primary"  formaction="{{ route('admin.vendors.s.assign.la') }}">Add Engine</button></td>
                                                    {{--                                                    <button type="submit" class="btn btn-primary" formaction="{{ route('products.assign.de') }}">Deactivate</button>--}}
                                                </tr>
                                            </form>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="tab-pane" id="products" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">

                                    <thead>

                                    <tr>

                                        <th><h4 class="card-title">Products</h4></th>
                                        <th class="khara d-none"><h4 class="card-title">Delete From Vendor</h4></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($pdatas as $pdata)
                                        <tr>

                                            <td> {{$pdata->name}} </td>

                                            <td class="khara d-none"> <form method="POST">



                                                    <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                    <input type="hidden" name="product_id" value="{{$pdata->id}}">

                                                    @csrf



                                                    <button type="submit" class="btn btn-primary" formaction="{{ route('admin.vendors.s.assign.de') }}">Deactivate</button>

                                                </form></td>
                                        </tr>
                                    @endforeach

                                        <td class="khara d-none">                            <form method="POST">
                                                <input type="hidden" name="vendor_id" value="{{$vendor->id}}">

                                                <select class="form-select" name="product_id" aria-label="Default select example">
                                                    <option selected="">Add Product</option>

                                                    @foreach($pdatas1 as $pdata)

                                                        <option value="{{$pdata->id}}">{{$pdata->name}}</option>

                                                    @endforeach
                                                </select>



                                                @csrf

                                        </td>
                                    <td class="khara d-none">    <button type="submit" class="btn btn-primary"  formaction="{{ route('admin.vendors.s.assign.la') }}">Add</button>
                                                {{--                                                    <button type="submit" class="btn btn-primary" formaction="{{ route('products.assign.de') }}">Deactivate</button>--}}
                                    </td>
                                            </form>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                                </div>




                            <div class="tab-pane" id="brands" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">

                                        <thead>

                                        <tr>

                                            <th><h4 class="card-title">Brands</h4></th>
                                            <th class="khara d-none"><h4 class="card-title">Delete Brand From Vendor</h4></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bdatas as $bdata)
                                            <tr>

                                                <td> {{$bdata->name}} </td>
                                                <td class="khara d-none"> <form method="POST">



                                                        <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                        <input type="hidden" name="brand_id" value="{{$bdata->id}}">

                                                        @csrf


                                                        {{--                                                    <button type="submit" class="btn btn-primary"  formaction="{{ route('products.assign.la') }}">Submit</button>--}}
                                                        <button type="submit" class="btn btn-primary" formaction="{{ route('admin.vendors.s.assign.de') }}">Deactivate</button>

                                                    </form></td>
                                            </tr>
                                        @endforeach
                                        <form method="POST">
                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                            <tr>
                                            <td class="khara d-none"><select class="form-select" name="brand_id" aria-label="Default select example">
                                                <option selected="">Add Brand</option>

                                                @foreach($bdatas1 as $bdata)

                                                    <option value="{{$bdata->id}}">{{$bdata->name}}</option>

                                                @endforeach
                                            </select>
                                            </td>


                                            @csrf


                                            <td class="khara d-none"><button type="submit" class="btn btn-primary"  formaction="{{ route('admin.vendors.s.assign.la') }}">Add</button></td>
                                            {{--                                                    <button type="submit" class="btn btn-primary" formaction="{{ route('products.assign.de') }}">Deactivate</button>--}}

                                        </form></tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane" id="services" role="tabpanel">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">

                                        <thead>

                                        <tr>

                                            <th><h4 class="card-title">Services</h4></th>
                                            <th class="khara d-none"><h4 class="card-title">Remove</h4></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sdatas as $sdata)
                                            <tr>

                                                <td> {{$sdata->name}} </td>
                                                <td class="khara d-none"> <form method="POST">



                                                        <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                                                        <input type="hidden" name="service_id" value="{{$sdata->id}}">

                                                        @csrf


                                                        {{--                                                    <button type="submit" class="btn btn-primary"  formaction="{{ route('products.assign.la') }}">Submit</button>--}}
                                                        <button type="submit" class="btn btn-primary" formaction="{{ route('admin.vendors.s.assign.de') }}">Deactivate</button>

                                                    </form></td>
                                            </tr>
                                        @endforeach
                                        <form method="POST">
                                            <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
<tr>
                                       <td class="khara d-none">     <select class="form-select" name="service_id" aria-label="Default select example">
                                                <option selected="">Select Service</option>

                                                @foreach($sdatas1 as $sdata)

                                                    <option value="{{$sdata->id}}">{{$sdata->name}}</option>

                                                @endforeach
                                            </select></td>




                                            @csrf


                                           <td class="khara d-none"> <button type="submit" class="btn btn-primary"  formaction="{{ route('admin.vendors.s.assign.la') }}">Add</button></td>
                                            {{--                                                    <button type="submit" class="btn btn-primary" formaction="{{ route('products.assign.de') }}">Deactivate</button>--}}

                                        </form>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--closing 2nd row--}}
            </div>

        </div>
    </div>

{{--    form section--}}



    <div class="card mfp-hide mfp-popup-form mx-auto" id="warranty-form">
        <div class="card-body">
            <form action="{{ route('admin.warranties.store') }}" method="POST"  class="was-validated">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Warranty Info:</strong>
                            <input type="text" name="warranty" class="form-control" placeholder="warranty info" required>
                        </div>
                    </div>


                    <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                    <input type="hidden" name="vendor_page" value="1">

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form></div>

    </div>
    <div class="card mfp-hide mfp-popup-form mx-auto" id="vendornumber-form">
        <div class="card-body">

            <form action="{{ route('admin.vendor-numbers.store') }}" method="POST"  class="was-validated">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Vendor Number:</strong>
                            <input type="text" name="number" class="form-control" placeholder="Vendor Number" required>
                        </div>
                    </div>


                    <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                    <input type="hidden" name="vendor_page" value="1">

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form></div></div>
    <div class="card mfp-hide mfp-popup-form mx-auto" id="preludenumber-form">
        <div class="card-body">

            <form action="{{ route('admin.prelude-numbers.store') }}" method="POST" class="was-validated">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Prelude Number:</strong>
                            <input type="text" name="number" class="form-control" placeholder="Prelude Number" required>
                        </div>
                    </div>


                    <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                    <input type="hidden" name="vendor_page" value="1">

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form></div></div>
    <div class="card mfp-hide mfp-popup-form mx-auto" id="notes-form">


        <div class="card-body">
            <form method="POST" action="{{ route("admin.notes.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="note">Title</label>
                    <input class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="note" id="note" value="{{ old('note', '') }}">
                    @if($errors->has('note'))
                        <span class="text-danger">{{ $errors->first('note') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.note.fields.note_helper') }}</span>
                </div>
                <input type="hidden" name="vendor_id" value="{{$vendor->id}}">
                <div class="form-group">
                    <label for="file">{{ trans('cruds.note.fields.file') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }} " id="file-dropzone">
                    </div>
                    @if($errors->has('file'))
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.note.fields.file_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div></div>
    <div class="card mfp-hide mfp-popup-form mx-auto" id="addnote">


        <div class="card-body">
            <form method="POST" action="{{ route("admin.notes.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="note">Note </label>
                    <textarea class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" type="text" name="title" id="note" value="{{ old('title', '') }}" rows="5"></textarea>
                    @if($errors->has('note'))
                        <span class="text-danger">{{ $errors->first('note') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.note.fields.note_helper') }}</span>
                    <label for="ranking">Note Ranking</label>

                        <select name="ranking" class="form-control">
                            @for ($i = 1; $i < $noteranking; $i++)<option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>



                </div>
                <input type="hidden" name="vendor_id" value="{{$vendor->id}}">

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div></div>

    @section('scripts')
    <script>
        function locationadd() {

            $('.addloc').toggleClass('d-none');


        }
        function contactadd() {

            $('.contactadd').toggleClass('d-none');


        }
        $(document).ready(function(){
            $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                sessionStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = sessionStorage.getItem('activeTab');
            if(activeTab){
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
            $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                sessionStorage.setItem('activeTab1', $(e.target).attr('href'));
            });
            var activeTab1 = sessionStorage.getItem('activeTab1');
            if(activeTab1){
                $('#myTab1 a[href="' + activeTab1 + '"]').tab('show');
            }


            var editmode = localStorage.getItem('edit');

            if (editmode == 1){
                $('.khara').removeClass('d-none');
            }
            else if (editmode == 2){

                $('.khara').addClass('d-none');

            }

            $('.modal-btne').click(function() {
                $('.khara').removeClass('d-none');
                localStorage.setItem('edit',1);
            });
            $('.modal-btns').click(function() {
                $('.khara').addClass('d-none');
                localStorage.setItem('edit',2);

            });
            });







            // access Dropzone here
        var uploadedFileMap = {}
        Dropzone.options.fileDropzone = {
            url: '{{ route('admin.notes.storeMedia') }}',
            maxFilesize: 50, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
                uploadedFileMap[file.name] = response.name
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedFileMap[file.name]
                }
                $('form').find('input[name="file[]"][value="' + name + '"]').remove()
            },

            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }


            $('#addressForm').submit(function(e) {

            e.preventDefault();
                var formData = new FormData(this);
                //
                // var address = $("address").val();
                // var city = $("city").val();
                // var state = $("state").val();
                // var zipcode = $("zipcode").val();
                // var vendor_id = $("vendor_id").val();
                //
            $.ajax({


                method: 'POST',
                url:"{{ route('admin.addresses.ajaxstore') }}",
                data: formData,
                // data:{address:address, city:city, state:state, zipcode:zipcode, vendor_id:vendor_id},
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            cache:false,
            contentType: false,
            processData: false,

            error: function(data){

            console.log(data);
        }

                })
            .done(function () { location.reload()})});
        $('#addressdelete').submit(function(e) {

            e.preventDefault();

//
// var address = $("address").val();
// var city = $("city").val();
// var state = $("state").val();
// var zipcode = $("zipcode").val();
// var vendor_id = $("vendor_id").val();
//
            $.ajax({
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                method: 'POST',
                url: config.url,
                data: { id: id, _method: 'DELETE' }})

                .done(function () { location.reload() })});

        $('#contactForm').submit(function(e) {

            e.preventDefault();
                var formData = new FormData(this);
                //
                // var address = $("address").val();
                // var city = $("city").val();
                // var state = $("state").val();
                // var zipcode = $("zipcode").val();
                // var vendor_id = $("vendor_id").val();
                //
            $.ajax({


                method: 'POST',
                url:"{{ route('admin.contacts.ajaxstore') }}",
                data: formData,
                // data:{address:address, city:city, state:state, zipcode:zipcode, vendor_id:vendor_id},
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            cache:false,
            contentType: false,
            processData: false,

            error: function(data){

            console.log(data);
        }

                })
            .done(function () { location.reload()})});
        $('#contactdelete').submit(function(e) {

            e.preventDefault();

//
// var address = $("address").val();
// var city = $("city").val();
// var state = $("state").val();
// var zipcode = $("zipcode").val();
// var vendor_id = $("vendor_id").val();
//
            $.ajax({
                headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                method: 'POST',
                url: config.url,
                data: { id: id, _method: 'DELETE' }})

                .done(function () { location.reload() })});

    </script>

@endsection
@endsection


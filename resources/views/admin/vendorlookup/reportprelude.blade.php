@extends('admin.admin_master')
@section('admin')

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


                        @foreach($preludes as $ven)
                            @foreach($ven->vendorContacts as $cname)

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







                    </tr>

                    @endforeach

                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>


@endsection

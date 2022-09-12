@extends('admin.admin_master')
@section('admin')

    <div class="card">
        <div class="card-body" >
            <h1 style="margin-left:85%">Vendor Search</h1>
            <div class="table-responsive" >
                <table id="table" class="table table-striped table-bordered nowrap display">
                    <thead>
                    <tr>
                        <th>Vendor</th>

                    </tr>
                    </thead>

                    <tbody>

                    <tr>


                        @foreach($vpnumbers as $ven)

                                <td><a class="" href="{{ route('admin.vendors.show',$ven->id) }}"  onMouseOver="this.style.color='red'" onMouseOut="this.style.color='blue'">{{ $ven->name }}</a></td>










                    </tr>

                    @endforeach


                    </tbody>

                </table>
            </div>
        </div>
    </div>


@endsection

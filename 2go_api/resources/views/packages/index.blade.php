@extends('master.masterIndex')

@section('content')

    <div class="panel-body">
        <div class="">
            <a href="{{route('package.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Package</th>
                <th>Price</th>
                <th>PromoPrice</th>
                <th>Expiry (Days)</th>
                <th>No. of Items</th>
                <th>Merchant Limit</th>
                <th>Status</th>
                <th>Package-Creator</th>
                <th>Date Updated</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
                <tr>
                    <td>{{$package->id}}</td>
                    <td>{{$package->packageName}}</td>
                    <td>{{$package->packagePrice}}</td>
                    <td>{{$package->packagePromoPrice}}</td>
                    <td>{{$package->packageExpiration}}</td>
                    <td>{{$package->packageNoItem}}</td>
                    <td>{{$package->packageLimit}}</td>
                    <td>{{$package->packageStatus}}</td>
                    <td>{{$package->user->email}}</td>
                    <td>{{date('d M,Y',strtotime($package->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('package.edit',$package->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['package.destroy', $package->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


@extends('master.masterIndex')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('cuisine.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-striped table-hover">
                <thead>
                <tr class="info">
                    <th>ID</th>
                    <th>Cuisine</th>
                    <th>Status</th>
                    <th>Cuisine Creator</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cuisines as $cuisine)
                    <tr>
                        <td>{{$cuisine->id}}</td>
                        <td>{{$cuisine->cuisineName}}</td>
                        <td style="padding-top:15px;">
                            @if($cuisine->cuisineStatus=='Active')
                                <span class="label-custom label label-default">{{$cuisine->cuisineStatus}}</span>
                            @else
                                <span class="label-danger label label-default">{{$cuisine->cuisineStatus}}</span>
                            @endif
                        </td>
                        <td>{{$cuisine->user->email}}</td>
                        <td>{{date('d M,Y',strtotime($cuisine->updated_at))}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('cuisine.edit',$cuisine->id) }}">Edit</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['cuisine.destroy', $cuisine->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

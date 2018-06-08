@extends('master.masterIndex')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('size.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Size</th>
                <th>Status</th>
                <th>Size Creator</th>
                <th>Date Updated</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($sizes as $size)
                <tr>
                    <td>{{$size->id}}</td>
                    <td>{{$size->sizeName}}</td>
                    <td>{{$size->sizeStatus}}</td>
                    <td>{{$size->user->email}}</td>
                    <td>{{date('d M,Y',strtotime($size->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('size.edit',$size->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['size.destroy', $size->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


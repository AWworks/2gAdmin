@extends('master.masterIndex')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('addOnCat.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>AddOnCategory</th>
                <th>Description</th>
                <th>Status</th>
                <th>AddOnCategory-Creator</th>
                <th>Date Updated</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($addOnCat as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->addOnCatName}}</td>
                    <td>{{$category->addOnCatDescription}}</td>
                    <td>{{$category->addOnCatStatus}}</td>
                    <td>{{$category->user->email}}</td>
                    <td>{{date('d M,Y',strtotime($category->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('addOnCat.edit',$category->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['addOnCat.destroy', $category->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


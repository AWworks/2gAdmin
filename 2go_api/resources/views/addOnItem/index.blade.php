@extends('master.masterIndex')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('addOnItem.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>AddOn Item</th>
                <th>AddOns Item Icon</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Status</th>
                <th>Creator</th>
                <th>Date Updated</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($addOnItem as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->addOnItemName}}</td>
                    <td>
                        <img id="img" class="card-img-top"
                             src="{{asset('images/AddOn/'. $item->addOnItemName.'.jpg')}}"
                             alt="Card image cap" width="100" height="100">
                    </td>
                    <td>{{$item->addOnItemDescription}}</td>
                    <td>{{$item->addOnItemPrice}}</td>
                    <td>
                        @foreach($item->category as $category)
                            {{$category->addOnCatName.','}}
                        @endforeach
                    </td>
                    <td>{{$item->addOnItemStatus}}</td>
                    <td>{{$item->user->email}}</td>
                    <td>{{date('d M,Y',strtotime($item->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('addOnItem.edit',$item->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['addOnItem.destroy', $item->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection


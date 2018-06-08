@extends('master.masterIndex')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('foodItem.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
<!--Show success message-->
@if(Session::has('edit_success'))
<p class="alert alert-success" id="editResponse">{{ Session::get('edit_success') }}</p>
@endif
        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Item Image</th>
                <th>Item Description</th>
                <th>Status</th>
                <th>Creator</th>
                <th>Date Updated</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($foodItem as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->foodItemName}}</td>
                    <td>
                        <img id="img" class="card-img-top"
                             src="{{asset('images/foodItem/'.$item->foodItemName.'.jpg')}}"
                             alt="Card image cap" width="100" height="100">
                    </td>
                    <td>{{$item->foodItemDescription}}</td>
                    <td>{{$item->foodItemStatus}}</td>
                    <td>{{$item->user->email}}</td>
                    <td>{{date('d M,Y',strtotime($item->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="foodItem/edit/{{ $item->id }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['foodItem.destroy', $item->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
          $('#editResponse').delay(5000).fadeOut('slow');
        });
    </script>
@endsection

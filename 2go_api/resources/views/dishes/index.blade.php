@extends('master.masterIndex')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('dish.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>Add New
            </a>
        </div>
                <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dish</th>
                        <th>Dish Icon</th>
                        <th>Status</th>
                        <th>Dish Creator</th>
                        <th>Date Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dishes as $dish)
                        <tr>
                            <td>{{$dish->id}}</td>
                            <td>{{$dish->dishName}}</td>
                            <td>
                                <img id="img" class="card-img-top"
                                     src="{{asset('images/Dishes/'.$dish->dishName.'.jpg')}}"
                                     alt="Card image cap" width="150" height="150">
                            </td>
                            <td>{{$dish->dishStatus}}</td>
                            <td>{{$dish->user->email}}</td>
                            <td>{{date('d M,Y',strtotime($dish->updated_at))}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('dish.edit',$dish->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['dish.destroy', $dish->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
@endsection


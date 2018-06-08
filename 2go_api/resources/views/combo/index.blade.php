@extends('master.masterIndex')

@section('content')

    <div class="panel-body">
        <div class="">
            <a href="{{route('combo.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Combo Name</th>
                <th>Combo Description</th>
                <th>Combo Image</th>
                <th>Combo Price</th>
                <th>Food Items</th>
                <th>Status</th>
                <th>Combo Creator</th>
                <th>Date Updated</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($combos as $combo)
                <tr>
                    <td>{{$combo->id}}</td>
                    <td>{{$combo->comboName}}</td>
                    <td>{{$combo->comboDescription}}</td>
                    <td>
                        <img id="img" class="card-img-top"
                             src="{{asset('images/Combos/'.$combo->comboName.'.jpg')}}"
                             alt="Card image cap" width="150" height="150">
                    </td>
                    <td>{{$combo->comboPrice}}</td>
                    <td>
                        @foreach($combo->foodItem as $items)
                            {{$items->foodItemName}},
                        @endforeach
                    </td>
                    <td>{{$combo->comboStatus}}</td>
                    <td>{{$combo->user->email}}</td>
                    <td>{{date('d M,Y',strtotime($combo->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('combo.edit',$combo->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['combo.destroy', $combo->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection


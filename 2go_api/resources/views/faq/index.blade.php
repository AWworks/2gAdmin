@extends('master.masterIndex')

@section('content')

    <div class="panel-body">
        <div class="">
            <a href="{{route('faq.create')}}" class="btn btn-exp btn-sm">
                <i class="fa fa-plus"></i>&nbsp;Add New
            </a>
        </div>
        <table id="table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Status</th>
                <th>Cuisine Creator</th>
                <th>Date Updated</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($faqs as $faq)
                <tr>
                    <td>{{$faq->id}}</td>
                    <td>{{$faq->faqQuestion}}</td>
                    <td>{{$faq->faqAnswer}}</td>
                    <td>{{$faq->faqStatus}}</td>
                    <td>{{$faq->user->email}}</td>
                    <td>{{date('d M,Y',strtotime($faq->updated_at))}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('faq.edit',$faq->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['faq.destroy', $faq->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure to delete?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


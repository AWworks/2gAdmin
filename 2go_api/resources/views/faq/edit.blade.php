@extends('master.masterEdit')

@section('content')
    <div class="panel-body">
        <div class="">
            <a href="{{route('faq.index')}}" class="uk-button">
                <i class="fa fa-plus"></i> List</a>
        </div>

        {{ Form::model($faq, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['faq.update', $faq->id]]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>Faq Question</label>
            {!! Form::text('faqQuestion', null,['class' => 'uk-form-width-large']) !!}
        </div>

        <div class="form-group">
            <label>Faq Answer</label>
            {!! Form::text('faqAnswer', null,['class' => 'uk-form-width-large']) !!}
        </div>

        <div class="form-group">
            <label>Status</label>

            <select class="form-control" name="faqStatus">
                @if($faq->faqStatus=="Active")
                    <option value="Active" selected="selected">Active</option>
                    <option value="InActive">InActive</option>
                @else
                    <option value="InActive" selected="selected">InActive</option>
                    <option value="Active">Active</option>
                @endif
            </select>
        </div>

        <div class="form-group">
            <label></label>
            <input type="submit" value="Update Faq"
                   class="btn btn-success">
        </div>
        {!! Form::close() !!}
    </div>
@endsection
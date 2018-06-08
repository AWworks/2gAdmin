@extends('master.masterEdit')

@section('content')
    <div class="panel-body">

        {{ Form::model($policy, ['method' => 'PATCH','class'=>"uk-form uk-form-horizontal forms",
        'route' => ['policy.update', $policy->id]]) }}
        {{ csrf_field() }}
        @include('errors.errors')

        <div class="form-group">
            <label>Buffer Time</label>
            {!! Form::text('policy', null,['class' => 'uk-form-width-large']) !!}
        </div>

        <div class="form-group">
            <label></label>
            <input type="submit" value="Update Buffer Time"
                   class="btn btn-success">
        </div>
        {!! Form::close() !!}

    </div>
@endsection
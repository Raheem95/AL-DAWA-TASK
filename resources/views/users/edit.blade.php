@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row form-container">
            {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'post']) !!}
            {{ Form::hidden('_method', 'PUT') }}
            <!-- Name field -->
            <div class="col-md-6">
                {!! Form::label('name', 'Name', ['class' => 'model_label']) !!}
                {!! Form::text('name', $user->name, [
                    'id' => 'name',
                    'class' => 'input_style resetField',
                    'placeholder' => 'Full Name',
                ]) !!}
            </div>

            <!-- DOB field -->
            <div class="col-md-6">
                {!! Form::label('Email', 'Email', ['class' => 'model_label']) !!}
                {!! Form::email('email', $user->email, ['id' => 'Email', 'class' => 'input_style resetField']) !!}
            </div>

            <!-- Gender field -->
            <div class="col-md-6">
                {!! Form::label('user_type', 'User Type', ['class' => 'model_label']) !!}
                {!! Form::select('user_type', ['' => 'Select', '2' => 'HR Manager', '1' => 'HR Coordinato'], $user->user_type, [
                    'id' => 'user_type',
                    'class' => 'input_style resetField',
                    'required',
                ]) !!}
            </div>

            <!-- Submit button -->
            <div class="col-md-12" style="display: flex;justify-content: center;">
                <button type="submit" class="submit">
                    <span></span>
                    Save
                </button>
                <button type="reset" class="reset">
                    <span></span>
                    Reset
                </button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <script>
        $(document).on('input', '.resetField', function() {
            if ($("#" + $(this).attr("id") + "Error").length) {
                $("#" + $(this).attr("id") + "Error").remove()
                $(this).removeClass("error_input");
            }
        });
    </script>
@endsection

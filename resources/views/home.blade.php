@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row form-container">
            {!! Form::open([
                'action' => 'HomeController@store',
                'method' => 'post',
                'enctype' => 'multipart/form-data',
                'onsubmit' => 'return validateForm()',
            ]) !!}
            <!-- Name field -->
            <div class="col-md-6">
                {!! Form::label('name', 'Name', ['class' => 'model_label']) !!}
                {!! Form::text('name', null, [
                    'id' => 'name',
                    'class' => 'input_style resetField',
                    'placeholder' => 'Full Name',
                ]) !!}
            </div>

            <!-- DOB field -->
            <div class="col-md-6">
                {!! Form::label('dob', 'Date of Birth', ['class' => 'model_label']) !!}
                {!! Form::date('dob', null, ['id' => 'dob', 'class' => 'input_style resetField']) !!}
            </div>

            <!-- Gender field -->
            <div class="col-md-6">
                {!! Form::label('gender', 'Gender', ['class' => 'model_label']) !!}
                {!! Form::select('gender', ['' => 'Select Gender', 'male' => 'Male', 'Female' => 'Female'], null, [
                    'id' => 'gender',
                    'class' => 'input_style resetField',
                    'required',
                ]) !!}
            </div>

            <!-- Nationality field -->
            <div class="col-md-6">
                {!! Form::label('nationality', 'Nationality', ['class' => 'model_label']) !!}
                {!! Form::text('nationality', null, [
                    'id' => 'nationality',
                    'class' => 'input_style resetField',
                    'placeholder' => 'Nationality',
                ]) !!}
            </div>

            <!-- CV attachment field -->
            <div class="col-md-6">
                {!! Form::label('cv', 'Attach CV', ['class' => 'model_label']) !!}
                {!! Form::file('cv', ['id' => 'cv', 'class' => 'input_style resetField']) !!}
            </div>
            <div class="col-md-6"></div>

            <!-- Submit button -->
            <div class="col-md-12" style="display: flex;justify-content: center;">
                <button type="submit" class="submit">
                    <span></span>
                    Submit
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

        function validateForm() {
            var flag = true
            $(".error-label").remove();
            $(".error_input").removeClass("error_input");

            if ($("#name").val() == "") {
                flag = false;
                $("#name").addClass("error_input");
                CreateErrorLabel("name", "Please enter valid name");
            }
            if (!$("#dob").val()) {
                flag = false;
                $("#dob").addClass("error_input");
                CreateErrorLabel("dob", "Please Enter Valid Date of Birth");
            }
            if ($("#gender").val() == 0) {
                flag = false;
                $("#gender").addClass("error_input");
                CreateErrorLabel("gender", "Please select the gender");
            }
            if ($("#nationality").val() == "") {
                flag = false;
                $("#nationality").addClass("error_input");
                CreateErrorLabel("nationality", "Please EnterValid Nationality");
            }
            const cvInput = document.getElementById('cv');

            if (cvInput.files.length > 0) {
                const file = cvInput.files[0];
                console.log(file.type)
                if (file.type !== 'application/pdf') {
                    CreateErrorLabel("cv", "Please upload a valid PDF file.");
                    flag = false;
                }
            } else {
                CreateErrorLabel("cv", "Please upload the cv");
            }
            return flag;
        }
    </script>
@endsection

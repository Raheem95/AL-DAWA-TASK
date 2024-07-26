@extends('layouts.app')
@section('content')
    <div style="padding:10px 50px;">
        @if (count($users) > 0)
            <table class="table">
                <thead>
                    <th>User Email</th>
                    <th>User Name</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </thead>
                @foreach ($users as $user)
                    <tr id="TR{{ $user->id }}">
                        <td id="UserName{{ $user->id }}">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_type == 2 ? 'HR Manager' : 'HR Coordinator' }}</td>
                        <td style="width:20%;">
                            <div style="display: flex;justify-content: left;">
                                <a href="users/{{ $user->id }}/edit"><button type="button"
                                        class="view">Edit</button></a>
                                @if ($user->susspend == 0)
                                    <button id="Suspend{{ $user->id }}" type="button" class="warning susspend"
                                        data-status="1" value="{{ $user->id }}">Susspend</button>
                                @else
                                    <button id="Suspend{{ $user->id }}" type="button" class="accept susspend"
                                        data-status="0" value="{{ $user->id }}">Active</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="col-md-12 alert alert-danger Result">
                No users idailable
            </div>
        @endif
    </div>
    <script>
        $(document).on('click', '.susspend', function() {
            var UserID = $(this).val()
            var Status = $(this).data("status")
            var AlertMessage = "Suspend"
            if (Status == 0)
                AlertMessage = "Active"
            customConfirm(AlertMessage + "  " + $("#UserName" + UserID).html() + " ?",
                function(result) {
                    if (result) {
                        var form_data = new FormData();
                        form_data.append('UserID', UserID);
                        form_data.append('Status', Status);
                        $.ajax({
                            url: "{{ route('susspend') }}",
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]')
                                    .attr(
                                        'content'));
                            },
                            success: function(result) {
                                if (!isNaN(result)) {
                                    if (Status == 1) {
                                        $("#Suspend" + UserID).removeClass("warning").addClass(
                                            "accept").html("Active").data("status", "0")
                                    } else {
                                        $("#Suspend" + UserID).addClass("warning").removeClass(
                                            "accept").html("Susspend").data("status", "1")
                                    }
                                    customAlert("User " + AlertMessage + " Succeffully",
                                        "success");
                                } else
                                    $("#Results").removeClass("alert-success").addClass(
                                        "alert-danger").html(
                                        result);
                            },
                            error: function(xhr, status, error) {
                                // Handle error
                            }
                        });
                    } else {
                        customAlert("Opration canceld", "info");
                    }
                });
        });
    </script>
@endsection

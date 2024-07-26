@extends('layouts.app')
@section('content')
    <div style="padding:10px 50px;">
        @if (count($applicants) > 0)
            <table class="table">
                <thead>
                    <th>Applicant Name</th>
                    <th>Applicant Dae Of Birth</th>
                    <th>Applicant Gender</th>
                    <th>Applicant Nationality</th>
                    <th>Actions</th>
                </thead>
                @foreach ($applicants as $applicant)
                    <tr id="TR{{ $applicant->id }}">
                        <td id="ApplicantName{{ $applicant->id }}">{{ $applicant->name }}</td>
                        <td>{{ $applicant->dob }}</td>
                        <td>{{ $applicant->gender }}</td>
                        <td>{{ $applicant->nationality }}</td>
                        <td style="width:20%;">
                            <div style="display: flex;justify-content: left;">
                                <a href = '{{ $applicant->cv }}'><button type="button" class="view">Download CV</button></a>
                                <button type="button" class="accept SetStatus" value="{{ $applicant->id }}"
                                    data-status="{{ $applicant->status + 1 }}">Accept</button>
                                <button type="button" class="reject SetStatus" value="{{ $applicant->id }}"
                                    data-status="{{ ($applicant->status + 1) * -1 }}">Reject</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="col-md-12 alert alert-danger Result">
                No applicants Available
            </div>
        @endif
    </div>
    <script>
        $(document).on('click', '.SetStatus', function() {
            var ApplicationID = $(this).val()
            var Status = $(this).data("status")
            var AlertMessage = "Accept"
            if (Status < 0)
                AlertMessage = "Reject"
            customConfirm(AlertMessage + "  " + $("#ApplicantName" + ApplicationID).html() +
                " application ?",
                function(result) {
                    if (result) {
                        var form_data = new FormData();
                        form_data.append('ApplicationID', ApplicationID);
                        form_data.append('Status', Status);
                        $.ajax({
                            url: "{{ route('application_status') }}",
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
                                    customAlert("Application " + AlertMessage + " Done Succeffully",
                                        "success");
                                    $("#TR" + ApplicationID).remove()
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

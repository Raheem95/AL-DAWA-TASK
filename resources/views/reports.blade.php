@extends('layouts.app')
@section('content')
    <div style="padding:10px 50px;">
        <div class="row">
            <div class="col-md-4">

                <canvas class="Pie" id="ApplicationSummary"></canvas>
                <input type='hidden' value='<?php echo implode(',', $ApplicationSummaryLabels); ?>' id="ApplicationSummaryLabel">
                <input type='hidden' value='<?php echo implode(',', $ApplicationSummaryData); ?>' id="ApplicationSummaryData">
                <input type='hidden' value='ايرادات الاشهر' id="ApplicationSummaryHint">
            </div>
            <div class="col-md-8">
                <div class="SeconderyDiv"><canvas id="ApplicationSummaryBarCtx" class="barCtx"></canvas></div>
                <input type='hidden' value='<?php echo implode(',', $ApplicationSummaryLabels); ?>' id="ApplicationSummaryBarCtxLabel">
                <input type='hidden' value='<?php echo implode(',', $ApplicationSummaryData); ?>' id="ApplicationSummaryBarCtxData">
                <input type='hidden' value='' id="ApplicationSummaryBarCtxHint">
            </div>
        </div>
        @if (count($applicants) > 0)
            <table class="table">
                <thead>
                    <th>Applicant Name</th>
                    <th>Applicant Dae Of Birth</th>
                    <th>Applicant Gender</th>
                    <th>Applicant Nationality</th>
                    <th>Hr Cordinator</th>
                    <th>Hr Cordinator Action </th>
                    <th>Hr Cordinator Action Date</th>
                    <th>Hr Manager</th>
                    <th>Hr Manager Action </th>
                    <th>Hr Manager Action Date</th>
                </thead>
                @foreach ($applicants as $applicant)
                    <tr>
                        <td>{{ $applicant->name }}</td>
                        <td>{{ $applicant->dob }}</td>
                        <td>{{ $applicant->gender }}</td>
                        <td>{{ $applicant->nationality }}</td>
                        <td>{{ $applicant->Coordinator ? $applicant->Coordinator->name : 'Pennding' }}</td>
                        <td>
                            <?php
                            $Class = '';
                            if ($applicant->status == 0) {
                                $Class = 'pending';
                            } elseif ($applicant->status == -1) {
                                $Class = 'reject';
                            } else {
                                $Class = 'accept';
                            }
                            ?>
                            <div class="{{ $Class }}">{{ $Class }}</div>
                        </td>

                        <td>{{ $applicant->coordinator_date }}</td>
                        <td>{{ $applicant->HrManager ? $applicant->HrManager->name : '-' }}</td>
                        <td>
                            <?php
                            $Class = '';
                            if ($applicant->status == 2) {
                                $Class = 'accept';
                            } elseif ($applicant->status == -2) {
                                $Class = 'reject';
                            } elseif ($applicant->status == 1) {
                                $Class = 'pending';
                            } else {
                                $Class = '-';
                            }
                            ?>
                            <div class="{{ $Class }}">{{ $Class }}</div>
                        </td>
                        <td>{{ $applicant->manager_date }}</td>

                    </tr>
                @endforeach
            </table>
        @else
            <div class="col-md-12 alert alert-danger Result">
                No applicants Available
            </div>
        @endif
    </div>

    <script src="{{ asset('js/charts.js') }}"></script>
    <script src="{{ asset('js/MyCharts.js') }}"></script>
@endsection

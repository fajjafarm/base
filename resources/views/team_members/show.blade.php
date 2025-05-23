<?php
@extends('layouts.vertical', ['title' => 'Team Member Profile'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => $teamMember->first_name . ' ' . $teamMember->surname])

    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="col-md-12">
            <div class="card border-secondary border">
                <div class="card-body">
                    <h3 class="text-lg font-medium">Personal Information</h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p><strong>Rank:</strong> {{ $teamMember->rank }}</p>
                            <p><strong>Start Date:</strong> {{ $teamMember->start_date->format('Y-m-d') }}</p>
                            @if($teamMember->end_date)
                                <p><strong>End Date:</strong> {{ $teamMember->end_date->format('Y-m-d') }}</p>
                            @endif
                        </div>
                        <div>
                            <p><strong>Last Year's Training Hours:</strong> {{ number_format($teamMember->last_year_training_hours, 2) }} hours</p>
                            <p><strong>Average CPR Score:</strong> {{ number_format($teamMember->average_cpr_score, 2) }}</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-medium mt-8">Training Logs</h3>
                    <div class="table-responsive-sm">
                        <table class="table table-striped mb-0 table-sm">
                            <thead>
                                <tr class="table-dark">
                                    <th colspan="4">Training Logs</th>
                                </tr>
                                <tr class="table-dark">
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Duration</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trainingLogs as $log)
                                    <tr>
                                        <td>{{ $log->date->format('Y-m-d') }}</td>
                                        <td>{{ $log->type }}</td>
                                        <td>{{ $log->duration }} minutes</td>
                                        <td>
                                            @if($log->expiry_date)
                                                {{ $log->expiry_date->format('Y-m-d') }}
                                                @if($log->expiry_date->isPast())
                                                    <span class="text-danger">(Expired)</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- end table-->

                    <h3 class="text-lg font-medium mt-8">CPR Trainings</h3>
                    <div class="table-responsive-sm">
                        <table class="table table-striped mb-0 table-sm">
                            <thead>
                                <tr class="table-dark">
                                    <th colspan="5">CPR Trainings</th>
                                </tr>
                                <tr class="table-dark">
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Type</th>
                                    <th>Score</th>
                                    <th>Screenshot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cprTrainings as $cpr)
                                    <tr>
                                        <td>{{ $cpr->date->format('Y-m-d') }}</td>
                                        <td>{{ $cpr->time }}</td>
                                        <td>{{ $cpr->type }}</td>
                                        <td>{{ $cpr->score }}</td>
                                        <td>
                                            @if($cpr->screenshot)
                                                <a href="{{ Storage::url($cpr->screenshot) }}" 
                                                   target="_blank" 
                                                   class="text-primary">
                                                    View
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- end table-->
                </div><!-- end card-body-->
            </div><!-- end card-border-->
        </div><!-- end column-->
    </div><!-- end card -->

@endsection
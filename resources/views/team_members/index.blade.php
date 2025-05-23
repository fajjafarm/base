<?php
@extends('layouts.vertical', ['title' => 'Team Members'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Pages', 'title' => 'Team Members'])

    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="col-md-12">
            <div class="card border-secondary border">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-striped mb-0 table-sm">
                            <thead>
                                <tr class="table-dark">
                                    <th colspan="3">Team Members</th>
                                </tr>
                                <tr class="table-dark">
                                    <th>Name</th>
                                    <th>Rank</th>
                                    <th>Start Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teamMembers as $teamMember)
                                    <tr>
                                        <td>
                                            <a href="{{ route('team-members.show', $teamMember) }}" 
                                               class="text-primary">
                                                {{ $teamMember->first_name }} {{ $teamMember->surname }}
                                            </a>
                                        </td>
                                        <td>{{ $teamMember->rank }}</td>
                                        <td>{{ $teamMember->start_date->format('Y-m-d') }}</td>
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
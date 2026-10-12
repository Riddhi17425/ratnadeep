@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Application — {{ $application->full_name }}</h2>
        <a href="{{ route('job-applications.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered mb-3">
                <tr><th style="width:240px">Full name</th><td>{{ $application->full_name }}</td></tr>
                <tr><th>Email</th><td><a href="mailto:{{ $application->email }}">{{ $application->email }}</a></td></tr>
                <tr><th>Phone</th><td><a href="tel:{{ preg_replace('/[^0-9+]/', '', $application->phone) }}">{{ $application->phone }}</a></td></tr>
                <tr><th>Position applied for</th><td>{{ $application->position }}</td></tr>
                <tr><th>Total relevant experience</th><td>{{ $application->experience }}</td></tr>
                <tr>
                    <th>LinkedIn</th>
                    <td>
                        @if($application->linkedin)
                            <a href="{{ \Illuminate\Support\Str::startsWith($application->linkedin, ['http://', 'https://']) ? $application->linkedin : 'https://' . $application->linkedin }}" target="_blank" rel="noopener">{{ $application->linkedin }}</a>
                        @else
                            —
                        @endif
                    </td>
                </tr>
                <tr><th>Applied on</th><td>{{ $application->created_at->format('d M Y, h:i A') }}</td></tr>
            </table>

            <a href="{{ route('job-applications.download', $application->id) }}" class="btn btn-primary">
                <i class="icofont-download"></i> Download resume
            </a>
        </div>
    </div>
</div>
@endsection

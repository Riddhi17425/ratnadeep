@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Job Applications</h2>
        <a href="{{ route('job-openings.index') }}" class="btn btn-outline-primary">
            <i class="icofont-briefcase-1"></i> Job Openings
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="jobApplicationTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Contact</th>
                        <th>Experience</th>
                        <th>Applied on</th>
                        <th>Resume</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $key => $application)
                    <tr class="{{ $application->trashed() ? 'table-light text-muted' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $application->full_name }}
                            @if(!$application->is_read && !$application->trashed())
                                <span class="badge bg-danger">New</span>
                            @endif
                        </td>
                        <td>{{ $application->position }}</td>
                        <td>{{ $application->email }}<br><small>{{ $application->phone }}</small></td>
                        <td>{{ $application->experience }}</td>
                        <td data-order="{{ $application->created_at->timestamp }}">{{ $application->created_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <a href="{{ route('job-applications.download', $application->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="icofont-download"></i> Download
                            </a>
                        </td>
                        <td>
                            @include('admin.partials.action-cell', [
                                'model' => $application,
                                'base' => 'job-applications',
                                'title' => $application->full_name,
                                'noEdit' => true,
                                'viewRoute' => route('job-applications.show', $application->id),
                            ])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('admin.partials.crud-scripts', ['tableId' => 'jobApplicationTable', 'label' => 'application', 'base' => 'job-applications', 'hasStatus' => false])
@endpush

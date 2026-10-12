@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Job Openings</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('job-applications.index') }}" class="btn btn-outline-primary">
                <i class="icofont-ui-file"></i> Applications
            </a>
            <a href="{{ route('job-openings.create') }}" class="btn btn-primary">
                <i class="icofont-plus"></i> Add Job Opening
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="jobOpeningTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Area</th>
                        <th>Location</th>
                        <th>Applications</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobOpenings as $key => $jobOpening)
                    <tr class="{{ $jobOpening->trashed() ? 'table-light text-muted' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $jobOpening->title }}<br><small class="text-muted">{{ $jobOpening->department }}</small></td>
                        <td>{{ $jobOpening->area }}</td>
                        <td>{{ $jobOpening->location }}</td>
                        <td>{{ $jobOpening->applications_count }}</td>
                        <td>{{ $jobOpening->sort_order }}</td>
                        <td>@include('admin.partials.status-cell', ['model' => $jobOpening])</td>
                        <td>@include('admin.partials.action-cell', ['model' => $jobOpening, 'base' => 'job-openings', 'title' => $jobOpening->title])</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('admin.partials.crud-scripts', ['tableId' => 'jobOpeningTable', 'label' => 'job opening', 'base' => 'job-openings'])
@endpush

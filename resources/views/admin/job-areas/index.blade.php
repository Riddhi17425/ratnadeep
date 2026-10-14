@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Job Areas</h2>
        <a href="{{ route('job-areas.create') }}" class="btn btn-primary">
            <i class="icofont-plus"></i> Add Job Area
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Area</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobAreas as $jobArea)
                        <tr class="{{ $jobArea->trashed() ? 'table-light text-muted' : '' }}">
                            <td>{{ $jobArea->name }}</td>
                            <td>{{ $jobArea->sort_order }}</td>
                            <td>
                                @if($jobArea->trashed())
                                    <span class="badge bg-danger">Trashed</span>
                                @else
                                    <span class="badge bg-{{ $jobArea->status ? 'success' : 'secondary' }}">
                                        {{ $jobArea->status ? 'Active' : 'Inactive' }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($jobArea->trashed())
                                    <form action="{{ route('job-areas.restore', $jobArea->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                    <form action="{{ route('job-areas.force-delete', $jobArea->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Permanently delete this area?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>
                                    </form>
                                @else
                                    <a href="{{ route('job-areas.edit', $jobArea) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('job-areas.destroy', $jobArea) }}" method="POST" class="d-inline" onsubmit="return confirm('Move this area to trash?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">No job areas have been added.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

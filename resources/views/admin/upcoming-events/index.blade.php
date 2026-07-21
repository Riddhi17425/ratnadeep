@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Upcoming Events</h2>
        <a href="{{ route('upcoming-events.create') }}" class="btn btn-primary">
            <i class="icofont-plus"></i> Add Upcoming Event
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="eventTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($event->icon)
                                <img src="{{ asset('storage/'.$event->icon) }}" alt="{{ $event->alt_icon_text }}" width="40">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->date_from?->format('d M Y') ?? '-' }}</td>
                        <td>{{ $event->date_to?->format('d M Y') ?? '-' }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="form-check form-switch mb-0">
                                    <input
                                        type="checkbox"
                                        class="form-check-input status-toggle"
                                        data-id="{{ $event->id }}"
                                        {{ $event->status == 1 ? 'checked' : '' }}
                                        style="width: 3em; height: 1.5em; cursor: pointer;"
                                    >
                                </div>
                                <span class="status-text badge bg-{{ $event->status == 1 ? 'success' : 'secondary' }}">
                                    {{ $event->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('upcoming-events.edit', $event->id) }}" class="btn btn-sm btn-info">
                                <i class="icofont-edit"></i>
                            </a>
                            <form action="{{ route('upcoming-events.destroy', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="icofont-trash"></i>
                                </button>
                            </form>
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
<script>
    function showAppToast(type, message) {
        const existing = document.getElementById('app-toast');
        if (existing) existing.remove();

        const colors = { success: '#28a745', error: '#dc3545', info: '#17a2b8' };
        const icons = { success: 'bi-check-circle-fill', error: 'bi-x-circle-fill', info: 'bi-info-circle-fill' };

        const toast = document.createElement('div');
        toast.id = 'app-toast';
        toast.style.cssText = `
            position: fixed; top: 20px; right: 20px; z-index: 9999;
            min-width: 280px; max-width: 380px; background: #fff;
            border-left: 5px solid ${colors[type]}; border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15); padding: 14px 18px;
            display: flex; align-items: center; gap: 10px;
            opacity: 0; transform: translateX(20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        `;

        toast.innerHTML = `
            <i class="bi ${icons[type]}" style="color: ${colors[type]}; font-size: 1.3rem;"></i>
            <span style="flex: 1; color: #333; font-size: 0.95rem;">${message}</span>
            <button onclick="document.getElementById('app-toast').remove()" style="background: none; border: none; color: #999; font-size: 1.1rem; cursor: pointer; line-height: 1;">&times;</button>
        `;

        document.body.appendChild(toast);
        requestAnimationFrame(() => {
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(0)';
        });

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(20px)';
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }

    $(document).ready(function () {
        $('#eventTable').DataTable();

        $(document).on('change', '.status-toggle', function () {
            var checkbox = $(this);
            var id = checkbox.data('id');
            var isChecked = checkbox.is(':checked');
            var newStatus = isChecked ? 1 : 0;
            var statusText = checkbox.closest('.d-flex').find('.status-text');

            $.ajax({
                url: '/admin/upcoming-events/' + id + '/status',
                method: 'POST',
                data: { _token: '{{ csrf_token() }}', status: newStatus },
                success: function (response) {
                    if (response.success) {
                        if (isChecked) {
                            statusText.text('Active').removeClass('bg-secondary').addClass('bg-success');
                            showAppToast('success', 'This Upcoming Event is now Active.');
                        } else {
                            statusText.text('Inactive').removeClass('bg-success').addClass('bg-secondary');
                            showAppToast('success', 'This Upcoming Event is now Inactive.');
                        }
                    } else {
                        showAppToast('error', 'Something went wrong.');
                        checkbox.prop('checked', !isChecked);
                    }
                },
                error: function () {
                    showAppToast('error', 'Something went wrong.');
                    checkbox.prop('checked', !isChecked);
                }
            });
        });
    });
</script>
@endpush
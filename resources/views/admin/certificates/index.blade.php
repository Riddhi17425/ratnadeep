@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Certificates</h2>
        <a href="{{ route('certificates.create') }}" class="btn btn-primary">
            <i class="icofont-plus"></i> Add Certificate
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="certificateTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($certificates as $key => $certificate)
                    <tr class="{{ $certificate->trashed() ? 'table-light text-muted' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($certificate->image)
                                <img src="{{ asset($certificate->image) }}" alt="{{ $certificate->alt_image_text }}" width="50" style="{{ $certificate->trashed() ? 'opacity:0.5' : '' }}">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $certificate->title }}</td>
                        <td>
                            @if($certificate->trashed())
                                <span class="badge bg-danger">Trashed</span>
                            @else
                                <div class="d-flex align-items-center gap-2">
                                    <div class="form-check form-switch mb-0">
                                        <input
                                            type="checkbox"
                                            class="form-check-input status-toggle"
                                            data-id="{{ $certificate->id }}"
                                            {{ $certificate->status == 1 ? 'checked' : '' }}
                                            style="width: 3em; height: 1.5em; cursor: pointer;"
                                        >
                                    </div>
                                    <span class="status-text badge bg-{{ $certificate->status == 1 ? 'success' : 'secondary' }}">
                                        {{ $certificate->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($certificate->trashed())
                                {{-- Trashed row: Restore + Permanent Delete --}}
                                <form action="{{ route('certificates.restore', $certificate->id) }}" method="POST" class="d-inline restore-form">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="icofont-refresh"></i> Restore
                                    </button>
                                </form>

                                <button type="button"
                                    class="btn btn-sm btn-danger btn-force-delete-open"
                                    data-id="{{ $certificate->id }}"
                                    data-title="{{ $certificate->title }}">
                                    <i class="icofont-close-circled"></i> Delete Permanently
                                </button>
                            @else
                                {{-- Active row: Edit + Simple Delete (SweetAlert confirm) --}}
                                <a href="{{ route('certificates.edit', $certificate->id) }}" class="btn btn-sm btn-info">
                                    <i class="icofont-edit"></i>
                                </a>

                                <form action="{{ route('certificates.destroy', $certificate->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="icofont-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Hidden form used only for trashed row's "Delete Permanently" button --}}
<form id="forceDeleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
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
        $('#certificateTable').DataTable();

        // Soft delete confirm
        $(document).on('submit', '.delete-form', function (e) {
            e.preventDefault();
            var form = this;

            Swal.fire({
                title: 'Delete this certificate?',
                text: 'It will be moved to trash. You can restore it later.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Restore confirm
        $(document).on('submit', '.restore-form', function (e) {
            e.preventDefault();
            var form = this;

            Swal.fire({
                title: 'Restore this certificate?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, restore it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Trashed row's direct "Delete Permanently" button
        $(document).on('click', '.btn-force-delete-open', function () {
            var id = $(this).data('id');
            var title = $(this).data('title');

            Swal.fire({
                title: 'Permanently delete "' + title + '"?',
                text: 'This action cannot be undone. The image will also be removed.',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete permanently',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $('#forceDeleteForm');
                    form.attr('action', '{{ url("admin/certificates") }}/' + id + '/force-delete');
                    form.trigger('submit');
                }
            });
        });

        $(document).on('change', '.status-toggle', function () {
            var checkbox = $(this);
            var id = checkbox.data('id');
            var isChecked = checkbox.is(':checked');
            var newStatus = isChecked ? 1 : 0;
            var statusText = checkbox.closest('.d-flex').find('.status-text');

            $.ajax({
                url: '/admin/certificates/' + id + '/status',
                method: 'POST',
                data: { _token: '{{ csrf_token() }}', status: newStatus },
                success: function (response) {
                    if (response.success) {
                        if (isChecked) {
                            statusText.text('Active').removeClass('bg-secondary').addClass('bg-success');
                            showAppToast('success', 'This Certificate is now Active.');
                        } else {
                            statusText.text('Inactive').removeClass('bg-success').addClass('bg-secondary');
                            showAppToast('success', 'This Certificate is now Inactive.');
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
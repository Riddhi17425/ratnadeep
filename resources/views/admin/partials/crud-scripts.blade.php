{{-- Shared list-page script (toast, DataTable, delete / restore / force-delete confirms, status switch).
     Same behaviour as the existing certificates / industries lists.
     Needs: $tableId, $label (e.g. "product"), $base (url segment e.g. "products"), optional $hasStatus (default true) --}}
@php
    $hasStatus = $hasStatus ?? true;
    $labelTitle = ucfirst($label);
@endphp
<form id="forceDeleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

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
        $('#{{ $tableId }}').DataTable({ order: [] });

        // Soft delete confirm
        $(document).on('submit', '.delete-form', function (e) {
            e.preventDefault();
            var form = this;

            Swal.fire({
                title: 'Delete this {{ $label }}?',
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
                title: 'Restore this {{ $label }}?',
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
                text: 'This action cannot be undone. Uploaded files will also be removed.',
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
                    form.attr('action', '{{ url("admin/" . $base) }}/' + id + '/force-delete');
                    form.trigger('submit');
                }
            });
        });

@if($hasStatus)
        $(document).on('change', '.status-toggle', function () {
            var checkbox = $(this);
            var id = checkbox.data('id');
            var isChecked = checkbox.is(':checked');
            var newStatus = isChecked ? 1 : 0;
            var statusText = checkbox.closest('.d-flex').find('.status-text');

            $.ajax({
                url: '{{ url("admin/" . $base) }}/' + id + '/status',
                method: 'POST',
                data: { _token: '{{ csrf_token() }}', status: newStatus },
                success: function (response) {
                    if (response.success) {
                        if (isChecked) {
                            statusText.text('Active').removeClass('bg-secondary').addClass('bg-success');
                            showAppToast('success', 'This {{ $labelTitle }} is now Active.');
                        } else {
                            statusText.text('Inactive').removeClass('bg-success').addClass('bg-secondary');
                            showAppToast('success', 'This {{ $labelTitle }} is now Inactive.');
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
@endif
    });
</script>

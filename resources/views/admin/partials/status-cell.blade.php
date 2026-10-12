{{-- Status switch used by the list pages (same markup as the existing modules). Needs $model --}}
@if($model->trashed())
    <span class="badge bg-danger">Trashed</span>
@else
    <div class="d-flex align-items-center gap-2">
        <div class="form-check form-switch mb-0">
            <input
                type="checkbox"
                class="form-check-input status-toggle"
                data-id="{{ $model->id }}"
                {{ $model->status == 1 ? 'checked' : '' }}
                style="width: 3em; height: 1.5em; cursor: pointer;"
            >
        </div>
        <span class="status-text badge bg-{{ $model->status == 1 ? 'success' : 'secondary' }}">
            {{ $model->status == 1 ? 'Active' : 'Inactive' }}
        </span>
    </div>
@endif

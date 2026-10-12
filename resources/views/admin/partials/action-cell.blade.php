{{-- Edit / delete / restore / permanent delete buttons. Needs $model, $base (route prefix), $title --}}
@if($model->trashed())
    <form action="{{ route($base . '.restore', $model->id) }}" method="POST" class="d-inline restore-form">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-sm btn-success">
            <i class="icofont-refresh"></i> Restore
        </button>
    </form>

    <button type="button"
        class="btn btn-sm btn-danger btn-force-delete-open"
        data-id="{{ $model->id }}"
        data-title="{{ $title }}">
        <i class="icofont-close-circled"></i> Delete Permanently
    </button>
@else
    @if(empty($noEdit))
        <a href="{{ route($base . '.edit', $model->id) }}" class="btn btn-sm btn-info">
            <i class="icofont-edit"></i>
        </a>
    @endif
    @if(!empty($viewRoute))
        <a href="{{ $viewRoute }}" class="btn btn-sm btn-primary">
            <i class="icofont-eye"></i>
        </a>
    @endif

    <form action="{{ route($base . '.destroy', $model->id) }}" method="POST" class="d-inline delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="icofont-trash"></i>
        </button>
    </form>
@endif

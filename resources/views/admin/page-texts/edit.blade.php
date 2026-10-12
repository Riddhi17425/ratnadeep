@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Page Texts — {{ $config['label'] }}</h2>
        <a href="{{ route('page-texts.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('page-texts.update', $page) }}" method="POST" enctype="multipart/form-data">
                @csrf

                @foreach($config['fields'] as $key => [$label, $type, $default])
                    @php
                        $value = old($key, $values[$key] ?? $default);
                    @endphp
                    <div class="mb-3">
                        <label class="form-label">{{ $label }}</label>

                        @if($type === 'textarea')
                            <textarea name="{{ $key }}" rows="{{ max(2, min(8, (int) ceil(strlen($default) / 110) + 1)) }}" class="form-control">{{ $value }}</textarea>
                        @elseif($type === 'image')
                            <input type="file" name="{{ $key }}" class="form-control">
                            <div class="mt-2 d-flex align-items-center gap-3">
                                <img src="{{ asset($values[$key] ?? $default) }}" alt="" height="70" class="rounded border">
                                @if(isset($values[$key]))
                                    <div class="form-check">
                                        <input type="checkbox" name="reset_{{ $key }}" value="1" class="form-check-input" id="reset_{{ $key }}">
                                        <label class="form-check-label" for="reset_{{ $key }}">Use the original image again</label>
                                    </div>
                                @endif
                            </div>
                        @else
                            <input type="text" name="{{ $key }}" class="form-control" value="{{ $value }}">
                        @endif

                        @error($key) <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('page-texts.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

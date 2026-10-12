@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Page Texts</h2>
    <p class="text-muted">Edit the headings, paragraphs, button labels and hero banner of each page. Leave a field empty (or reset it) to use the original text.</p>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Editable fields</th>
                        <th>Edited</th>
                        <th style="width:120px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $key => $page)
                        <tr>
                            <td>{{ $page['label'] }}</td>
                            <td>{{ count($page['fields']) }}</td>
                            <td>{{ \App\Models\PageText::where('page', $key)->count() }}</td>
                            <td>
                                <a href="{{ route('page-texts.edit', $key) }}" class="btn btn-sm btn-info"><i class="icofont-edit"></i> Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

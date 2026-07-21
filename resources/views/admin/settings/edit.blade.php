@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Site Settings</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.update') }}" method="POST">
                @csrf

                <h5 class="mb-3 border-bottom pb-2">Contact Information</h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone Number(s)</label>

                        <div id="contact-wrapper">
                            @php $oldContacts = old('contacts', $setting->contacts ?: ['']); @endphp
                            @foreach($oldContacts as $contact)
                            <div class="input-group mb-2 contact-row">
                                <input type="text" name="contacts[]" class="form-control" placeholder="e.g. +91 97252 01620" value="{{ $contact }}">
                                <button type="button" class="btn btn-outline-danger remove-contact">×</button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-contact" class="btn btn-sm btn-secondary">+ Add Number</button>
                        @error('contacts.*') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email Address(es)</label>

                        <div id="email-wrapper">
                            @php $oldEmails = old('emails', $setting->emails ?: ['']); @endphp
                            @foreach($oldEmails as $email)
                            <div class="input-group mb-2 email-row">
                                <input type="email" name="emails[]" class="form-control" placeholder="e.g. sales@example.com" value="{{ $email }}">
                                <button type="button" class="btn btn-outline-danger remove-email">×</button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-email" class="btn btn-sm btn-secondary">+ Add Email</button>
                        @error('emails.*') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Head Office Address</label>
                        <textarea name="address" class="form-control" rows="5">{{ old('address', $setting->address) }}</textarea>
                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <hr>

                <h5 class="mb-3 border-bottom pb-2">Social Links</h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label"><i class="icofont-facebook text-primary"></i> Facebook</label>
                        <input type="text" name="facebook" class="form-control" placeholder="https://facebook.com/yourpage" value="{{ old('facebook', $setting->facebook) }}">
                        @error('facebook') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label"><i class="icofont-linkedin text-info"></i> LinkedIn</label>
                        <input type="text" name="linkedin" class="form-control" placeholder="https://linkedin.com/company/yourpage" value="{{ old('linkedin', $setting->linkedin) }}">
                        @error('linkedin') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label"><i class="icofont-instagram text-danger"></i> Instagram</label>
                        <input type="text" name="instagram" class="form-control" placeholder="https://instagram.com/yourpage" value="{{ old('instagram', $setting->instagram) }}">
                        @error('instagram') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <hr>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#add-contact').click(function () {
            var row = `
                <div class="input-group mb-2 contact-row">
                    <input type="text" name="contacts[]" class="form-control" placeholder="e.g. +91 97252 01620">
                    <button type="button" class="btn btn-outline-danger remove-contact">×</button>
                </div>`;
            $('#contact-wrapper').append(row);
        });

        $(document).on('click', '.remove-contact', function () {
            if ($('.contact-row').length > 1) {
                $(this).closest('.contact-row').remove();
            }
        });

        $('#add-email').click(function () {
            var row = `
                <div class="input-group mb-2 email-row">
                    <input type="email" name="emails[]" class="form-control" placeholder="e.g. sales@example.com">
                    <button type="button" class="btn btn-outline-danger remove-email">×</button>
                </div>`;
            $('#email-wrapper').append(row);
        });

        $(document).on('click', '.remove-email', function () {
            if ($('.email-row').length > 1) {
                $(this).closest('.email-row').remove();
            }
        });
    });
</script>
@endpush
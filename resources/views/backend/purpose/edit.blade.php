@extends('backend.layouts.app')
@section('title', 'Partner Edit')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/magnific-popup/magnific-popup.css">
@endpush
@section('content')

    <div class="row">
        <div class="col-xl-4 order-xl-0 m-auto">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        {{ __('messages.edit_purpose') }}
                    </h3>
                </div>
                <div class="block-content">
                    <form action="{{ route('purpose.update', $purpose->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.name') }} <small
                                    class="text-danger">*</small></label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name') ?? $purpose->name }}"
                                placeholder="{{ __('messages.name_placeholder') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">{{ __('messages.slug') }} <small
                                    class="text-danger">*</small></label>
                            <input type="text" id="slug" name="slug" class="form-control"
                                value="{{ old('slug') ?? $purpose->slug }}"
                                placeholder="{{ __('messages.slug_placeholder') }}">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <input type="hidden" id="purpose_id" value="{{ $purpose->id }}">
                        <div class="mt-5 mb-3 text-end">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('footer_scripts')
    <script>
        $(document).ready(function() {

            let ajaxRequest;

            $('#name').on('keyup', function() {

                let name = $(this).val();

                if (!name.trim()) {
                    $('#slug').val('');
                    return;
                }

                // Frontend slug generate
                let slug = name
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s]/g, '')
                    .replace(/\s+/g, '_');

                if (ajaxRequest) {
                    ajaxRequest.abort();
                }

                ajaxRequest = $.ajax({
                    url: "{{ route('purpose.check-slug') }}",
                    type: "POST",
                    data: {
                        slug: slug,
                        id: $('#purpose_id').val(), // Current Purpose ID
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#slug').val(response.slug);
                    }
                });

            });

        });
    </script>
@endpush

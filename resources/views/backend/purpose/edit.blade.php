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
                    <form action="{{ route('purpose.update',$purpose->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="purpose" class="form-label">{{ __('messages.purpose') }} <small class="text-danger">*</small></label>
                            <input type="text" id="purpose" name="purpose" class="form-control" value="{{old('purpose') ?? $purpose->purpose}}"
                                placeholder="{{ __('messages.purpose_placeholder') }}">
                            @error('purpose')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
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
    <script src="{{ asset('assets') }}/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script>
        One.helpersOnLoad(['jq-magnific-popup']);

        $(document).on('click', '.toggle-password', function() {

            let input = $('#password');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }

        });
    </script>
@endpush

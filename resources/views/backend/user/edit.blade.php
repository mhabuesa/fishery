@extends('backend.layouts.app')
@section('title', 'Partner Edit')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/magnific-popup/magnific-popup.css">
@endpush
@section('content')

    <div class="row">
        <div class="col-xl-8 order-xl-0 m-auto">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        {{ __('messages.edit_partner') }}
                    </h3>
                </div>
                <div class="block-content">
                    <form action="{{ route('partner.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.name') }} <small class="text-danger">*</small></label>
                            <input type="text" id="name" name="name" class="form-control" value="{{old('name') ?? $user->name}}"
                                placeholder="{{ __('messages.name_placeholder') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.email') }} <small class="text-danger">*</small></label>
                            <input type="text" id="email" name="email" class="form-control" value="{{old('email')?? $user->email}}"
                                placeholder="{{ __('messages.email_placeholder') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ __('messages.phone') }} <small class="text-danger">*</small></label>
                            <input type="phone" id="phone" name="phone" class="form-control" value="{{old('phone')?? $user->phone}}"
                                placeholder="{{ __('messages.phone_placeholder') }}">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">{{ __('messages.address') }}</label>
                            <input type="address" id="address" name="address" class="form-control" value="{{old('address')?? $user->address}}"
                                placeholder="{{ __('messages.address_placeholder') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nid" class="form-label">{{ __('messages.nid') }}</label>
                            <input type="text" id="nid" name="nid" class="form-control" value="{{old('nid')?? $user->nid}}"
                                placeholder="{{ __('messages.nid_placeholder') }}">
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">{{ __('messages.password') }}</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="{{ __('messages.password_edit_placeholder') }}">

                            <i class="fa fa-eye toggle-password"
                                style="position:absolute; right:10px; top:38px; cursor:pointer; font-size: 20px;"></i>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('messages.image') }}</label>

                            <input type="file" id="image" name="image" class="form-control" accept="image/*"
                                onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])">

                            <img id="previewImage" src="{{$user->image ? asset($user->image) : 'https://placehold.co/600x600'}}" width="150"
                                class="mt-4 d-block m-auto">
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

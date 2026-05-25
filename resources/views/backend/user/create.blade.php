@extends('backend.layouts.app')
@section('title', 'Partner Show')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/magnific-popup/magnific-popup.css">
@endpush
@section('content')

    <div class="row">
        <div class="col-xl-8 order-xl-0 m-auto">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                      {{ __('messages.add_partner') }}
                    </h3>
                     <a href="{{route('partner.index')}}" class="btn btn-alt-primary btn-sm"> <i class="fas fa-arrow-left "></i> Back </a>
                </div>
                <div class="block-content">
                    <form action="{{ route('partner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <small class="text-danger">*</small></label>
                            <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}"
                                placeholder="Enter Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                            <input type="text" id="email" name="email" class="form-control" value="{{old('email')}}"
                                placeholder="Enter Email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <small class="text-danger">*</small></label>
                            <input type="phone" id="phone" name="phone" class="form-control" value="{{old('phone')}}"
                                placeholder="Enter Phone">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="address" id="address" name="address" class="form-control" value="{{old('address')}}"
                                placeholder="Enter Address">
                        </div>
                        <div class="mb-3">
                            <label for="nid" class="form-label">NID</label>
                            <input type="text" id="nid" name="nid" class="form-control" value="{{old('nid')}}"
                                placeholder="Enter NID">
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password <small class="text-danger">*</small></label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter Password">

                            <i class="fa fa-eye toggle-password"
                                style="position:absolute; right:10px; top:38px; cursor:pointer; font-size: 20px;"></i>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>

                            <input type="file" id="image" name="image" class="form-control" accept="image/*"
                                onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])">

                            <img id="previewImage" src="https://placehold.co/600x600" width="150"
                                class="mt-4 d-block m-auto">
                        </div>
                        <div class="mt-5 mb-3 text-end">
                            <button class="btn btn-primary">Submit</button>
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

@extends('backend.layouts.app')
@section('title', 'Partners List')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 m-auto mt-2">
                <div class="block block-rounded">
                    <div class="block-header block-header-default d-block">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="block-title">Purpose List</h3>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full overflow-x-auto">
                        <div class="position-relative">
                            <table class="table table-bordered table-vcenter" id="purposeTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('messages.sl') }}</th>
                                        <th>{{ __('messages.purpose') }}</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($purposes as $key => $purpose)
                                        <tr>
                                            <td class="text-center fs-sm">{{ $key + 1 }}</td>
                                            <td class="fw-semibold fs-sm">{{ $purpose->purpose }}</td>
                                            <td class="text-center">
                                                <div class="d-flex">
                                                    <a href="{{ route('purpose.edit', $purpose->id) }}"
                                                        class="btn btn-sm btn-alt-success">
                                                        <i class="fa fa-edit text-secondary"></i>
                                                    </a>
                                                        <button type="button" class="btn btn-sm btn-alt-danger ms-2"
                                                            onclick="deletePurpose(this)" data-id="{{ $purpose->id }}"><i
                                                                class="fa fa-trash text-danger"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 m-auto mt-2">
                <div class="block block-rounded">
                    <div class="block-header block-header-default d-block">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="block-title">Add Purpose</h3>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full overflow-x-auto">
                        <div class="position-relative">
                            <form action="{{ route('purpose.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="purpose" class="form-label">Purpose <small
                                            class="text-danger">*</small></label>
                                    <input type="text" id="purpose" name="purpose" class="form-control"
                                        value="{{ old('purpose') }}" placeholder="Enter Purpose">
                                    @error('purpose')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                               
                                <div class="mt-2 text-end">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

@endsection
@push('footer_scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets') }}/js/plugins/datatables/dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/js/pages/be_tables_datatables.min.js"></script>

    <script>
        $('#purposeTable').DataTable();
    </script>
    <script>
        function deletePurpose(button) {
            const id = $(button).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "This Purpose Delete Permanently.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f97316",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('purpose.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data) {
                            if (data.success) {
                                showToast(data.message, "success");
                                $(button).closest('tr').remove();
                            } else {
                                showToast(data.message, "error");
                            }
                        },
                        error: function(xhr) {
                            showToast("An error occurred: " + xhr.responseJSON.message, "error");
                        }
                    });
                }
            });
        }
    </script>
@endpush

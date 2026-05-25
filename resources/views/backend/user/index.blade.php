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
            <div class="col-lg-12 m-auto mt-2">
                <div class="block block-rounded">
                    <div class="block-header block-header-default d-block">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="block-title">{{ __('messages.partners_list') }}</h3>
                            </div>
                            <div class="col-lg-6 text-center text-lg-end">
                                <div class="block-options space-x-1 md_mt-2 p-0">
                                    <a href="{{ route('partner.create') }}" class="btn btn-sm btn-primary"> <i
                                            class="fas fa-plus"></i> {{ __('messages.add_partner') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full overflow-x-auto">
                        <div class="position-relative">
                            <table class="table table-bordered table-vcenter" id="userTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('messages.sl') }}</th>
                                        <th>{{ __('messages.name') }}</th>
                                        <th>{{ __('messages.email') }}</th>
                                        <th>{{ __('messages.action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($users as $key => $user)
                                        <tr>
                                            <td class="text-center fs-sm">{{ $key + 1 }}</td>
                                            <td class="fw-semibold fs-sm"> <img src="{{ asset($user->image) }}"
                                                    class="productNameImage" width="50" alt="">
                                                {{ $user->name }}</td>
                                            <td class="fw-semibold fs-sm">{{ $user->email }}</td>
                                            <td class="text-center">
                                                <div class="d-flex">
                                                    <a href="{{ route('partner.show', $user->id) }}"
                                                        class="border-0 btn btn-sm">
                                                        <i class="fa fa-eye text-success fa-xl"></i>
                                                    </a>
                                                    <a href="{{ route('partner.edit', $user->id) }}"
                                                        class="border-0 btn btn-sm">
                                                        <i class="fa fa-pencil text-secondary fa-xl"></i>
                                                    </a>
                                                    @if (auth()->user()->id != $user->id)
                                                        <button type="button" class="border-0 btn btn-sm"
                                                            onclick="deleteUser(this)" data-id="{{ $user->id }}"><i
                                                                class="fa fa-trash text-danger fa-xl"></i></button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Product Found!</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>

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
        $('#userTable').DataTable();
    </script>
    <script>
        function deleteUser(button) {
            const id = $(button).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "This User Delete Permanently.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f97316",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('partner.destroy', ':id') }}";
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

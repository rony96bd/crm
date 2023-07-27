@extends('admin.layouts.app')
@section('panel')
    <section style="background-color: #eee; border-radius: 10px;">
        <div class="container py-3">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ getImage('assets/user/images/profile/' . $user->image ?? '', imagePath()['user']['size']) }}"
                                alt="@lang('Image')" class="rounded-circle img-fluid" style="width: 120px;">
                            <h5 class="my-3">{{ __($user->name) }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Profile Status</p>
                                </div>
                                <div class="col-sm-9">
                                    @if ($user->status == 1)
                                        <span class="badge badge--success font-weight-bold">@lang('Profile is Actived')</span>
                                    @elseif($user->status == 2)
                                        <span class="badge badge--danger font-weight-bold">@lang('Profile is Banned')</span>
                                    @else
                                        <span class="badge badge--primary font-weight-bold">@lang('Pending for Admin Approval.')</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($user->name) }}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($user->email) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Phone Number</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($user->phone) }}</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('breadcrumb-plugins')
    {{-- <a href="{{ url('admin/student/exportpdf/' . $donor->id . '/generate') }}"
        class="btn btn-sm btn-primary box--shadow1 text--small"><i class="las la-file-pdf"></i>@lang('Export to PDF')</a> --}}

    <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker({
                    autoClose: true,
                    dateFormat: 'yyyy-mm-dd',
                });
            }
        })(jQuery)
    </script>
@endpush

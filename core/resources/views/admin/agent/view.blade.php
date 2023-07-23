@extends('admin.layouts.app')
@section('panel')
    <section style="background-color: #eee; border-radius: 10px;">
        <div class="container py-3">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ getImage('assets/images/agent/' . $agent->image ?? '', imagePath()['agent']['size']) }}"
                                alt="@lang('Image')" class="rounded-circle img-fluid" style="width: 120px;">
                            <h5 class="my-3">{{ __($agent->name) }} </h5>
                            <p class="text-muted mb-4">@lang('Designation') : {{ __($agent->designation) }} </p>
                            <p class="text-muted mb-4">@lang('Company') : {{ __($agent->company) }} </p>
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
                                    @if ($agent->status == 1)
                                        <span class="badge badge--success font-weight-bold">@lang('Profile is Actived')</span>
                                    @elseif($agent->status == 2)
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
                                    <p class="text-muted mb-0"></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Phone Number</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">WhatsApp Number</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">English Test</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">

                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Overall Score</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Low Score</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Country</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Qualification</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Course Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('breadcrumb-plugins')
    <a href="{{ route('admin.donor.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush


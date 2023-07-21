@extends('student.layouts.app')
@section('panel')
    @if (@json_decode($general->sys_version)->version > systemDetails()['version'])
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title"> @lang('New Version Available') <button class="btn btn--dark float-right">@lang('Version')
                                {{ json_decode($general->sys_version)->version }}</button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark">@lang('What is the Update ?')</h5>
                        <pre class="f-size--24">{{ json_decode($general->sys_version)->details }}</pre>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (@json_decode($general->sys_version)->message)
        <div class="row">
            @foreach (json_decode($general->sys_version)->message as $msg)
                <div class="col-md-12">
                    <div class="alert border border--primary" role="alert">
                        <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
                        <p class="alert__message">@php echo $msg; @endphp</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Dashboard User Information ----------------------------------------- --}}
    <section style="background-color: #eee; border-radius: 10px;">
        <div class="container py-3">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ getImage('assets/images/donor/' . $donor->image ?? '', imagePath()['donor']['size']) }}"
                                alt="@lang('Image')" class="rounded-circle img-fluid" style="width: 120px;">
                            <h5 class="my-3">{{ __($donor->firstname) }} {{ __($donor->lastname) }}</h5>
                            <p class="text-muted mb-4">@lang('Location') : {{ __($donor->country) }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary"
                                    onclick="window.location.href = '{{ route('student.profile') }}';">Apply Now</button>
                            </div>
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
                                    @if ($donor->status == 1)
                                        <span class="badge badge--success font-weight-bold">@lang('Your Profile is Actived')</span>
                                    @elseif($donor->status == 2)
                                        <span class="badge badge--danger font-weight-bold">@lang('Your Profile is Banned')</span>
                                    @elseif ($donor->status == 4)
                                        <span class="badge badge--danger font-weight-bold">@lang('Need to Apply')</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($donor->firstname) }} {{ __($donor->lastname) }}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($donor->email) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Phone Number</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($donor->phone) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">WhatsApp Number</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($donor->whatsapp) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">English Test</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">

                                        @php
                                            $engtestview = '';
                                            $engtests = json_decode($donor->engtest);

                                            foreach ($engtests as $engtest) {
                                                $engtestview .= $engtest. ', ';
                                            }
                                            $engtestview = rtrim($engtestview,', '); 
                                            echo $engtestview;                                   
                                        @endphp

                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Overall Score</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($donor->score_overall) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Low Score</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($donor->low_score) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Country</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($donor->country) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Qualification</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($donor->qualification) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Course Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ __($donor->course) }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0 font-weight-bold">Submited Document</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><span style="color:red;">Passport:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">CV:</span> <a target="_blank"
                                            href="../assets/files/student/{{ __($donor->file2) }}">{{ __($donor->file2) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">English Test Report:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file3) }}">{{ __($donor->file3) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">10th Certificate:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file4) }}">{{ __($donor->file4) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">12th Certificate:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file5) }}">{{ __($donor->file5) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Degree Certificate:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file6) }}">{{ __($donor->file6) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Masters Certificate:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file7) }}">{{ __($donor->file7) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">10th Transcript:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file8) }}">{{ __($donor->file8) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">12th Transcript:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file9) }}">{{ __($donor->file9) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Degree Transcript:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file10) }}">{{ __($donor->file10) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Masters Transcript:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file11) }}">{{ __($donor->file11) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Evidence of work:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file12) }}">{{ __($donor->file12) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Other Documents:</span> <a
                                            target="_blank"
                                            href="../assets/files/student/{{ __($donor->file13) }}">{{ __($donor->file13) }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('script')
    <script>
        'use strict';
        $('.approved').on('click', function() {
            var modal = $('#approvedby');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
        $('.cancel').on('click', function() {
            var modal = $('#cancelBy');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
    </script>
@endpush

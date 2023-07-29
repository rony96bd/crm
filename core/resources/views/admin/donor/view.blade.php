@extends('admin.layouts.app')
@section('panel')
    <section style="background-color: #eee; border-radius: 10px;">
        <div class="container py-3">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ getImage('assets/images/donor/' . $donor->image ?? '', imagePath()['donor']['size']) }}"
                                alt="@lang('Image')" class="rounded-circle img-fluid" style="width: 120px;">
                            <h5 class="my-3">{{ __($donor->firstname) }} {{ __($donor->lastname) }}</h5>
                            <span class="text-muted mb-4">@lang('Student ID') : {{ __($donor->username) }}</span>
                            <p class="text-muted mb-4">@lang('Location') : {{ __($donor->country) }} </p>
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
                                        <span class="badge badge--success font-weight-bold">@lang('Profile is Actived')</span>
                                    @elseif($donor->status == 2)
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
                                                $engtestview .= $engtest . ', ';
                                            }
                                            $engtestview = rtrim($engtestview, ', ');
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
                                    <p class="mb-0 font-weight-bold">Submitted Documents</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><span style="color:red;">Passport:</span> <a target="_blank"
                                            href="/assets/files/student/{{ __($donor->file) }}">{{ __($donor->file) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">CV:</span> <a target="_blank"
                                            href="/assets/files/student/{{ __($donor->file2) }}">{{ __($donor->file2) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">English Test Report:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file3) }}">{{ __($donor->file3) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">10th Certificate:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file4) }}">{{ __($donor->file4) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">12th Certificate:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file5) }}">{{ __($donor->file5) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Degree Certificate:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file6) }}">{{ __($donor->file6) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Masters Certificate:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file7) }}">{{ __($donor->file7) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">10th Transcript:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file8) }}">{{ __($donor->file8) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">12th Transcript:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file9) }}">{{ __($donor->file9) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Degree Transcript:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file10) }}">{{ __($donor->file10) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Masters Transcript:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file11) }}">{{ __($donor->file11) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Evidence of work:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file12) }}">{{ __($donor->file12) }}</a>
                                    </p>
                                    <p class="text-muted mb-0"><span style="color:red;">Other Documents:</span> <a
                                            target="_blank"
                                            href="/assets/files/student/{{ __($donor->file13) }}">{{ __($donor->file13) }}</a>
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
@push('breadcrumb-plugins')

    <a href="{{ url('admin/student/exportpdf/'.$donor->id.'/generate') }}" class="btn btn-sm btn-primary box--shadow1 text--small"><i
            class="las la-file-pdf"></i>@lang('Export to PDF')</a>

    <a href="{{ route('admin.donor.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
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

            $('select[name=city]').change(function() {
                $('select[name=location]').html(
                    '<option value="" selected="" disabled="">@lang('Select One')</option>');
                var locations = $('select[name=city] :selected').data('locations');
                var html = '';
                locations.forEach(function myFunction(item, index) {
                    if (item.id == {{ $donor->location_id }}) {
                        html += `<option value="${item.id}" selected>${item.name}</option>`
                    } else {
                        html += `<option value="${item.id}">${item.name}</option>`
                    }
                });
                $('select[name=location]').append(html);
            }).change();
        })(jQuery)
    </script>
@endpush

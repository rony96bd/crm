@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . 'partials.breadcrumb')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close"
                        data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>

    <section class="pt-100 pb-100 position-relative z-index section--bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('apply.donor.store') }}"
                        class="contact-form bg-white p-sm-5 p-3 rounded-3 position-relative" enctype="multipart/form-data">
                        @csrf
                        <h5 class="mb-3">@lang('Personal Information')</h5>
                        <div class="row mb-4">
                            <div class="form-group col-lg-6">
                                <label for="name">@lang('Full Name') <sup class="text--danger">*</sup></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    placeholder="@lang('Full Name')" class="form--control" maxlength="80" required="">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="designation">@lang('Designation') <sup class="text--danger">*</sup></label>
                                <input type="text" name="designation" id="designation" value="{{ old('designation') }}"
                                    placeholder="@lang('Designation')" class="form--control" maxlength="40" required="">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="username">@lang('Username') <sup class="text--danger">*</sup></label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}"
                                    placeholder="@lang('User name')" class="form--control" maxlength="40" required="">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email">@lang('Email') <sup class="text--danger">*</sup></label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    placeholder="@lang('Enter Email')" class="form--control" maxlength="60" required="">
                            </div>
                            <!--password-->
                            <div class="form-group col-lg-6">
                                <label for="password">@lang('Password') <sup class="text--danger">*</sup></label>
                                <input type="password" name="password" id="password" value="{{ old('password') }}"
                                    placeholder="@lang('Enter Password')" class="form--control" maxlength="60" required="">
                            </div>
                            <!--confirm password -->
                            <div class="form-group col-lg-6">
                                <label for="password_confirmation">@lang('Confirm Password') <sup
                                        class="text--danger">*</sup></label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    value="{{ old('password_confirmation') }}" placeholder="@lang('Enter Confirm Password')"
                                    class="form--control" maxlength="60" required="">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="phone">@lang('Phone') <sup class="text--danger">*</sup></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                    placeholder="@lang('Enter Phone Number')" class="form--control" maxlength="40" required="">
                                <span id="errorMsg" style="display:none; color: red;">Please Enter Valid Phone
                                    Number</span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="company">@lang('Company Name') <sup class="text--danger">*</sup></label>
                                <input type="text" name="company" id="company" value="{{ old('company') }}"
                                    placeholder="@lang('Company Name')" class="form--control" maxlength="40" required="">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="country">@lang('Country') <sup class="text--danger">*</sup></label>
                                <select name="country" id="country" class="select" required="">
                                    <option value="" selected="" disabled="">@lang('Select One')</option>
                                    <option value="Bangladesh">@lang('Bangladesh')</option>
                                    <option value="India">@lang('India')</option>
                                    <option value="Pakisthan">@lang('Pakisthan')</option>
                                    <option value="Nigeria">@lang('Nigeria')</option>
                                    <option value="Ghana">@lang('Ghana')</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="city">@lang('City') <sup class="text--danger">*</sup></label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}"
                                    placeholder="@lang('City')" class="form--control" maxlength="40" required="">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="website">@lang('Website') <sup class="text--danger">*</sup></label>
                                <input type="text" name="website" id="website" value="{{ old('website') }}"
                                    placeholder="@lang('Website')" class="form--control" maxlength="40" required="">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="file">@lang('Profile Photo') <sup class="text--danger">*</sup></label>
                                <input type="file" id="file" name="image" class="form--control custom-file-upload" required="">
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" class="btn btn--base w-100">@lang('Apply Now')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- @include($activeTemplate.'sections.faq') --}}
@endsection


@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/datepicker.min.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/datepicker.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.datepicker-here').datepicker({
                autoClose: true,
                dateFormat: 'yyyy-mm-dd',
            });

            $('select[name=city]').on('change', function() {
                $('select[name=location]').html(
                    '<option value="" selected="" disabled="">@lang('Select One')</option>');
                var locations = $('select[name=city] :selected').data('locations');
                var html = '';
                locations.forEach(function myFunction(item, index) {
                    html += `<option value="${item.id}">${item.name}</option>`
                });
                $('select[name=location]').append(html);
            });
        })(jQuery)
    </script>
@endpush

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
                                <label for="firstname">@lang('First Name (as appears in passport)') <sup class="text--danger">*</sup></label>
                                <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}"
                                    placeholder="@lang('First name')" class="form--control" maxlength="80" required="">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="lastname">@lang('Last Name (as appears in passport)') <sup class="text--danger">*</sup></label>
                                <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}"
                                    placeholder="@lang('Last Name')" class="form--control" maxlength="80" required="">
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
                                <label for="whatsapp">@lang('WhatsApp Number') <sup class="text--danger">*</sup></label>
                                <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}"
                                    placeholder="@lang('Enter WhatsApp Number')" class="form--control" maxlength="40"
                                    required="">
                                <span id="errorMsg" style="display:none; color: red;">Please Enter Valid Phone
                                    Number</span>
                            </div>
                            {{-- <div class="form-group col-lg-12">
                                <label for="eng-test">@lang('English Test taken') <sup class="text--danger">*</sup></label><br />
                                <input class="form-check-input" type="checkbox" name="ielts" value="IELTS"
                                    name="ielts" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">IELTS</label><br />
                                <input class="form-check-input" type="checkbox" name="pte" value="PTE"
                                    name="pte" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">PTE</label><br />
                                <input class="form-check-input" type="checkbox" name="duolingo" value="Duolingo"
                                    name="duolingo" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Duolingo</label><br />
                                <input class="form-check-input" type="checkbox" name="oeitc" value="OEITC"
                                    name="oeitc" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">OEITC</label><br />
                                <input class="form-check-input" type="checkbox" name="none" value="None of the Above"
                                    name="none" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">None of the Above</label>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="score_overall">@lang('Score Overall') <sup class="text--danger">*</sup></label>
                                <input type="text" name="score_overall" id="score_overall"
                                    value="{{ old('score_overall') }}" placeholder="@lang('Score Overall')"
                                    class="form--control" maxlength="255" required="">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="low_score">@lang('Low Score') <sup class="text--danger">*</sup></label>
                                <input type="text" name="low_score" id="low_score" value="{{ old('low_score') }}"
                                    placeholder="@lang('Low Score')" class="form--control" maxlength="255"
                                    required="">
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
                                <label for="qualification">@lang('Highest Qualification') <sup class="text--danger">*</sup></label>
                                <select name="qualification" id="qualification" class="select" required="">
                                    <option value="" selected="" disabled="">@lang('Select One')</option>
                                    <option value="10th Grade/SSC/Secondary/O Level/GCSE">@lang('10th Grade/SSC/Secondary/O Level/GCSE')</option>
                                    <option value="12th Grade/HSC/Senior Secondary/A Level">@lang('12th Grade/HSC/Senior Secondary/A Level')</option>
                                    <option value="Bachelors Degree">@lang('Bachelors Degree')</option>
                                    <option value="Masters Degree">@lang('Masters Degree')</option>
                                    <option value="Other">@lang('Other')</option>

                                </select>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="course">@lang('What Course would you like to apply for?') <sup class="text--danger">*</sup></label>
                                <input type="text" name="course" id="course" value="{{ old('course') }}"
                                    placeholder="@lang('Write Course Name')" class="form--control" maxlength="255"
                                    required="">
                            </div> --}}

                            <div class="form-group col-lg-6">
                                <label for="file">@lang('Profile Photo') <sup class="text--danger">*</sup></label>
                                <input type="file" id="file" name="image" class="form--control custom-file-upload" required="">
                            </div>
                            <hr>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn--base w-50">@lang('Sign Up')</button>
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

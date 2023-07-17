@extends('student.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-12 col-lg-8 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-25 border-bottom pb-2">{{ __($donor->firstname) }} {{ __($donor->lastname) }}'s @lang('Profile Information')</h5>
                    UserName: {{ __($donor->username) }}<br/>
                    Email: {{ $donor->email }}
                    <br/> <br/>

                    <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                    style="background-image: url({{ getImage('assets/images/donor/' . $donor->image, imagePath()['donor']['size']) }})">
                                                    <button type="button" class="remove-image"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image"
                                                    id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'),
                                                        @lang('jpg').</b> @lang('Image will be resized into 400x400px') </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Name')</label>
                                    <input class="form-control" type="text" name="name"
                                        value="{{ auth()->guard('donor')->user()->firstname }} {{ auth()->guard('donor')->user()->lastname }}">
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Phone')</label>
                                    <input class="form-control" type="text" name="phone"
                                        value="{{ auth()->guard('donor')->user()->phone }}">
                                </div>

                                <div class="form-group ">
                                    <label for="blood" class="font-weight-bold">@lang('Blood Group')</label>
                                    <select name="blood" id="blood" class="form-control form-control" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        @foreach ($bloods as $blood)
                                            <option value="{{ $blood->id }}"
                                                @if ($blood->id == $donor->blood_id) selected @endif>{{ __($blood->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="city" class="font-weight-bold">@lang('City')</label>
                                    <select name="city" id="city" class="form-control form-control" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                data-locations="{{ json_encode($city->location) }}"
                                                @if ($city->id == $donor->city_id) selected @endif>{{ __($city->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="location" class="font-weight-bold">@lang('Location')</label>
                                    <select name="location" id="location" class="form-control form-control" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="gender" class="font-weight-bold">@lang('Gender')</label>
                                    <select name="gender" id="gender" class="form-control form-control" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        <option value="1" @if ($donor->gender == 1) selected @endif>
                                            @lang('Male')</option>
                                        <option value="2" @if ($donor->gender == 2) selected @endif>
                                            @lang('Female')</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="facebook"
                                        class="form-control-label font-weight-bold">@lang('Facebook Url')</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="facebook" class="form-control form-control-lg"
                                            value="{{ @$donor->socialMedia->facebook }}" placeholder="@lang('Enter Facebook Url')"
                                            name="facebook" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="lab la-facebook-f"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="twitter"
                                        class="form-control-label font-weight-bold">@lang('Twitter Url')</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="twitter" value="{{ @$donor->socialMedia->twitter }}"
                                            class="form-control form-control-lg" placeholder="@lang('Enter Twitter Url')"
                                            name="twitter" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="lab la-twitter"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="linkedinIn"
                                        class="form-control-label font-weight-bold">@lang('LinkedinIn Url')</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="linkedinIn"
                                            value="{{ @$donor->socialMedia->linkedinIn }}"
                                            class="form-control form-control-lg" placeholder="@lang('Enter LinkedinIn Url')"
                                            name="linkedinIn" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="lab la-linkedin-in"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="instagram"
                                        class="form-control-label font-weight-bold">@lang('Instagram Url')</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="instagram"
                                            value="{{ @$donor->socialMedia->instagram }}"
                                            class="form-control form-control-lg" placeholder="@lang('Enter Instagram Url')"
                                            name="instagram" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="lab la-instagram"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="profession" class="font-weight-bold">@lang('Profession')</label>
                                    <input type="text" name="profession" id="profession"
                                        value="{{ $donor->profession }}" class="form-control form-control-lg"
                                        placeholder="@lang('Enter Profession')" maxlength="80" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="religion" class="font-weight-bold">@lang('Religion')</label>
                                    <input type="text" id="religion" name="religion" value="{{ $donor->religion }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Religion')"
                                        maxlength="40" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address" class="font-weight-bold">@lang('Address')</label>
                                    <input type="text" name="address" id="address" value="{{ $donor->address }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Address')"
                                        maxlength="255" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="donate" class="font-weight-bold">@lang('Total Donate')</label>
                                    <input type="text" id="donate" name="donate"
                                        value="{{ $donor->total_donate }}" class="form-control form-control-lg"
                                        placeholder="@lang('Enter Total Blood Donate')">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="birth_date" class="font-weight-bold">@lang('Date Of Birth')</label>
                                    <input type="text" name="birth_date" id="birth_date"
                                        value="{{ showDateTime($donor->birth_date, 'Y-m-d') }}" data-language="en"
                                        class="form-control form-control-lg datepicker-here"
                                        placeholder="@lang('Enter Date Of Birth')" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last_donate" class="font-weight-bold">@lang('Last Donate')</label>
                                    <input type="text" name="last_donate" id="last_donate"
                                        value="@if ($donor->last_donate != null){{ showDateTime($donor->last_donate, 'Y-m-d') }}@endif" data-language="en"
                                        class="form-control form-control-lg datepicker-here"
                                        placeholder="@lang('Enter Last Donate Date')">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="details" class="font-weight-bold">@lang('About Donor')</label>
                                    <textarea name="details" id="details" class="form-control form-control-lg" placeholder="@lang('Enter About Donor')">{{ $donor->details }}</textarea>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('student.password') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="fa fa-key"></i>@lang('Password Setting')</a>
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

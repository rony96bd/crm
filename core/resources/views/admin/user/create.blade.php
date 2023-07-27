@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                    style="height: 350px; background-image: url({{ getImage(imagePath()['user']['path'], imagePath()['user']['size']) }})">
                                                    <button type="button" class="remove-image"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image"
                                                    id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'),
                                                        @lang('jpg')</b>. @lang('Image will be resized into')
                                                    {{ imagePath()['user']['size'] }}@lang('px'). </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="firstname" class="font-weight-bold">@lang('First Name')</label>
                                    <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter First Name')" maxlength="80"
                                        required="">
                                </div>

                                <div class="form-group">
                                    <label for="lastname" class="font-weight-bold">@lang('Last Name')</label>
                                    <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Last Name')" maxlength="80"
                                        required="">
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="font-weight-bold">@lang('Phone Number')</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Phone Number')" maxlength="80"
                                        required="">
                                </div>

                                <div class="form-group">
                                    <label for="whatsapp" class="font-weight-bold">@lang('WhatsApp Number')</label>
                                    <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter WhatsApp Number')" maxlength="80"
                                        required="">
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('English Test taken')<sup
                                            class="text--danger">*</sup></label>
                                    <div style="margin-left: 20px">
                                        <input class="form-check-input" type="checkbox" name="engtest[]" value="IELTS"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">IELTS</label><br />
                                        <input class="form-check-input" type="checkbox" name="engtest[]" value="PTE"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">PTE</label><br />
                                        <input class="form-check-input" type="checkbox" name="engtest[]" value="Duolingo"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">Duolingo</label><br />
                                        <input class="form-check-input" type="checkbox" name="engtest[]" value="OEITC"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">OEITC</label><br />
                                        <input class="form-check-input" type="checkbox" name="engtest[]"
                                            value="None of the Above" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">None of the Above</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="score_overall" class="font-weight-bold">@lang('Score Overall')</label>
                                    <input type="text" name="score_overall" id="score_overall"
                                        value="{{ old('score_overall') }}" class="form-control form-control-lg"
                                        placeholder="@lang('Enter Score Overall')" maxlength="80" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="low_score" class="font-weight-bold">@lang('Low Score')</label>
                                    <input type="text" name="low_score" id="low_score" value="{{ old('low_score') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Lowest Score')"
                                        maxlength="80" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="country" class="font-weight-bold">@lang('Country')</label>
                                    <select name="country" id="country" class="form-control form-control-lg"
                                        required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        <option value="Bangladesh">@lang('Bangladesh')</option>
                                        <option value="India">@lang('India')</option>
                                        <option value="Pakisthan">@lang('Pakisthan')</option>
                                        <option value="Nigeria">@lang('Nigeria')</option>
                                        <option value="Ghana">@lang('Ghana')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="qualification" class="font-weight-bold">@lang('Highest Qualification')</label>
                                    <select name="qualification" id="qualification" class="form-control form-control-lg"
                                        required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        <option value="10th Grade/SSC/Secondary/O Level/GCSE">@lang('10th Grade/SSC/Secondary/O Level/GCSE')</option>
                                        <option value="12th Grade/HSC/Senior Secondary/A Level">@lang('12th Grade/HSC/Senior Secondary/A Level')</option>
                                        <option value="Bachelors Degree">@lang('Bachelors Degree')</option>
                                        <option value="Masters Degree">@lang('Masters Degree')</option>
                                        <option value="Other">@lang('Other')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">@lang('Email')</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Email')"
                                        maxlength="60" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="course" class="font-weight-bold">@lang('What Course would you like to apply for?')</label>
                                    <input type="course" id="course" name="course" value="{{ old('course') }}"
                                        class="form-control form-control-lg" placeholder="@lang('What Course Student like to apply for?')"
                                        maxlength="60" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="form-control-label font-weight-bold" for="file">@lang('Upload Document')
                                <sup class="text--danger">*</sup></label><br>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        Passport:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file" name="file"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        CV:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file2" name="file2"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        English Test Report:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file3" name="file3"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        10th Certificate:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file4" name="file4"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        12th Certificate:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file5" name="file5"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        Degree Certificate:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file6" name="file6"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        Masters Certificate:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file7" name="file7"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        10th Transcript:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file8" name="file8"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        12th Transcript:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file9" name="file9"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        Degree Transcript:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file10" name="file10"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        Masters Transcript:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file11" name="file11"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        Evidence of work:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file12" name="file12"
                                            class="form--control custom-file-upload"><br>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        Other Documents:
                                    </div>
                                    <div class="col">
                                        <input type="file" id="file13" name="file13"
                                            class="form--control custom-file-upload">
                                    </div>
                                </div>
                            </div>
                            <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block btn-lg"><i
                                    class="fa fa-fw fa-paper-plane"></i> @lang('Apply Now')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{ route('agent.user.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        "use strict";
        $('.datepicker-here').datepicker({
            autoClose: true,
            dateFormat: 'yyyy-mm-dd',
        });

        $('select[name=city]').on('change', function() {
            $('select[name=location]').html('<option value="" selected="" disabled="">@lang('Select One')</option>');
            var locations = $('select[name=city] :selected').data('locations');
            var html = '';
            locations.forEach(function myFunction(item, index) {
                html += `<option value="${item.id}">${item.name}</option>`
            });
            $('select[name=location]').append(html);
        });
    </script>
@endpush

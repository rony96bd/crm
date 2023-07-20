@extends('student.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-12 col-lg-8 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-25 border-bottom pb-2">{{ __($donor->firstname) }} {{ __($donor->lastname) }}'s
                        @lang('Profile Information')</h5>
                    UserName: {{ __($donor->username) }}<br />
                    Email: {{ $donor->email }}
                    <br /> <br />

                    <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                    style="height: 250px; background-image: url({{ getImage('assets/images/donor/' . $donor->image, imagePath()['donor']['size']) }})">
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
                            <div class="col-md-8">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Name')</label>
                                    <input class="form-control" type="text" name="firstname"
                                        value="{{ auth()->guard('donor')->user()->firstname }}">
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Name')</label>
                                    <input class="form-control" type="text" name="lastname"
                                        value="{{ auth()->guard('donor')->user()->lastname }}">
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Phone')</label>
                                    <input class="form-control" type="text" name="phone"
                                        value="{{ auth()->guard('donor')->user()->phone }}">
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('WhatsApp')</label>
                                    <input class="form-control" type="text" name="whatsapp"
                                        value="{{ auth()->guard('donor')->user()->whatsapp }}">
                                </div>

                                @php
                                    $engtests = json_decode($donor->engtest);
                                @endphp

                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('English Test taken')<sup
                                            class="text--danger">*</sup></label>
                                    <div style="margin-left: 20px">
                                        <input class="form-check-input" type="checkbox" name="engtest[]" value="IELTS"
                                            id="flexCheckDefault" {{ in_array('IELTS', $engtests)? 'checked':'' }}>
                                        <label class="form-check-label" for="flexCheckDefault">IELTS</label><br />
                                        <input class="form-check-input" type="checkbox" name="engtest[]" value="PTE"
                                            id="flexCheckDefault" {{ in_array('PTE', $engtests)? 'checked':'' }}>
                                        <label class="form-check-label" for="flexCheckDefault">PTE</label><br />
                                        <input class="form-check-input" type="checkbox" name="engtest[]" value="Duolingo"
                                            id="flexCheckDefault" {{ in_array('Duolingo', $engtests)? 'checked':'' }}>
                                        <label class="form-check-label" for="flexCheckDefault">Duolingo</label><br />
                                        <input class="form-check-input" type="checkbox" name="engtest[]" value="OEITC"
                                            id="flexCheckDefault" {{ in_array('OEITC', $engtests)? 'checked':'' }}>
                                        <label class="form-check-label" for="flexCheckDefault">OEITC</label><br />
                                        <input class="form-check-input" type="checkbox" name="engtest[]"
                                            value="None of the Above" id="flexCheckDefault" {{ in_array('None of the Above', $engtests)? 'checked':'' }}>
                                        <label class="form-check-label" for="flexCheckDefault">None of the Above</label>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"
                                        for="score_overall">@lang('Score Overall') <sup class="text--danger">*</sup></label>
                                    <input class="form-control" type="text" name="score_overall"
                                        value="{{ __($donor->score_overall) }}">
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold" for="low_score">@lang('Low Score')
                                        <sup class="text--danger">*</sup></label>
                                    <input class="form-control" type="text" name="low_score"
                                        value="{{ __($donor->low_score) }}">
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold" for="country">@lang('Country')
                                        <sup class="text--danger">*</sup></label>
                                    <select name="country" id="country" class="select" required="">
                                        <option value="{{ __($donor->country) }}" selected="">
                                            {{ __($donor->country) }}</option>
                                        <option value="Bangladesh">@lang('Bangladesh')</option>
                                        <option value="India">@lang('India')</option>
                                        <option value="Pakisthan">@lang('Pakisthan')</option>
                                        <option value="Nigeria">@lang('Nigeria')</option>
                                        <option value="Ghana">@lang('Ghana')</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold"
                                        for="qualification">@lang('Highest Qualification') <sup class="text--danger">*</sup></label>
                                    <select name="qualification" id="qualification" class="select" required="">
                                        <option value="{{ __($donor->qualification) }}" selected="">
                                            {{ __($donor->qualification) }}</option>
                                        <option value="10th Grade/SSC/Secondary/O Level/GCSE">@lang('10th Grade/SSC/Secondary/O Level/GCSE')</option>
                                        <option value="12th Grade/HSC/Senior Secondary/A Level">@lang('12th Grade/HSC/Senior Secondary/A Level')</option>
                                        <option value="Bachelors Degree">@lang('Bachelors Degree')</option>
                                        <option value="Masters Degree">@lang('Masters Degree')</option>
                                        <option value="Other">@lang('Other')</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold" for="course">@lang('What Course would you like to apply for?')
                                        <sup class="text--danger">*</sup></label>
                                    <input class="form-control" type="text" name="course"
                                        value="{{ __($donor->course) }}">
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold" for="file">@lang('Upload Document')
                                        <sup class="text--danger">*</sup></label><br>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                Passport: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file) }}</a>
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
                                                CV: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file2) }}</a>
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
                                                English Test Report: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file3) }}</a>
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
                                                10th Certificate: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file4) }}</a>
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
                                                12th Certificate: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file5) }}</a>
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
                                                Degree Certificate: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file6) }}</a>
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
                                                Masters Certificate: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file7) }}</a>
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
                                                10th Transcript: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file8) }}</a>
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
                                                12th Transcript: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file9) }}</a>
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
                                                Degree Transcript: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file10) }}</a>
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
                                                Masters Transcript: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file11) }}</a>
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
                                                Evidence of work: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file12) }}</a>
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
                                                Other Documents: <a target="_blank" href="../assets/files/student/{{ __($donor->file) }}">{{ __($donor->file13) }}</a>
                                            </div>
                                            <div class="col">
                                                <input type="file" id="file13" name="file13"
                                                    class="form--control custom-file-upload">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn--primary btn-block btn-lg">@lang('Save Changes')</button>
                                    </div>
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

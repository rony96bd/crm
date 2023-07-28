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
                                    <label for="name" class="font-weight-bold">@lang('Name')</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Name')" maxlength="80"
                                        required="">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">@lang('Email')</label>
                                    <input type="text" name="email" id="email" value="{{ old('email') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Email')" maxlength="80"
                                        required="">
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="font-weight-bold">@lang('Phone Number')</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Phone Number')" maxlength="80"
                                        required="">
                                </div>

                                <div class="form-group">
                                    <label for="password" class="font-weight-bold">@lang('Password') <sup
                                            class="text--danger">*</sup></label>
                                    <input type="password" name="password" id="password" value="{{ old('password') }}"
                                        placeholder="@lang('Enter Password')" class="form-control form-control-lg" maxlength="60"
                                        required="">
                                </div>
                                <!--confirm password -->
                                <div class="form-group">
                                    <label class="font-weight-bold" for="password_confirmation">@lang('Confirm Password') <sup
                                            class="text--danger">*</sup></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        value="{{ old('password_confirmation') }}" placeholder="@lang('Enter Confirm Password')"
                                        class="form-control form-control-lg" maxlength="60" required="">
                                </div>
                                <label for="phone" class="font-weight-bold">@lang('Select Agents to Manage')</label>
                                <select class="js-example-basic-multiple" name="agents[]" multiple="multiple">
                                    @foreach ($agents as $agent)
                                        <option value="{{$agent->id}}">{{$agent->name}}</option>
                                    @endforeach
                                  </select>
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
    <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
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

        $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
    </script>
@endpush

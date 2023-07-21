@extends('admin.layouts.app')
@section('panel')
    @if(@json_decode($general->sys_version)->version > systemDetails()['version'])
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title"> @lang('New Version Available') <button class="btn btn--dark float-right">@lang('Version') {{json_decode($general->sys_version)->version}}</button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark">@lang('What is the Update ?')</h5>
                        <p><pre  class="f-size--24">{{json_decode($general->sys_version)->details}}</pre></p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(@json_decode($general->sys_version)->message)
        <div class="row">
            @foreach(json_decode($general->sys_version)->message as $msg)
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

    <div class="row mt-50 mb-none-30">
        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--10 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-user-tie"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $don['all'] }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Students')</span>
                    </div>
                    <a href="{{ route('admin.donor.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--18 b-radius--10 box-shadow">
                <div class="icon">
                   <i class="las la-user-circle"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $don['pending']  }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Pending Students')</span>
                    </div>
                    <a href="{{ route('admin.donor.pending') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-users-cog"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $don['approved'] }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Approved Students')</span>
                    </div>

                    <a href="{{route('admin.donor.approved')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--14 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-user-injured"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{ $don['banned'] }}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Banned Students')</span>
                    </div>

                    <a href="{{ route('admin.donor.banned') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        {{-- <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--19 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="las la-tint"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{__($blood)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Blood Group')</span>
                    </div>
                    <a href="{{route('admin.blood.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="las la-city"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{__($city)}}</span>
                        <span class="currency-sign">{{__($general->cur_text)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total City')</span>
                    </div>
                    <a href="{{route('admin.city.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="las la-location-arrow"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{__($locations)}}</span>
                        <span class="currency-sign">{{__($general->cur_text)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Location')</span>
                    </div>
                    <a href="{{route('admin.location.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--15 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="lab la-adversal"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{__($ads)}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total Advertisement')</span>
                    </div>

                    <a href="{{route('admin.ads.index')}}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div> --}}
    </div>


     <div class="row mt-50 mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    
                </div>
            </div>
        </div>
    </div>


@endsection


@push('script')
    <script>
        'use strict';
        $('.approved').on('click', function () {
            var modal = $('#approvedby');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
        $('.cancel').on('click', function () {
            var modal = $('#cancelBy');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
    </script>
@endpush

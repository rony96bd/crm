@extends('donor.layouts.master')
@section('content')
    <div class="page-wrapper default-version">
        @include('donor.partials.sidenav')
        @include('donor.partials.topnav')
        <div class="body-wrapper">
            <div class="bodywrapper__inner">
                @include('donor.partials.breadcrumb')
                @yield('panel')
            </div>
        </div>
    </div>
@endsection

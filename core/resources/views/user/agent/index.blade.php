@extends('user.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Full Name')</th>
                                    <th>@lang('Company Name - Designation')</th>
                                    <th>@lang('Email - Phone')</th>
                                    <th>@lang('Country - City')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($agents as $agent)
                            <tr>
                                <td data-label="@lang('Name - Profession')">
                                    <span>
                                        @php
                                            if ($agent->name == 'No Agent') {
                                                $agentname = 'Without Agent Applications';
                                            } else {
                                                $agentname = $agent->name;
                                            }
                                        @endphp
                                        {{ $agentname }}</span><br>
                                </td>
                                <td data-label="@lang('Designation')">
                                    <span>{{__($agent->designation)}}</span><br>
                                    <span>{{__($agent->company)}}</span><br>
                                </td>
                                <td data-label="@lang('Email - Phone - WhatsApp')">
                                    <span>{{__($agent->email)}}</span><br>
                                    <span>{{__($agent->phone)}}</span><br>
                                </td>
                                <td data-label="@lang('Country - City')">
                                    <span>{{__($agent->country)}}</span><br>
                                    <span>{{__($agent->city)}}</span><br>
                                </td>
                                <td data-label="@lang('Status')">
                                    @if($agent->status == 1)
                                        <span class="badge badge--success">@lang('Active')</span>
                                    @elseif($agent->status == 2)
                                        <span class="badge badge--danger">@lang('Banned')</span>
                                    @else
                                        <span class="badge badge--primary">@lang('Pending')</span>
                                    @endif
                                </td>

                                <td data-label="@lang('Action')">
                                    @php
                                            if ($agent->name == 'No Agent') {
                                                $hidden = 'hidden';
                                            } else {
                                                $hidden = '';
                                            }
                                        @endphp
                                    <a {{ $hidden}} href="{{route('user.agent.view', $agent->id)}}" class="icon-btn btn--primary ml-1"><i class="las la-eye"></i></a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($agents) }}
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="approvedby" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Approval Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('admin.agent.approved.status')}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to approved this agent?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="cancelBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Banned Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('admin.agent.banned.status') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to banned this agent?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection



@push('breadcrumb-plugins')
    {{-- <a href="{{route('admin.agent.create')}}" class="btn btn-lg btn--primary float-sm-right box--shadow1 text--small mb-2 ml-0 ml-xl-2 ml-lg-0" ><i class="fa fa-fw fa-paper-plane"></i>@lang('Add Student')</a> --}}
{{--
     <form action="{{route('admin.donor.search')}}" method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Student Name.....')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form> --}}

    {{-- <form action="{{route('admin.donor.blood.search')}}" method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
        <div class="input-group has_append">
            <select class="form-control" name="blood_id">
                <option>----@lang('Select Blood')----</option>
                @foreach($bloods as $blood)
                    <option value="{{$blood->id}}" @if(@$bloodId == $blood->id) selected @endif>{{__($blood->name)}}</option>
                @endforeach
           </select>
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form> --}}
@endpush

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

        $('.include').on('click', function () {
            var modal = $('#includeFeatured');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.notInclude').on('click', function () {
            var modal = $('#NotincludeFeatured');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
    </script>
@endpush

@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Phone')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td data-label="Photo">
                                            <span><img width="50px"
                                                    src="{{ getImage('assets/user/images/profile/' . $user->image) }}"
                                                    alt="image"></span>
                                        </td>
                                        <td data-label="@lang('Name')">
                                            <span>{{ __($user->name) }}</span>
                                        </td>
                                        <td data-label="@lang('Email')">
                                            <span>{{ __($user->email) }} of</span>
                                        </td>
                                        <td data-label="@lang('Phone')">
                                            <span>{{ __($user->phone) }}</span>
                                        </td>
                                        <td data-label="@lang('Status')">
                                            @if ($user->status == 1)
                                                <span class="badge badge--success">@lang('Active')</span>
                                            @elseif($user->status == 2)
                                                <span class="badge badge--danger">@lang('Banned')</span>
                                            @else
                                                <span class="badge badge--primary">@lang('Pending')</span>
                                            @endif
                                        </td>

                                        <td data-label="@lang('Action')">
                                            @if ($user->status == 2)
                                                <a href="javascript:void(0)" class="icon-btn btn--success ml-1 approved"
                                                    data-toggle="tooltip" data-original-title="@lang('Approve')"
                                                    data-id="{{ $user->id }}"><i class="las la-check"></i></a>
                                            @elseif($user->status == 1)
                                                <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 cancel"
                                                    data-toggle="tooltip" data-original-title="@lang('Banned')"
                                                    data-id="{{ $user->id }}"><i class="las la-times"></i></a>
                                            @elseif($user->status == 0)
                                                <a href="javascript:void(0)" class="icon-btn btn--success ml-1 approved"
                                                    data-toggle="tooltip" data-original-title="@lang('Approve')"
                                                    data-id="{{ $user->id }}"><i class="las la-check"></i></a>
                                                <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 cancel"
                                                    data-toggle="tooltip" data-original-title="@lang('Banned')"
                                                    data-id="{{ $user->id }}"><i class="las la-times"></i></a>
                                            @endif
                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                                class="icon-btn btn--primary ml-1"><i class="las la-pen"></i></a>
                                            <a href="{{ route('admin.user.view', $user->id) }}"
                                                class="icon-btn btn--primary ml-1"><i class="las la-eye"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($users) }}
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="approvedby" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Approval Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.user.approved.status') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to approved this user?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="cancelBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Banned Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('admin.user.banned.status') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to banned this user?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary"
                            data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@push('breadcrumb-plugins')
    <a href="{{ route('admin.user.create') }}"
        class="btn btn-lg btn--primary float-sm-right box--shadow1 text--small mb-2 ml-0 ml-xl-2 ml-lg-0"><i
            class="fa fa-fw fa-paper-plane"></i>@lang('Add User')</a>
@endpush

@push('script')
    <script>
        'use strict';
        $('.approved').on('click', function() {
            var modal = $('#approvedby');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
        $('.cancel').on('click', function() {
            var modal = $('#cancelBy');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.include').on('click', function() {
            var modal = $('#includeFeatured');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.notInclude').on('click', function() {
            var modal = $('#NotincludeFeatured');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });
    </script>
@endpush

<div class="row gy-4">
                    @forelse($donors as $donor)
                        <div class="col-lg-4 col-md-12 col-sm-6">
                            <div class="donor-item has--link">
                                <a href="{{route('donor.details', [slug($donor->name), encrypt($donor->id)])}}" class="item--link"></a>
                                <div class="donor-item__thumb">
                                    <img src="{{getImage('assets/images/donor/'. $donor->image, imagePath()['donor']['size'])}}" alt="@lang('image')">
                                </div>
                                <div class="donor-item__content">
                                    <h5 class="donor-item__name">{{__($donor->name)}}</h5>
                                    <ul class="donor-item__list mt-2">
                                        <li class="text-truncate">
                                            <i class="las la-map-marker-alt"></i> @lang('Location') : {{__($donor->location->name)}}
                                        </li>
                                        <li>
                                            <i class="las la-tint"></i>@lang('Blood Group') : <span class="text--base">({{__($donor->blood->name)}})</span>
                                        </li>
                                    </ul>
                                    <a href="{{route('donor.details', [slug($donor->name), encrypt($donor->id)])}}" class="text--base fs--14px text-decoration-underline">@lang('View Profile')</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3 class="text-center">{{$emptyMessage}}</h3>
                    @endforelse
                </div>
                <nav class="mt-4 pagination-md">
                {{$donors->links()}}
                </nav>

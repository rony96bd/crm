@php
    $overview = getContent('overview.content', true);
    $overviewElements = getContent('overview.element', false);
@endphp

<section class="pt-80 pb-80 img-overlay bg_img"
    style="background-image: url('{{ getImage('assets/images/frontend/overview/' . @$overview->data_values->background_image, '1920x1282') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header text-center">
                    <h2 class="section-title text-white fw-normal">{{ __(@$overview->data_values->heading) }}</h2>
                </div>
            </div>
        </div>

        <div class="row gy-4">
            <div class="col-lg-3 col-6">
                <div class="overview-item text-center">
                    <div class="overview-item__icon">
                        <i class="las la-tint"></i>
                    </div>
                    <h6 class="overview-item__caption">{{ $allblood }} Blood Groups</h6>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="overview-item text-center">
                    <div class="overview-item__icon">
                        <i class="las la-hands-helping"></i>
                    </div>
                    <h6 class="overview-item__caption">{{ $alllocations }} Upazila</h6>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="overview-item text-center">
                    <div class="overview-item__icon">
                        <i class="las la-map"></i>
                    </div>
                    <h6 class="overview-item__caption">{{ $allcity }} District</h6>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="overview-item text-center">
                    <div class="overview-item__icon">
                        <i class="las la-user"></i>
                    </div>
                    <h6 class="overview-item__caption">{{ $don['all'] }} Donors</h6>
                </div>
            </div>
        </div>
    </div>
</section>

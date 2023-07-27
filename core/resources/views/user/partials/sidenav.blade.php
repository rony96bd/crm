<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
    data-background="{{ getImage('assets/user/images/sidebar/2.jpg', '400x800') }}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{ route('user.dashboard') }}" class="sidebar__main-logo"><img
                    src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" alt="@lang('image')"></a>
            <a href="{{ route('user.dashboard') }}" class="sidebar__logo-shape"><img
                    src="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{ menuActive('user.dashboard') }}">
                    <a href="{{ route('user.dashboard') }}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('user.donor*', 3) }}">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('Manage Students') </span>
                        @if (0 < $pending_donor_count)
                            <span class="menu-badge pill bg--primary ml-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('user.donor*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('user.donor.approved') }} ">
                                <a href="{{ route('user.donor.approved') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Approved')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('user.donor.pending') }} ">
                                <a href="{{ route('user.donor.pending') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending')</span>
                                    @if ($pending_donor_count)
                                        <span
                                            class="menu-badge pill bg--primary ml-auto">{{ $pending_donor_count }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('user.donor.banned') }} ">
                                <a href="{{ route('user.donor.banned') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Banned')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('user.donor.index') }} ">
                                <a href="{{ route('user.donor.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Registered Students')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('user.agent*', 3) }}">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('Manage Agent') </span>
                        @if (0 < $pending_agent_count)
                            <span class="menu-badge pill bg--primary ml-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('user.agent*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('user.agent.approved') }} ">
                                <a href="{{ route('user.agent.approved') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Approved')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('user.agent.pending') }} ">
                                <a href="{{ route('user.agent.pending') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending')</span>
                                    @if ($pending_agent_count)
                                        <span
                                            class="menu-badge pill bg--primary ml-auto">{{ $pending_agent_count }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('user.agent.banned') }} ">
                                <a href="{{ route('user.agent.banned') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Banned')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('user.agent.index') }} ">
                                <a href="{{ route('user.agent.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Registered Agents')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- sidebar end -->

<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
    data-background="{{ getImage('assets/admin/images/sidebar/2.jpg', '400x800') }}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{ route('admin.dashboard') }}" class="sidebar__main-logo"><img
                    src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" alt="@lang('image')"></a>
            <a href="{{ route('admin.dashboard') }}" class="sidebar__logo-shape"><img
                    src="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{ menuActive('admin.dashboard') }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.donor*', 3) }}">
                        <i class="menu-icon las la-user-graduate"></i>
                        <span class="menu-title">@lang('Manage Students') </span>
                        @if (0 < $pending_donor_count)
                            <span class="menu-badge pill bg--primary ml-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.donor*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.donor.approved') }} ">
                                <a href="{{ route('admin.donor.approved') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Approved')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.donor.pending') }} ">
                                <a href="{{ route('admin.donor.pending') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending')</span>
                                    @if ($pending_donor_count)
                                        <span
                                            class="menu-badge pill bg--primary ml-auto">{{ $pending_donor_count }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.donor.banned') }} ">
                                <a href="{{ route('admin.donor.banned') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Banned')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.donor.index') }} ">
                                <a href="{{ route('admin.donor.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Registered Students')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.agent*', 3) }}">
                        <i class="menu-icon las la-user-tie"></i>
                        <span class="menu-title">@lang('Manage Agent') </span>
                        @if (0 < $pending_agent_count)
                            <span class="menu-badge pill bg--primary ml-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.agent*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.agent.approved') }} ">
                                <a href="{{ route('admin.agent.approved') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Approved')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.agent.pending') }} ">
                                <a href="{{ route('admin.agent.pending') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending')</span>
                                    @if ($pending_agent_count)
                                        <span
                                            class="menu-badge pill bg--primary ml-auto">{{ $pending_agent_count }}</span>
                                    @endif
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.agent.banned') }} ">
                                <a href="{{ route('admin.agent.banned') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Banned')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.agent.index') }} ">
                                <a href="{{ route('admin.agent.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Registered Agents')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{ menuActive('admin.user*', 3) }}">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('Manage User') </span>
                    </a>
                    <div class="sidebar-submenu {{ menuActive('admin.user*', 2) }} ">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('admin.user.index') }} ">
                                <a href="{{ route('admin.user.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Users')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('admin.user.banned') }} ">
                                <a href="{{ route('admin.user.banned') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Banned')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar__menu-header">@lang('Settings')</li>

                <li class="sidebar-menu-item {{ menuActive('admin.setting.index') }}">
                    <a href="{{ route('admin.setting.index') }}" class="nav-link">
                        <i class="menu-icon las la-life-ring"></i>
                        <span class="menu-title">@lang('General Setting')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admin.setting.logo.icon') }}">
                    <a href="{{ route('admin.setting.logo.icon') }}" class="nav-link">
                        <i class="menu-icon las la-images"></i>
                        <span class="menu-title">@lang('Logo & Favicon')</span>
                    </a>
                </li>


                <li class="sidebar-menu-item {{ menuActive('admin.setting.custom.css') }}">
                    <a href="{{ route('admin.setting.custom.css') }}" class="nav-link">
                        <i class="menu-icon lab la-css3-alt"></i>
                        <span class="menu-title">@lang('Custom CSS')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('admin.setting.optimize') }}">
                    <a href="{{ route('admin.setting.optimize') }}" class="nav-link">
                        <i class="menu-icon las la-broom"></i>
                        <span class="menu-title">@lang('Clear Cache')</span>
                    </a>
                </li>
            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">CRM</span>
                <span class="text--success">@lang('V'){{ systemDetails()['version'] }} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{ route('dashboard') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce Dashboard">Properties Dashboard</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Ecommerce">Paramount</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Ecommerce"></i>
            </li>
            <li class=" nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }} "><a href="{{ route('dashboard') }}"><i class="la la-th-large"></i><span class="menu-title" data-i18n="Shop">Dashboard</span></a>
            </li>
            <li class=" nav-item {{ request()->is('admin/agents*') ? 'active' : '' }} "><a href="{{ route('agents.index') }}"><i class="ft-users"></i><span class="menu-title" data-i18n="Shop">Agents</span></a>
                <li class=" nav-item {{ request()->is('admin/property-type*') ? 'active' : '' }} "><a href="{{ route('property-type.index') }}"><i class="ft-align-left"></i><span class="menu-title" data-i18n="Shop">Property Types</span></a>
            <li class=" nav-item {{ request()->is('admin/properties*') ? 'active' : '' }} "><a href="{{ route('properties.index') }}" class="properties"><i class="ft-bar-chart"></i><span class="menu-title" data-i18n="Shop">Properties</span></a>
            <li class=" nav-item {{ request()->is('admin/authors*') ? 'active' : '' }} "><a href="{{ route('authors.index') }}"><i class="ft-user"></i><span class="menu-title" data-i18n="Shop">Authors</span></a>
            <li class=" nav-item {{ request()->is('admin/reality-news*') ? 'active' : '' }} "><a href="{{ route('reality-news.index') }}"><i class="ft-globe"></i><span class="menu-title" data-i18n="Shop">News</span></a>
            <li class="nav-item has-sub"><a href="#"><i class="ft-user-plus"></i><span class="menu-title" data-i18n="Maps">Team</span></a>
                <ul class="menu-content" style="">
                    <li class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('categories.index') }}"><i class="ft-plus"></i><span data-i18n="Categories"> Categories</span></a>
                    </li>
                    <li class="{{ request()->is('admin/employers*') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('employers.index') }}"><i class="ft-user-plus"></i><span data-i18n="Manage Team">    Manage Team</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub"><a href="#"><i class="ft-settings"></i><span class="menu-title" data-i18n="Maps"> Settings</span></a>
                <ul class="menu-content" style="">
                    <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('settings') }}"><i class="ft-settings"></i><span data-i18n="Categories"> General</span></a>
                    </li>
                    <li class="{{ request()->is('admin/homepage-slider*') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('homepageSlider') }}"><i class="ft-settings"></i><span data-i18n="Homepage Slider">  Homepage Slider</span></a>
                    </li>
                    <li class="{{ request()->is('admin/company-page-settings*') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('settings.companyPage') }}"><i class="ft-settings"></i><span data-i18n="Homepage Slider">  Company Page</span></a>
                    </li>
                </ul>
            </li>
            {{-- <li class=" nav-item {{ request()->is('admin/settings*') ? 'active' : '' }} "><a href="{{ route('settings') }}"><i class="ft-settings"></i><span class="menu-title" data-i18n="Shop">Settings</span></a> --}}
            <li class=" nav-item {{ request()->is('admin/administrator*') ? 'active' : '' }} "><a href="{{ route('administrator.index') }}"><i class="ft-user"></i><span class="menu-title" data-i18n="Shop">Administrator</span></a>
            <li class=" nav-item {{ request()->is('admin/change-password*') ? 'active' : '' }} "><a href="{{ route('administrator.changePassword') }}"><i class="ft-unlock"></i><span class="menu-title" data-i18n="Shop">Change Password</span></a>
            <li class=" nav-item">
                <a href="#"><i class="la la-check-circle-o"></i>
                    <span class="menu-title" data-i18n="Order"  onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                        Logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>

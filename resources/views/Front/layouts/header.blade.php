<header>
    <div
        class="header-main {{ Route::currentRouteName() == 'news.view' ? 'header-main position-absolute deep-light-blue' : '' }}">
        <div class="header-section d-flex flex-wrap align-items-center ">
            <div class="col-sm-2">
                <div class="logo">
                    @php
                        $setting = Config::get('settings');
                    @endphp
                    <a href="{{ route('home') }}">
                        <img src="{{ array_key_exists('header_logo', $setting) ? asset('uploads/setting/' . $setting['header_logo'] . '') : asset('assets/front/images/logo.png') }}"
                            alt="" class="white-logo">
                        <img src="{{ asset('assets/front/images/dark-logo.png') }}" alt="" class="dark-logo">
                    </a>
                </div>
            </div>
            <div class="col-sm-10 header-menu ">
                <div class="nav-menu justify-content-end d-flex flex-wrap align-items-center">
                    <a class="menulinks"><i></i></a>
                    <ul class="mainmenu text-uppercase">
                        <li class="{{ request()->is('properties*') ? 'active' : '' }}">
                            <a href="javascript:void(0)" onclick="triggerChildMenuIfAvailable(this)"
                                class="{{ request()->is('properties') ? 'current' : '' }}">PROPERTIES</a>
                                <ul>
                                    <li><a href="{{ route('properties.getProperties',['type' => 'shopping-center']) }}">Shopping Center</a></li>
                                    <li><a href="{{ route('properties.getProperties',['type' => 'single-tenant']) }}">Single Tenant</a></li>
                                    <li><a href="{{ route('properties.getProperties',['type' => 'medical-office']) }}">Medical Office</a></li>
                                    {{-- <li><a href="{{ route('properties.underDevelopment') }}">Under Development</a></li> --}}
                                    <li><a href="{{ route('properties.getProperties', ['type' => 'under-development']) }}">Under Development</a></li>
                                    <li><a href="{{ route('properties.getProperties',['type' => 'mixed-use']) }}">Mixed Use</a></li>
                                    <li><a href="{{ route('properties.getProperties',['type' => 'warehouse']) }}">Self Storage</a></li>
                                    <li><a href="{{ route('properties.getProperties',['type' => 'pad-sites']) }}">Pad Sites Available</a></li>
                                    <li><a href="{{ route('properties') }}">All Properties</a></li>
                                </ul>
                        </li>
                        <li class="{{ request()->is('companies*') ? 'active' : '' }}">
                            <a href="{{ route('company') }}"
                                class="{{ request()->is('companies') ? 'current' : '' }}">COMPANY</a>
                        </li>
                        <li class="{{ request()->is('news*') ? 'active' : '' }}">
                            <a href="{{ route('news') }}"
                                class="{{ request()->is('news') ? 'current' : '' }}">NEWS</a>
                        </li>
                        <li class="{{ request()->is('team') ? 'active' : '' }}">
                            <a href="{{ route('team') }}" class="{{ request()->is('team') ? 'current' : '' }}">OUR
                                TEAM</a>
                        <li class="{{ request()->is('contact-us') ? 'active' : '' }}">
                            <a href="{{ route('contactUs') }}"
                                class="{{ request()->is('contact-us') ? 'current' : '' }}">CONTACT US</a>
                        </li>
                        <li class="mobile-block">
                            <a href="https://portal.rentpayment.com/pay/login.html?pc=DRR929BU52">TENANT PORTAL</a>
                        </li>
                    </ul>
                    {{-- <div class="header-search-box position-relative">
                        <form action="{{ route('properties.search') }}">
                            <div class="search-box">
                                <a class="search-btn" href="javascript:void(0)"><i class="fas fa-search"></i></a>
                                <input class="search-txt" type="text" name="search"
                                    placeholder="Seach by Property Name, City or State">
                            </div>
                        </form>
                    </div> --}}
                    <div class="header-search-box">
                        <div class="search-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="search-box-wrap" style="display: none;">
                            <div class="close-search-box"><img src="{{ asset('assets/front/images/xmark-solid.svg') }}"></div>
                            <div class="search-content">
                                <h3>I am looking for...</h3>
                                <div class="search-box">
                                    <form action="{{ route('properties.search') }}">
                                        <input type="text" placeholder="Seach by Property Name, City or State "name="search" id="propertySearch" data-url="{{ route('home.propertySearch') }}"/>
                                        <a class="search-btn" href="javascript:void(0)"><img src="{{ asset('assets/front/images/search-right-arrow.png') }}"></a>
                                        <div class="search-property" id="propertySearchResult"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-btn desktop-block">
                        <a target="_blank" href="https://portal.rentpayment.com/pay/login.html?pc=DRR929BU52"
                            class="text-uppercase">TENANT PORTAL</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

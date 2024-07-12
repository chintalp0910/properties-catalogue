        <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="{{url('admin/dashboard')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="eCommerce Dashboard">Properties Dashboard</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Ecommerce">Paramount</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Ecommerce"></i>
                </li>
                <li class=" nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }} "><a href="{{ route('dashboard') }}"><i class="la la-th-large"></i><span class="menu-title" data-i18n="Shop">Dashboard</span></a>
                </li>
               <!--  <li class=" nav-item {{ request()->is('properties_all') ? 'active' : '' }}" > <a href="{{url('admin/properties_all')}}"> <i class="la la-list"></i><span class="menu-title" data-i18n="Properties Detail">Properties Detail</span></a>
                </li> -->
             <!--    <li class=" nav-item {{ request()->is('category_all') ? 'active' : '' }}" > <a href="{{url('admin/category_all')}}"> <i class="la la-list"></i><span class="menu-title" data-i18n="Properties Detail">Properties Category</span></a>
                </li> -->
                 <li class=" nav-item {{ request()->is('admin/properties*') || request()->is('admin/add_category') ? 'active' : '' }}"><a href="#"><i class="la la-clipboard"></i><span class="menu-title" data-i18n="Invoice">Properties Manager</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item"><i></i><span data-i18n="Invoice Summary">Properties</span></a>
                            <ul>
                                <li><a class="menu-item {{ request()->is('admin/properties') ? 'active' : '' }}" href="{{ route('properties.index') }}"><i></i><span data-i18n="Invoice Summary"> All Properties</span></a></li>
                                 <li><a class="menu-item" {{ request()->is('admin/properties/create') ? 'active' : '' }} href="{{ route('properties.create') }}"><i></i><span data-i18n="Invoice Template">Add new properties</span></a> </li>
                            </ul>
                        </li>
                       
                        <li><a class="menu-item" href="{{url('admin/category_all')}}"><i></i><span data-i18n="Invoice Template">Category</span></a> 
                            <ul><li><a class="menu-item" href="{{url('admin/add_category')}}"><i></i><span data-i18n="Invoice Template">Add new Category</span></a> </li></ul>
                        </li>                       
                    </ul>
                </li>
                <li class=" nav-item {{ request()->is('admin/agents*') ? 'active' : '' }} "><a href="{{ route('agents.index') }}"><i class="ft-users"></i><span class="menu-title" data-i18n="Shop">Agents</span></a>
                <li class=" nav-item {{ request()->is('admin/administrator*') ? 'active' : '' }} "><a href="{{ route('administrator.index') }}"><i class="ft-user"></i><span class="menu-title" data-i18n="Shop">Administrator</span></a>
                <li class=" nav-item">
                    <a href="#"><i class="la la-check-circle-o"></i>
                        <span class="menu-title" data-i18n="Order"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li> 
       
    
               <!--  <li class=" nav-item"><a href="ecommerce-shopping-cart.html"><i class="la la-shopping-cart"></i><span class="menu-title" data-i18n="Shopping Cart">Shopping Cart</span></a>
                </li>
                <li class=" nav-item"><a href="ecommerce-checkout.html"><i class="la la-credit-card"></i><span class="menu-title" data-i18n="Checkout">Checkout</span></a>
                </li>-->
                
               
                <!-- <li class=" navigation-header"><span data-i18n="User Interface">User Interface</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="User Interface"></i>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-server"></i><span class="menu-title" data-i18n="Components">Components</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="component-alerts.html"><i></i><span data-i18n="Alerts">Alerts</span></a>
                        </li>
                        <li><a class="menu-item" href="component-callout.html"><i></i><span data-i18n="Callout">Callout</span></a>
                        </li>
                        <li><a class="menu-item" href="#"><i></i><span data-i18n="Buttons">Buttons</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="component-buttons-basic.html"><i></i><span data-i18n="Basic Buttons">Basic Buttons</span></a>
                                </li>
                                <li><a class="menu-item" href="component-buttons-extended.html"><i></i><span data-i18n="Extended Buttons">Extended Buttons</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="menu-item" href="component-carousel.html"><i></i><span data-i18n="Carousel">Carousel</span></a>
                        </li>
                        <li><a class="menu-item" href="component-collapse.html"><i></i><span data-i18n="Collapse">Collapse</span></a>
                        </li>
                        <li><a class="menu-item" href="component-dropdowns.html"><i></i><span data-i18n="Dropdowns">Dropdowns</span></a>
                        </li>
                        <li><a class="menu-item" href="component-list-group.html"><i></i><span data-i18n="List Group">List Group</span></a>
                        </li>
                        <li><a class="menu-item" href="component-modals.html"><i></i><span data-i18n="Modals">Modals</span></a>
                        </li>
                        <li><a class="menu-item" href="component-pagination.html"><i></i><span data-i18n="Pagination">Pagination</span></a>
                        </li>
                        <li><a class="menu-item" href="component-navs-component.html"><i></i><span data-i18n="Navs Component">Navs Component</span></a>
                        </li>
                        <li><a class="menu-item" href="component-tabs-component.html"><i></i><span data-i18n="Tabs Component">Tabs Component</span></a>
                        </li>
                        <li><a class="menu-item" href="component-pills-component.html"><i></i><span data-i18n="Pills Component">Pills Component</span></a>
                        </li>
                        <li><a class="menu-item" href="component-tooltips.html"><i></i><span data-i18n="Tooltips">Tooltips</span></a>
                        </li>
                        <li><a class="menu-item" href="component-popovers.html"><i></i><span data-i18n="Popovers">Popovers</span></a>
                        </li>
                        <li><a class="menu-item" href="component-badges.html"><i></i><span data-i18n="Badges">Badges</span></a>
                        </li>
                        <li><a class="menu-item" href="component-pill-badges.html"><i></i><span>Pill Badges</span></a>
                        </li>
                        <li><a class="menu-item" href="component-progress.html"><i></i><span data-i18n="Progress">Progress</span></a>
                        </li>
                        <li><a class="menu-item" href="component-media-objects.html"><i></i><span data-i18n="Media Objects">Media Objects</span></a>
                        </li>
                        <li><a class="menu-item" href="component-scrollable.html"><i></i><span data-i18n="Scrollable">Scrollable</span></a>
                        </li>
                        <li><a class="menu-item" href="component-spinners.html"><i></i><span data-i18n="Spinners">Spinners</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-unlock"></i><span class="menu-title" data-i18n="Authentication">Authentication</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="login-with-bg-image.html" target="_blank"><i></i><span>Login</span></a>
                        </li>
                        <li><a class="menu-item" href="register-with-bg-image.html" target="_blank"><i></i><span>SignIn</span></a>
                        </li>
                        <li><a class="menu-item" href="recover-password.html" target="_blank"><i></i><span>Forgot Password</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-file-text"></i><span class="menu-title" data-i18n="Form Layouts">Form Layouts</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="form-layout-basic.html"><i></i><span data-i18n="Basic Forms">Basic Forms</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-horizontal.html"><i></i><span data-i18n="Horizontal Forms">Horizontal Forms</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-hidden-labels.html"><i></i><span data-i18n="Hidden Labels">Hidden Labels</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-form-actions.html"><i></i><span data-i18n="Form Actions">Form Actions</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-row-separator.html"><i></i><span data-i18n="Row Separator">Row Separator</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-bordered.html"><i></i><span data-i18n="Bordered">Bordered</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-striped-rows.html"><i></i><span data-i18n="Striped Rows">Striped Rows</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-striped-labels.html"><i></i><span data-i18n="Striped Labels">Striped Labels</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-paste"></i><span class="menu-title" data-i18n="Form Wizard">Form Wizard</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="form-wizard-circle-style.html"><i></i><span data-i18n="Circle Style">Circle Style</span></a>
                        </li>
                        <li><a class="menu-item" href="form-wizard-notification-style.html"><i></i><span data-i18n="Notification Style">Notification Style</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-table"></i><span class="menu-title" data-i18n="Bootstrap Tables">Bootstrap Tables</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="table-basic.html"><i></i><span data-i18n="Basic Tables">Basic Tables</span></a>
                        </li>
                        <li><a class="menu-item" href="table-border.html"><i></i><span data-i18n="Table Border">Table Border</span></a>
                        </li>
                        <li><a class="menu-item" href="table-sizing.html"><i></i><span data-i18n="Table Sizing">Table Sizing</span></a>
                        </li>
                        <li><a class="menu-item" href="table-styling.html"><i></i><span data-i18n="Table Styling">Table Styling</span></a>
                        </li>
                        <li><a class="menu-item" href="table-components.html"><i></i><span data-i18n="Table Components">Table Components</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-area-chart"></i><span class="menu-title" data-i18n="Chartjs">Chartjs</span></a>
                    <ul class="menu-content">
                        <li ><a class="menu-item" href="chartjs-line-charts.html"><i></i><span data-i18n="Line charts">Line charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-bar-charts.html"><i></i><span data-i18n="Bar charts">Bar charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-pie-doughnut-charts.html"><i></i><span data-i18n="Pie &amp; Doughnut charts">Pie &amp; Doughnut charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-scatter-charts.html"><i></i><span data-i18n="Scatter charts">Scatter charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-polar-radar-charts.html"><i></i><span data-i18n="Polar &amp; Radar charts">Polar &amp; Radar charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-advance-charts.html"><i></i><span data-i18n="Advance charts">Advance charts</span></a>
                        </li> -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
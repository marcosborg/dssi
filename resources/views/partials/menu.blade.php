<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('company_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.companies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/companies") || request()->is("admin/companies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.company.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('country_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-globe-africa c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('manufacturer_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.manufacturers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/manufacturers") || request()->is("admin/manufacturers/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-industry c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.manufacturer.title') }}
                </a>
            </li>
        @endcan
        @can('solution_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.solutions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/solutions") || request()->is("admin/solutions/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bullhorn c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.solution.title') }}
                </a>
            </li>
        @endcan
        @can('stock_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.stocks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/stocks") || request()->is("admin/stocks/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-boxes c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.stock.title') }}
                </a>
            </li>
        @endcan
        @can('product_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-archive c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.product.title') }}
                </a>
            </li>
        @endcan
        @can('product_menu_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/crash-plans*") ? "c-show" : "" }} {{ request()->is("admin/k-seven-securities*") ? "c-show" : "" }} {{ request()->is("admin/mail-stores*") ? "c-show" : "" }} {{ request()->is("admin/own-clouds*") ? "c-show" : "" }} {{ request()->is("admin/titan-hqs*") ? "c-show" : "" }} {{ request()->is("admin/ubiquitis*") ? "c-show" : "" }} {{ request()->is("admin/wasabis*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-dot-circle c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.productMenu.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('crash_plan_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crash-plans.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crash-plans") || request()->is("admin/crash-plans/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crashPlan.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('k_seven_security_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.k-seven-securities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/k-seven-securities") || request()->is("admin/k-seven-securities/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.kSevenSecurity.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('mail_store_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.mail-stores.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/mail-stores") || request()->is("admin/mail-stores/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.mailStore.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('own_cloud_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.own-clouds.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/own-clouds") || request()->is("admin/own-clouds/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.ownCloud.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('titan_hq_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.titan-hqs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/titan-hqs") || request()->is("admin/titan-hqs/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.titanHq.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('ubiquiti_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.ubiquitis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/ubiquitis") || request()->is("admin/ubiquitis/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.ubiquiti.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('wasabi_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.wasabis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/wasabis") || request()->is("admin/wasabis/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.wasabi.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('nakivo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.nakivos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/nakivos") || request()->is("admin/nakivos/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.nakivo.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('chat_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.chats.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/chats") || request()->is("admin/chats/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-comments c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.chat.title') }}
                </a>
            </li>
        @endcan
        @can('quote_request_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.quote-requests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/quote-requests") || request()->is("admin/quote-requests/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.quoteRequest.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
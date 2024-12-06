<section :class="toggleSidebar ? '' : 'sidebar-wrapper'" x-on:click="toggleSidebar = !toggleSidebar" x-cloak>
    <div x-on:click="event.stopPropagation()" class="sidebar bg-black "
        :class="toggleSidebar ? 'w-0 md:w-[250px]' : 'w-[270px] md:w-0'">
        <div class="flex justify-center py-3">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset(gs()->logo) }}" class="w-[100px] h-auto " />
            </a>
        </div>
        <ul>
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="las la-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- <li class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <a href="{{ route('admin.gallery.home') }}">
                    <i class="las la-images"></i>
                    <span>Gallery</span>
                </a>
            </li> --}}

            {{-- @if (auth()->user()->can('view_user'))
            <li>
                <a class="opacity-50">CUSTOMER SECTION</a>
            </li>

            <li class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <a href="{{ route('admin.user.list', ['remark' => 'ACTIVE']) }}">
                    <i class="las la-user"></i>
                    <span>Active Customers</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <a href="{{ route('admin.user.list', ['remark' => 'INACTIVE']) }}">
                    <i class="las la-user"></i>
                    <span>Deleted Customers</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <a href="{{ route('admin.user.list', ['remark' => 'BLOCKED']) }}">
                    <i class="las la-user"></i>
                    <span>Blocked Customers</span>
                </a>
            </li>

            @endIf --}}
            {{--
            <li>
                <a class="opacity-50">BUSINESS SECTION</a>
            </li>


            <li>
                <a href="{{ route('admin.transaction.list') }}">
                    <i class="las la-wallet"></i>
                    <span>All Transactions</span>
                </a>
            </li> --}}




            {{--
            <li>
                <a class="opacity-50">MARKETING SECTION</a>
            </li>


            <li class="{{ request()->routeIs(['admin.faq.*']) ? 'active' : '' }}">
                <a href="{{ route('admin.faq.list') }}">
                    <i class="las la-user-tag"></i>
                    <span>Faqs</span>
                </a>
            </li>

            <li class="{{ $status = request()->routeIs('admin.notification.*') ? 'active' : null }}">
                <a href="{{ route('admin.push-notification.list') }}" class="logout">
                    <i class="las la-bell"></i>
                    <span>Push Notification</span>
                </a>
            </li> --}}




            {{-- @if (auth()->user()->can('manage_employee'))
            <li>
                <a class="opacity-50">HUMAN RESOURCE SECTION</a>
            </li>

            <li class="{{ $status = request()->routeIs(['admin.employee.*', 'admin.role.*', 'admin.permission.*']) ? 'active' : null }}"
                x-data="{ show: '{{ $status ? true : false }}' }">
                <a href="#" x-on:click="show = !show">
                    <i class="las la-users"></i>
                    <span>Employee Management</span>
                    <i class="las la-angle-right arrow-right" :class="show ? 'rotate-90' : ''"></i>
                </a>

                <ul class="list-2" x-show="show">

                    <li>
                        <a href="{{ route('admin.employee.list') }}">
                            <i class="las la-circle"></i>
                            <span>Employees</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.role.list') }}">
                            <i class="las la-circle"></i>
                            <span>Roles</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.permission.list') }}">
                            <i class="las la-circle"></i>
                            <span>Permissions</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endIf --}}



            {{-- @if (auth()->user()->can('manage_settings')) --}}
            {{-- <li>
                <a class="opacity-50">SETTINGS SECTION</a>
            </li>


            <li class="{{ $status = request()->routeIs('admin.setting.business.*') ? 'active' : null }}"
                x-data="{ show: '{{ $status ? true : false }}' }">
                <a href="#" x-on:click="show = !show">
                    <i class="las la-tools"></i>
                    <span>Bussiness Setting</span>
                    <i class="las la-angle-right arrow-right" :class="show ? 'rotate-90' : ''"></i>
                </a>

                <ul class="list-2" x-show="show">

                    <li>
                        <a href="{{ route('admin.setting.business.general') }}">
                            <i class="las la-circle"></i>
                            <span>General Setting</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.setting.business.app_config') }}">
                            <i class="las la-circle"></i>
                            <span>App Config</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.setting.business.payment') }}">
                            <i class="las la-circle"></i>
                            <span>Payment Setting</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.setting.business.notification') }}">
                            <i class="las la-circle"></i>
                            <span>Notification Setting</span>
                        </a>
                    </li>
                </ul>
            </li> --}}



            {{-- <li class="{{ $status = request()->routeIs('admin.setting.third_party.*') ? 'active' : null }}"
                x-data="{ show: '{{ $status ? true : false }}' }">
                <a href="#" x-on:click="show = !show">
                    <i class="las la-tools"></i>
                    <span>Third Party API</span>
                    <i class="las la-angle-right arrow-right" :class="show ? 'rotate-90' : ''"></i>
                </a>

                <ul class="list-2" x-show="show">
                    <li>
                        <a href="{{ route('admin.setting.third_party.payment_method') }}">
                            <i class="las la-circle"></i>
                            <span>Payment Methods</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.setting.third_party.mail_config') }}">
                            <i class="las la-circle"></i>
                            <span>Mail Config</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.setting.third_party.sms_module') }}">
                            <i class="las la-circle"></i>
                            <span>SMS Module</span>
                        </a>
                    </li>

                </ul>
            </li> --}}

            <li>
                <a href="{{ route('admin.logout') }}" class="logout">
                    <i class="las la-power-off logout"></i>
                    <span>Log out</span>
                </a>
            </li>
        </ul>
    </div>
</section>
<div class="deznav">
    <div class="deznav-scroll">
        <a href="{{ route('admin.certificates.create') }}" class="add-menu-sidebar" {{-- data-toggle="modal" --}}
            {{-- data-target="#addOrderModalside" --}}>+ New
            Certificate</a>
        <ul class="metismenu" id="menu">
            @can('systems control')
                <li
                    class="{{ request()->routeIs(['admin.users.*', 'admin.permissions.*', 'admin.roles.*']) ? 'mm-active' : '' }}">
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">System Settings</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('users read')
                            <li class="{{ request()->routeIs('admin.users.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('admin.users.index') }}"
                                    class="{{ request()->routeIs(['admin.users.index', 'admin.users.*']) ? 'mm-active' : '' }}">
                                    Users
                                </a>
                            </li>
                        @endcan
                        @can('permissions read')
                            <li class="{{ request()->routeIs('admin.permissions.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('admin.permissions.index') }}"
                                    class="{{ request()->routeIs(['admin.permissions.index', 'admin.permissions.*']) ? 'mm-active' : '' }}">
                                    Permissions
                                </a>
                            </li>
                        @endcan
                        @can('roles read')
                            <li class="{{ request()->routeIs('admin.roles.index') ? 'mm-active' : '' }}">
                                <a href="{{ route('admin.roles.index') }}"
                                    class="{{ request()->routeIs(['admin.roles.index', 'admin.roles.*']) ? 'mm-active' : '' }}">
                                    Roles
                                </a>
                            </li>
                        @endcan
                        <li class="{{ request()->routeIs('admin.contacts.index') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.contacts.index') }}"
                                class="{{ request()->routeIs(['admin.contacts.index', 'admin.roles.*']) ? 'mm-active' : '' }}">
                                Contact Data (' Phone number, email, address, open-hour')
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.footerlogos.index') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.footerlogos.index') }}"
                                class="{{ request()->routeIs(['admin.footerlogos.index', 'admin.roles.*']) ? 'mm-active' : '' }}">
                                Footer Logo
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li
                class="{{ request()->routeIs(['admin.certificates.*', 'admin.trainings.*', 'admin.application.form.any', 'admin.blogs.*', 'admin.services.*', 'admin.feedback.*', 'admin.clients.*']) ? 'mm-active' : '' }}">
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-television"></i>
                    <span class="nav-text">Contents</span>
                </a>
                <ul aria-expanded="false">
                    @can('certificates read')
                        <li>
                            <a href="{{ route('admin.certificates.index') }}"
                                class="{{ request()->routeIs(['admin.certificates.index', 'admin.certificates.*']) ? 'mm-active' : '' }}">Certificates</a>
                        </li>
                    @endcan
                    <!-- @can('standards read')
                        <li>
                            <a href="{{ route('admin.trainings.index') }}"
                                class="{{ request()->routeIs(['admin.trainings.index', 'admin.trainings.*']) ? 'mm-active' : '' }}">Trainings</a>
                        </li>
                    @endcan -->
                    @can('services read')
                        <li>
                            <a href="{{ route('admin.services.index') }}"
                                class="{{ request()->routeIs(['admin.services.index', 'admin.services.*']) ? 'mm-active' : '' }}">Services</a>
                        </li>
                    @endcan
                    @can('whyus read')
                        <li>
                            <a href="{{ route('admin.whyus.index') }}"
                                class="{{ request()->routeIs(['admin.whyus.index', 'admin.whyus.*']) ? 'mm-active' : '' }}">Why Us</a>
                        </li>
                    @endcan
                    @can('clients read')
                        <li>
                            <a href="{{ route('admin.clients.index') }}"
                                class="{{ request()->routeIs(['admin.clients.index', 'admin.clients.*']) ? 'mm-active' : '' }}">Clients</a>
                        </li>
                    @endcan
                    @can('about read')
                        <li>
                            <a href="{{ route('admin.abouts.index') }}"
                                class="{{ request()->routeIs(['admin.abouts.index', 'admin.abouts.*']) ? 'mm-active' : '' }}">About Pages</a>
                        </li>
                    @endcan
                    @can('feedback read')
                        <li>
                            <a href="{{ route('admin.feedback.index') }}"
                                class="{{ request()->routeIs(['admin.feedback.index', 'admin.feedback.*']) ? 'mm-active' : '' }}">Feedback</a>
                        </li>
                    @endcan
                    @can('application form access')
                        @if (Route::has('admin.application.form.any'))
                            <li>
                                <a href="{{ route('admin.application.form.any') }}"
                                    class="{{ request()->routeIs(['admin.application.form.any']) ? 'mm-active' : '' }}">Application
                                    Form</a>
                            </li>
                        @endif
                    @endcan
                    @can('blogs read')
                        @if (Route::has('admin.blogs.index'))
                            <li>
                                <a href="{{ route('admin.blogs.index') }}"
                                    class="{{ request()->routeIs(['admin.blogs.index', 'admin.blogs.*']) ? 'mm-active' : '' }}">Blogs
                                    / News</a>
                            </li>
                        @endif
                    @endcan
                    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                        <ul aria-expanded="false">
                            <li><a href="email-compose.html">Compose</a></li>
                            <li><a href="email-inbox.html">Inbox</a></li>
                            <li><a href="email-read.html">Read</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li><a href="app-calender.html">Calendar</a></li> --}}
                    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                        <ul aria-expanded="false">
                            <li><a href="ecom-product-grid.html">Product Grid</a></li>
                            <li><a href="ecom-product-list.html">Product List</a></li>
                            <li><a href="ecom-product-detail.html">Product Details</a></li>
                            <li><a href="ecom-product-order.html">Order</a></li>
                            <li><a href="ecom-checkout.html">Checkout</a></li>
                            <li><a href="ecom-invoice.html">Invoice</a></li>
                            <li><a href="ecom-customers.html">Customers</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </li>
            {{-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-controls-3"></i>
                    <span class="nav-text">Charts</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="chart-flot.html">Flot</a></li>
                    <li><a href="chart-morris.html">Morris</a></li>
                    <li><a href="chart-chartjs.html">Chartjs</a></li>
                    <li><a href="chart-chartist.html">Chartist</a></li>
                    <li><a href="chart-sparkline.html">Sparkline</a></li>
                    <li><a href="chart-peity.html">Peity</a></li>
                </ul>
            </li> --}}
            {{-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-internet"></i>
                    <span class="nav-text">Bootstrap</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="ui-accordion.html">Accordion</a></li>
                    <li><a href="ui-alert.html">Alert</a></li>
                    <li><a href="ui-badge.html">Badge</a></li>
                    <li><a href="ui-button.html">Button</a></li>
                    <li><a href="ui-modal.html">Modal</a></li>
                    <li><a href="ui-button-group.html">Button Group</a></li>
                    <li><a href="ui-list-group.html">List Group</a></li>
                    <li><a href="ui-media-object.html">Media Object</a></li>
                    <li><a href="ui-card.html">Cards</a></li>
                    <li><a href="ui-carousel.html">Carousel</a></li>
                    <li><a href="ui-dropdown.html">Dropdown</a></li>
                    <li><a href="ui-popover.html">Popover</a></li>
                    <li><a href="ui-progressbar.html">Progressbar</a></li>
                    <li><a href="ui-tab.html">Tab</a></li>
                    <li><a href="ui-typography.html">Typography</a></li>
                    <li><a href="ui-pagination.html">Pagination</a></li>
                    <li><a href="ui-grid.html">Grid</a></li>

                </ul>
            </li> --}}
            {{-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-heart"></i>
                    <span class="nav-text">Plugins</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="uc-select2.html">Select 2</a></li>
                    <li><a href="uc-nestable.html">Nestedable</a></li>
                    <li><a href="uc-noui-slider.html">Noui Slider</a></li>
                    <li><a href="uc-sweetalert.html">Sweet Alert</a></li>
                    <li><a href="uc-toastr.html">Toastr</a></li>
                    <li><a href="map-jqvmap.html">Jqv Map</a></li>
                    <li><a href="uc-lightgallery.html">Lightgallery</a></li>
                </ul>
            </li> --}}
            {{-- <li><a href="widget-basic.html" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Widget</span>
                </a>
            </li> --}}
            {{-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Forms</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="form-element.html">Form Elements</a></li>
                    <li><a href="form-wizard.html">Wizard</a></li>
                    <li><a href="form-editor-summernote.html">Summernote</a></li>
                    <li><a href="form-pickers.html">Pickers</a></li>
                    <li><a href="form-validation-jquery.html">Jquery Validate</a></li>
                </ul>
            </li> --}}
            {{-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-network"></i>
                    <span class="nav-text">Table</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                    <li><a href="table-datatable-basic.html">Datatable</a></li>
                </ul>
            </li> --}}
            {{-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-layer-1"></i>
                    <span class="nav-text">Pages</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="page-register.html">Register</a></li>
                    <li><a href="page-login.html">Login</a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                        <ul aria-expanded="false">
                            <li><a href="page-error-400.html">Error 400</a></li>
                            <li><a href="page-error-403.html">Error 403</a></li>
                            <li><a href="page-error-404.html">Error 404</a></li>
                            <li><a href="page-error-500.html">Error 500</a></li>
                            <li><a href="page-error-503.html">Error 503</a></li>
                        </ul>
                    </li>
                    <li><a href="page-lock-screen.html">Lock Screen</a></li>
                </ul>
            </li> --}}
        </ul>
        <div class="copyright">
            <p><strong>Acara Ticketing Dashboard</strong> © 2021 All Rights Reserved</p>
            <p>Made with <span class="heart"></span> by DexignZone</p>
        </div>
    </div>
</div>

<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            @can( 'admin.vendor' )
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/vendors') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.vendor.title') }}
                </a></li>
            @endcan


            @can( 'admin.contact' )
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/contacts') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.contact.title') }}
                    </a></li>
            @endcan

            @can( 'admin.project' )
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/projects') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.project.title') }}
                    </a></li>
            @endcan
             <li class="nav-item"><a class="nav-link" href="{{ url('admin/vendor-payment-terms') }}"><i class="nav-icon icon-book-open"></i> {{ trans('admin.vendor-payment-term.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/leave-requests') }}"><i class="nav-icon icon-puzzle"></i> {{ trans('admin.leave-request.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/timesheets') }}"><i class="nav-icon icon-puzzle"></i> {{ trans('admin.timesheet.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/purchase-orders') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.purchase-order.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/tasks') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.task.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/templates') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.template.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}


        <!-- Management -->
            <li class="nav-item">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">{{ trans('admin.sidebar.management') }}</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/payment-terms') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.payment-term.title') }}
                        </a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/remittance-infos') }}"><i class="nav-icon icon-star"></i> {{ trans('admin.remittance-info.title') }}
                        </a></li>


                    @can( 'admin.customer-category' )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/customer-categories') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.customer-category.title') }}
                            </a></li>
                    @endcan

                    @can( 'admin.vendor-category' )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/vendor-categories') }}"><i class="nav-icon icon-magnet"></i> {{ trans('admin.vendor-category.title') }}
                            </a></li>
                    @endcan

                    @can( 'admin.orientation' )
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/orientations') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.orientation.title') }}
                            </a></li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/letter-heads') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.letter-head.title') }}
                        </a></li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/project-types') }}"><i class="nav-icon icon-umbrella"></i> {{ trans('admin.project-type.title') }}
                        </a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/vendor-notes') }}"><i class="nav-icon icon-graduation"></i> {{ trans('admin.vendor-note.title') }}
                        </a></li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/email-templates') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.email-template.title') }}
                        </a></li>
                </ul>
            </li>




        @canany([ 'admin.setting', 'admin.access-log', 'admin.admin-user', 'admin.translation.index' ] )
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            @endcanany

            @can( 'admin.admin-user.index' )
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage users') }}
                </a></li>
            @endcan

            @can( 'admin.role' )
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/roles') }}"><i class="nav-icon icon-user"></i> {{ trans('admin.role.title') }}
                    </a></li>
            @endcan

        @can( 'admin.translation.index' )
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}
                </a></li>
            @endcan

            @can( 'admin.setting' )
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/settings') }}"><i class="nav-icon icon-settings"></i> {{ trans('admin.setting.title') }}
                </a></li>
            @endcan

            @can( 'admin.access-log' )
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/access-logs') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.access-log.title') }}</a>
                </li>
            @endcan
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

<a href="{{ url('admin') }}" class="navbar-brand">
    {{-- You may use plain text as a logo instead of image --}}
    <img src="{{ $logo }}" alt="Craftable">

    {{--Text Logo--}}

</a>

@if ( request()->routeIs( [ 'admin/projects/*' ] ) )
{{--<ul class="nav navbar-nav ml-auto">--}}
{{--    <li class="nav-item">--}}
{{--        <a role="button" class="nav-link"><span>RFQ</span></a>--}}
{{--    </li>--}}

{{--    <li class="nav-item">--}}
{{--        <a role="button" class="nav-link"><span>PCQ</span></a>--}}
{{--    </li>--}}

{{--    <li class="nav-item">--}}
{{--        <a role="button" class="nav-link"><span>FCQ</span></a>--}}
{{--    </li>--}}

{{--    <li class="nav-item">--}}
{{--        <a role="button" class="nav-link"><span>JCP</span></a>--}}
{{--    </li>--}}

{{--    <li class="nav-item">--}}
{{--        <a role="button" class="nav-link"><span>PO</span></a>--}}
{{--    </li>--}}

{{--    <li class="nav-item">--}}
{{--        <a role="button" class="nav-link"><span>Misc PO</span></a>--}}
{{--    </li>--}}

{{--    <li class="nav-item">--}}
{{--        <a role="button" class="nav-link"><span>AA</span></a>--}}
{{--    </li>--}}

{{--    <li class="nav-item">--}}
{{--        <a role="button" class="nav-link"><span>JCW</span></a>--}}
{{--    </li>--}}
{{--</ul>--}}
@endif

<div id="notifications">
{{--    <a href="#" @click.prevent="shouldShow = !shouldShow" role="button"><i class="fa fa-bell"></i></a>--}}
{{--    <ul ref="notification_dropdown" :class="{show: shouldShow}" class="dropdown-menu notify-drop notifications-widget">--}}
{{--        <vk-tabs>--}}
{{--            <vk-tabs-item title="General">--}}
{{--                <div class="font-italic text-center p-4">There are no items.</div>--}}
{{--            </vk-tabs-item>--}}
{{--            <vk-tabs-item title="Awaiting Approval (1)">--}}
{{--               <div class="p-4" style="max-height: 400px;overflow-y:auto;">--}}
{{--                    <ul class="list-unstyled">--}}
{{--                        <li>--}}
{{--                            <a href="#">Test Project is awaiting RFQ approval</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--               </div>--}}
{{--            </vk-tabs-item>--}}

{{--        </vk-tabs>--}}
{{--    </ul>--}}
</div>
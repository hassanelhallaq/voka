<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Search-->
    <div class="app-navbar-item align-items-stretch ms-1 ms-md-3">
        @include(config('settings.KT_THEME_LAYOUT_DIR') . '/partials/sidebar-layout/search/_dropdown')
    </div>
    <!--end::Search-->

    <!--end::Activities-->
    <!--begin::Notifications-->

    <!--end::Theme mode-->
    <!--begin::User menu-->
    <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            <img src="{{ image('avatars/300-1.jpg') }}" alt="user" />
        </div>
        {{-- @include('partials/menus/_user-account-menu') --}}
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Header menu toggle-->

    <!--end::Header menu toggle-->
</div>
<!--end::Navbar-->

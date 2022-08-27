{{--<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">--}}

{{--    <div class="c-sidebar-brand d-md-down-none">--}}
{{--        <a class="c-sidebar-brand-full h4" href="#">--}}
{{--            {{ trans('panel.site_title') }}--}}
{{--        </a>--}}
{{--    </div>--}}
    <nav class="navbar navbar-vertical fixed-start navbar-expand-md navbar-light no-print" id="sidebar">
        <div class="container-fluid">

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="{{ route("admin.home") }}">
                <img src="{{asset('assets/img/logo.svg')}}" class="navbar-brand-img mx-auto" alt="{{ trans('panel.site_title') }}">
            </a>

            <!-- User (xs) -->
            <div class="navbar-user d-md-none">

                <!-- Dropdown -->
                <div class="dropdown">

                    <!-- Toggle -->
                    <a href="#" id="sidebarIcon" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                            <img src="{{asset('assets/img/avatars/profiles/avatar-1.jpg')}}assets/img/avatars/profiles/avatar-1.jpg" class="avatar-img rounded-circle" alt="...">
                        </div>
                    </a>

                    <!-- Menu -->
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarIcon">
                        <a href="./profile-posts.html" class="dropdown-item">Profile</a>
                        <a href="./account-general.html" class="dropdown-item">Settings</a>
                        <hr class="dropdown-divider">
                        <a href="./sign-in.html" class="dropdown-item">Logout</a>
                    </div>

                </div>

            </div>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">

                <!-- Form -->
                <form class="mt-4 mb-3 d-md-none">
                    <div class="input-group input-group-rounded input-group-merge input-group-reverse">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-text">
                            <span class="fe fe-search"></span>
                        </div>
                    </div>
                </form>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ route("admin.home") }}">
                <img src="{{asset('assets/img/icons/home.svg')}}" style="object-fit: scale-down;" class="me-1 w-10" alt="{{ trans('global.dashboard') }}"> {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('events_management_access')
            <li class="nav-item ">
                <a class="nav-link" href="#eventsManagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="eventsManagement">
{{--                    <i class="fe fe-calendar">--}}

{{--                    </i>--}}
                    <img src="{{asset('assets/img/icons/calendar-tick.svg')}}" style="object-fit: scale-down;" class="me-1 w-10" alt="{{ trans('global.dashboard') }}">
                    {{ trans('cruds.eventsManagement.title') }}
                </a>
                <div class="collapse {{ request()->is("admin/events*") ? "show" : "" }} {{ request()->is("admin/event-addons*") ? "show" : "" }} {{ request()->is("admin/costumes*") ? "show" : "" }} {{ request()->is("admin/costume-attributes*") ? "show" : "" }} {{ request()->is("admin/event-tickets*") ? "show" : "" }}
                {{ request()->is("admin/hotels*") ? "show" : "" }} {{ request()->is("admin/hotel-rooms*") ? "show" : "" }} {{ request()->is("admin/amenities*") ? "show" : "" }}
                    " id="eventsManagement">
                <ul class="nav nav-sm flex-column">
                    @can('event_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "active" : "" }}">
{{--                                <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.event.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('event_addon_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.event-addons.index") }}" class="nav-link {{ request()->is("admin/event-addons") || request()->is("admin/event-addons/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.eventAddon.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('costume_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.costumes.index") }}" class="nav-link {{ request()->is("admin/costumes") || request()->is("admin/costumes/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-female c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.costume.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('costume_attribute_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.costume-attributes.index") }}" class="nav-link {{ request()->is("admin/costume-attributes") || request()->is("admin/costume-attributes/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-female c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.costumeAttribute.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('event_ticket_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.event-tickets.index") }}" class="nav-link {{ request()->is("admin/event-tickets") || request()->is("admin/event-tickets/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-ticket-alt c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.eventTicket.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('package_amenity_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.package-amenities.index") }}" class="nav-link {{ request()->is("admin/package-amenities") || request()->is("admin/package-amenities/*") ? "c-active" : "" }}">
{{--                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.packageAmenity.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('booking_access')
                            <li class="nav-item ">
                                <a class="nav-link" href="#booking" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="booking">
{{--                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.booking.title') }}
                            </a>
                                <div class="collapse {{ request()->is("admin/event-bookings*") ? "show" : "" }}" id="booking">
                                    <ul class="nav nav-sm flex-column">
                                        @can('event_booking_access')
                                            <li class="nav-item">
                                                <a href="{{ route("admin.event-bookings.index") }}" class="nav-link {{ request()->is("admin/event-bookings") || request()->is("admin/event-bookings/*") ? "active" : "" }}">
{{--                                                    <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">--}}

{{--                                                    </i>--}}
                                                    {{ trans('cruds.eventBooking.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                            @can('traveler_access')
                                                <li class="nav-item">
                                                    <a href="{{ route("admin.travelers.index") }}" class="nav-link {{ request()->is("admin/travelers") || request()->is("admin/travelers/*") ? "active" : "" }}">
{{--                                                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                                        </i>--}}
                                                        {{ trans('cruds.traveler.title') }}
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('payment_access')
                                                <li class="nav-item">
                                                    <a href="{{ route("admin.payments.index") }}" class="nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "active" : "" }}">
{{--                                                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                                        </i>--}}
                                                        {{ trans('cruds.payment.title') }}
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('testimonial_access')
                                                <li class="nav-item">
                                                    <a href="{{ route("admin.testimonials.index") }}" class="nav-link {{ request()->is("admin/testimonials") || request()->is("admin/testimonials/*") ? "active" : "" }}">
{{--                                                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                                        </i>--}}
                                                        {{ trans('cruds.testimonial.title') }}
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('booking_room_access')
                                                <li class="nav-item">
                                                    <a href="{{ route("admin.booking-rooms.index") }}" class="nav-link {{ request()->is("admin/booking-rooms") || request()->is("admin/booking-rooms/*") ? "active" : "" }}">
{{--                                                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                                        </i>--}}
                                                        {{ trans('cruds.bookingRoom.title') }}
                                                    </a>
                                                </li>
                                            @endcan
                                    </ul>
                                </div>
                        </li>
                    @endcan
                        @can('hotels_management_access')
{{--                            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/hotels*") ? "show" : "" }} {{ request()->is("admin/hotel-rooms*") ? "show" : "" }} {{ request()->is("admin/amenities*") ? "show" : "" }}">--}}
{{--                                <a class="c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.hotelsManagement.title') }}--}}
{{--                                </a>--}}
{{--                                <ul class="c-sidebar-nav-dropdown-items">--}}
                                    <li class="nav-item ">
                                        <a class="nav-link" href="#hotelsManagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="hotelsManagement">
                                            {{--                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">--}}

                                            {{--                                </i>--}}
                                            {{ trans('cruds.hotelsManagement.title') }}
                                        </a>
                                        <div class="collapse {{ request()->is("admin/hotels*") ? "show" : "" }} {{ request()->is("admin/hotel-rooms*") ? "show" : "" }} {{ request()->is("admin/amenities*") ? "show" : "" }}" id="hotelsManagement">
                                            <ul class="nav nav-sm flex-column">
                                    @can('hotel_access')
                                        <li class="nav-item">
                                            <a href="{{ route("admin.hotels.index") }}" class="nav-link {{ request()->is("admin/hotels") || request()->is("admin/hotels/*") ? "c-active" : "" }}">
{{--                                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                                </i>--}}
                                                {{ trans('cruds.hotel.title') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @can('hotel_room_access')
                                        <li class="nav-item">
                                            <a href="{{ route("admin.hotel-rooms.index") }}" class="nav-link {{ request()->is("admin/hotel-rooms") || request()->is("admin/hotel-rooms/*") ? "c-active" : "" }}">
{{--                                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                                </i>--}}
                                                {{ trans('cruds.hotelRoom.title') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @can('amenity_access')
                                        <li class="nav-item">
                                            <a href="{{ route("admin.amenities.index") }}" class="nav-link {{ request()->is("admin/amenities") || request()->is("admin/amenities/*") ? "c-active" : "" }}">
{{--                                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                                                </i>--}}
                                                {{ trans('cruds.amenity.title') }}
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                </ul>
                </div>
            </li>
        @endcan
        @can('user_management_access')
            <li class="nav-item ">
                <a class="nav-link" href="#userManagement" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="userManagement">
{{--                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">--}}

{{--                    </i> &nbsp;--}}
                    <img src="{{asset('assets/img/icons/profile-2user.svg')}}" style="object-fit: scale-down;" class="me-1 w-10" alt="{{ trans('cruds.userManagement.title') }}">
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <div class="collapse {{ request()->is("admin/permissions*") ? "show" : "" }} {{ request()->is("admin/roles*") ? "show" : "" }} {{ request()->is("admin/users*") ? "show" : "" }} {{ request()->is("admin/admins*") ? "show" : "" }}" id="userManagement">
                <ul class="nav nav-sm flex-column">
                    @can('permission_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('admin_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.admins.index") }}" class="nav-link {{ request()->is("admin/admins") || request()->is("admin/admins/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-user-shield c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.admin.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
                </div>
            </li>
        @endcan
        @canany(['content_management_access','faq_management_access','blog_access'])
        <li class="nav-item ">
            <a class="nav-link" href="#website" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="website">
{{--                <i class="fa-fw far fa-address-book c-sidebar-nav-icon">--}}

{{--                </i> &nbsp;--}}
                <img src="{{asset('assets/img/icons/global-edit.svg')}}" style="object-fit: scale-down;" class="me-1 w-10" alt="{{ trans('cruds.website.title') }}">
                {{ trans('cruds.website.title') }}
            </a>
            <div class="collapse
                {{ request()->is("admin/content-categories*") ? "show" : "" }} {{ request()->is("admin/content-tags*") ? "show" : "" }} {{ request()->is("admin/content-pages*") ? "show" : "" }}
                {{ request()->is("admin/faq-categories*") ? "show" : "" }} {{ request()->is("admin/faq-questions*") ? "show" : "" }}
                {{ request()->is("admin/blog-categories*") ? "show" : "" }} {{ request()->is("admin/blog-tags*") ? "show" : "" }} {{ request()->is("admin/blog-posts*") ? "show" : "" }}
            {{ request()->is("admin/settings/*") ? "active" : "" }}  " id="website">
                <ul class="nav nav-sm flex-column">
        @can('content_management_access')
            <li class="nav-item ">
                <a class="nav-link" href="#contentManagement" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="contentManagement">
{{--                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">--}}

{{--                    </i> &nbsp;--}}
                    {{ trans('cruds.contentManagement.title') }}
                </a>
                <div class="collapse {{ request()->is("admin/content-categories*") ? "show" : "" }} {{ request()->is("admin/content-tags*") ? "show" : "" }} {{ request()->is("admin/content-pages*") ? "show" : "" }}" id="contentManagement">
                <ul class="nav nav-sm flex-column">
                    @can('content_category_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.content-categories.index") }}" class="nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.contentCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_tag_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.content-tags.index") }}" class="nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.contentTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_page_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.content-pages.index") }}" class="nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.contentPage.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
                </div>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="nav-item ">
                <a class="nav-link" href="#faqManagement" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="faqManagement">
{{--                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">--}}

{{--                    </i> &nbsp;--}}
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <div class="collapse
{{ request()->is("admin/faq-categories*") ? "show" : "" }} {{ request()->is("admin/faq-questions*") ? "show" : "" }}
                    " id="faqManagement">
                <ul class="nav nav-sm flex-column">
                    @can('faq_category_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
                </div>
            </li>
        @endcan
        @can('blog_access')
            <li class="nav-item ">
                <a class="nav-link" href="#blog" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="blog">
{{--                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">--}}

{{--                    </i> &nbsp;--}}
                    {{ trans('cruds.blog.title') }}
                </a>
                <div class="collapse
{{ request()->is("admin/blog-categories*") ? "show" : "" }} {{ request()->is("admin/blog-tags*") ? "show" : "" }} {{ request()->is("admin/blog-posts*") ? "show" : "" }}
                    " id="blog">
                <ul class="nav nav-sm flex-column">
                    @can('blog_category_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.blog-categories.index") }}" class="nav-link {{ request()->is("admin/blog-categories") || request()->is("admin/blog-categories/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.blogCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('blog_tag_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.blog-tags.index") }}" class="nav-link {{ request()->is("admin/blog-tags") || request()->is("admin/blog-tags/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.blogTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('blog_post_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.blog-posts.index") }}" class="nav-link {{ request()->is("admin/blog-posts") || request()->is("admin/blog-posts/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.blogPost.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
                </div>
            </li>
        @endcan
            @can('setting_access')
                <li class="nav-item">
                    <a href="{{ route("admin.settings.index") }}" class="nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "active" : "" }}">
{{--                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                        </i>--}}
                        {{ trans('cruds.setting.title') }}
                    </a>
                </li>
            @endcan
                </ul>
            </div>
        </li>
        @endcan
        @can('address_access')
            <li class="nav-item ">
                <a class="nav-link" href="#address" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="address">
{{--                    <i class="fa-fw far fa-address-book c-sidebar-nav-icon">--}}

{{--                    </i> &nbsp;--}}
                    <img src="{{asset('assets/img/icons/routing.svg')}}" style="object-fit: scale-down;" class="me-1 w-10" alt="{{ trans('cruds.address.title') }}">
                    {{ trans('cruds.address.title') }}
                </a>
                <div class="collapse {{ request()->is("admin/countries*") ? "show" : "" }} {{ request()->is("admin/states*") ? "show" : "" }} {{ request()->is("admin/cities*") ? "show" : "" }}" id="address">
                    <ul class="nav nav-sm flex-column">
                    @can('country_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-flag c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('state_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.states.index") }}" class="nav-link {{ request()->is("admin/states") || request()->is("admin/states/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-address-card c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.state.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('city_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.cities.index") }}" class="nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "active" : "" }}">
{{--                                <i class="fa-fw fas fa-bookmark c-sidebar-nav-icon">--}}

{{--                                </i>--}}
                                {{ trans('cruds.city.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
                </div>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
{{--                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">--}}
{{--                        </i> &nbsp;--}}
                        <img src="{{asset('assets/img/icons/key.svg')}}" style="object-fit: scale-down;" class="me-1 w-10" alt="{{ trans('global.change_password') }}">
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
{{--                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">--}}

{{--                </i> &nbsp;--}}
                <img src="{{asset('assets/img/icons/logout.svg')}}" style="object-fit: scale-down;" class="me-1 w-10" alt="{{ trans('global.logout') }}">
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
        </div>
    </nav>

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
        @can('events_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/events*") ? "c-show" : "" }} {{ request()->is("admin/event-addons*") ? "c-show" : "" }} {{ request()->is("admin/costumes*") ? "c-show" : "" }} {{ request()->is("admin/costume-attributes*") ? "c-show" : "" }} {{ request()->is("admin/event-tickets*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.eventsManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('event_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.events.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.event.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('event_addon_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.event-addons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/event-addons") || request()->is("admin/event-addons/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.eventAddon.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('costume_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.costumes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/costumes") || request()->is("admin/costumes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-female c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.costume.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('costume_attribute_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.costume-attributes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/costume-attributes") || request()->is("admin/costume-attributes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-female c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.costumeAttribute.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('event_ticket_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.event-tickets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/event-tickets") || request()->is("admin/event-tickets/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-ticket-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.eventTicket.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('booking_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/event-bookings*") ? "c-show" : "" }} {{ request()->is("admin/travelers*") ? "c-show" : "" }} {{ request()->is("admin/payments*") ? "c-show" : "" }} {{ request()->is("admin/testimonials*") ? "c-show" : "" }} {{ request()->is("admin/booking-rooms*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.booking.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('event_booking_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.event-bookings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/event-bookings") || request()->is("admin/event-bookings/*") ? "c-active" : "" }}">
                                            <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.eventBooking.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('traveler_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.travelers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/travelers") || request()->is("admin/travelers/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.traveler.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('payment_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.payments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.payment.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('testimonial_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.testimonials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/testimonials") || request()->is("admin/testimonials/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.testimonial.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('booking_room_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.booking-rooms.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/booking-rooms") || request()->is("admin/booking-rooms/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.bookingRoom.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('hotels_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/hotels*") ? "c-show" : "" }} {{ request()->is("admin/hotel-rooms*") ? "c-show" : "" }} {{ request()->is("admin/amenities*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.hotelsManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('hotel_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.hotels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/hotels") || request()->is("admin/hotels/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.hotel.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('hotel_room_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.hotel-rooms.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/hotel-rooms") || request()->is("admin/hotel-rooms/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.hotelRoom.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('amenity_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.amenities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/amenities") || request()->is("admin/amenities/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.amenity.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/admins*") ? "c-show" : "" }}">
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
                    @can('admin_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.admins.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/admins") || request()->is("admin/admins/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-shield c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.admin.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('content_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/content-pages*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('content_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentPage.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('blog_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/blog-categories*") ? "c-show" : "" }} {{ request()->is("admin/blog-tags*") ? "c-show" : "" }} {{ request()->is("admin/blog-posts*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.blog.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('blog_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.blog-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/blog-categories") || request()->is("admin/blog-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.blogCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('blog_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.blog-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/blog-tags") || request()->is("admin/blog-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.blogTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('blog_post_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.blog-posts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/blog-posts") || request()->is("admin/blog-posts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.blogPost.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('address_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/countries*") ? "c-show" : "" }} {{ request()->is("admin/states*") ? "c-show" : "" }} {{ request()->is("admin/cities*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-address-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.address.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('country_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('state_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.states.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/states") || request()->is("admin/states/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-address-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.state.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('city_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bookmark c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.city.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
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
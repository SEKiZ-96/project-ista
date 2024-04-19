{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<x-backpack::menu-item title="Teachers" icon="la la-shield" :link="backpack_url('teacher')" />
<x-backpack::menu-item title="Groups" icon="la la-users" :link="backpack_url('group')" />
<x-backpack::menu-item title="Rooms" icon="la la-university" :link="backpack_url('room')" />
<x-backpack::menu-item title="Time schedules" icon="la la-calendar" :link="backpack_url('time-schedule')" />
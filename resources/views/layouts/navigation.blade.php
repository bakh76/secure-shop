<nav x-data="{ open: false }" class="bg-white border-b border-slate-100 sticky top-0 z-50">
    <!-- Gradient Top Border -->
    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @php
                        // Determine the dashboard route based on role
                        $dashboardRoute = 'login'; // Fallback
                        if(Auth::check()) {
                            $dashboardRoute = Auth::user()->role === 'admin' ? 'admin.dashboard' : 'dashboard';
                        }
                    @endphp
                    <a href="{{ route($dashboardRoute) }}" class="flex items-center gap-2 group">
                        <x-application-logo class="block h-9 w-auto fill-current text-indigo-600 group-hover:text-purple-600 transition-colors" />
                        <span class="font-bold text-xl tracking-tight text-slate-800 group-hover:text-slate-900">SecureShop</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::check())
                        <!-- Dashboard Link -->
                        <x-nav-link :href="route($dashboardRoute)" :active="request()->routeIs($dashboardRoute)" class="text-sm font-medium transition-colors hover:text-indigo-600 active:text-indigo-700">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <!-- User Specific Links (Cart & Orders) -->
                        @if(Auth::user()->role === 'user')
                            <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')" class="text-sm font-medium transition-colors hover:text-indigo-600">
                                {{ __('Shopping Cart') }}
                            </x-nav-link>

                            <x-nav-link :href="route('user.orders')" :active="request()->routeIs('user.orders')" class="text-sm font-medium transition-colors hover:text-indigo-600">
                                {{ __('My Orders') }}
                            </x-nav-link>
                        @endif

                        <!-- Admin Specific Links -->
                        @if(Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" class="text-sm font-medium transition-colors hover:text-indigo-600">
                                {{ __('Manage Products') }}
                            </x-nav-link>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if(Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 bg-white hover:text-indigo-600 focus:outline-none transition ease-in-out duration-150">
                                <div class="font-semibold">{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-slate-100 mb-1">
                                <p class="text-xs text-slate-400">Signed in as</p>
                                <p class="text-sm font-bold text-slate-700 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-indigo-50 hover:text-indigo-600">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="hover:bg-rose-50 hover:text-rose-600">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 focus:text-slate-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-50 border-t border-slate-200">
        @if(Auth::check())
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route($dashboardRoute)" :active="request()->routeIs($dashboardRoute)">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                
                @if(Auth::user()->role === 'user')
                    <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                        {{ __('Shopping Cart') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.orders')" :active="request()->routeIs('user.orders')">
                        {{ __('My Orders') }}
                    </x-responsive-nav-link>
                @endif

                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')">
                        {{ __('Manage Products') }}
                    </x-responsive-nav-link>
                @endif
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-slate-200">
                <div class="px-4">
                    <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endif
    </div>
</nav>
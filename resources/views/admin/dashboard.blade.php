<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200 relative">
                <!-- Gradient Top Border -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                
                <div class="p-8">
                    <div class="flex items-center gap-5 mb-6">
                        <div class="h-14 w-14 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm ring-4 ring-indigo-50/50">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Welcome, Admin!</h3>
                            <p class="text-slate-500">You have full control over the platform settings and products.</p>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-slate-100 pt-8">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-6">Quick Actions</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Manage Products Card -->
                            <a href="{{ route('admin.products.index') }}" class="group relative block p-6 bg-white border border-slate-200 rounded-2xl hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-50 transition-all duration-300">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="h-12 w-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </div>
                                    <span class="text-slate-300 group-hover:text-blue-500 transition-colors">
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </span>
                                </div>
                                <h5 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">Manage Products</h5>
                                <p class="text-sm text-slate-500 leading-relaxed">Add new items, update prices, or remove products from your catalog.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
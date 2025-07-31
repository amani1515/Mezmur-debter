<template>
    <div class="min-h-screen bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-100">
        <!-- Header -->
        <header class="bg-gradient-to-r from-amber-600 via-yellow-600 to-orange-600 shadow-2xl">
            <div class="flex justify-between items-center px-4 py-3">
                <div class="flex items-center space-x-3">
                    <!-- Mobile Menu Button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-white hover:text-yellow-200 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-200 to-amber-300 rounded-full flex items-center justify-center shadow-lg border-2 border-yellow-300">
                        <span class="text-amber-800 font-bold text-lg">ደ</span>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-lg font-bold text-white drop-shadow-lg">ደቂቀ ብርሀን</h1>
                        <p class="text-yellow-200 text-xs">Dekike Brhan</p>
                    </div>
                </div>
                
                <!-- Profile Dropdown -->
                <div class="relative">
                    <button @click="showProfileDropdown = !showProfileDropdown" class="flex items-center space-x-2 text-white hover:text-yellow-200 bg-gradient-to-r from-amber-700 to-yellow-700 hover:from-amber-600 hover:to-yellow-600 px-3 py-2 rounded-lg transition-all shadow-lg">
                        <img :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" class="w-7 h-7 rounded-full border-2 border-yellow-300">
                        <span class="font-medium text-sm hidden sm:block">{{ $page.props.auth.user.name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div v-show="showProfileDropdown" @click.away="showProfileDropdown = false" class="absolute right-0 mt-2 w-48 bg-gradient-to-br from-yellow-50 to-amber-50 rounded-lg shadow-2xl py-2 z-50 border border-amber-200">
                        <Link :href="route('profile.show')" class="block px-4 py-3 text-sm text-amber-800 hover:bg-gradient-to-r hover:from-yellow-100 hover:to-amber-100 hover:text-amber-900 transition-all font-medium">Settings</Link>
                        <form @submit.prevent="logout">
                            <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-amber-800 hover:bg-gradient-to-r hover:from-yellow-100 hover:to-amber-100 hover:text-amber-900 transition-all font-medium">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex relative">
            <!-- Mobile Overlay -->
            <div v-if="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>
            
            <!-- Sidebar -->
            <aside :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', 'fixed lg:relative lg:translate-x-0 w-64 bg-gradient-to-b from-amber-100 via-yellow-100 to-orange-100 shadow-2xl min-h-screen border-r border-amber-300 z-50 transition-transform duration-300']">
                <nav class="mt-6">
                    <div class="px-3 space-y-2">
                        <Link :href="route('dashboard')" class="flex items-center px-4 py-4 text-amber-900 bg-gradient-to-r from-yellow-300 to-amber-400 hover:from-yellow-400 hover:to-amber-500 rounded-lg font-bold shadow-lg transition-all">
                            <span class="text-sm">Dashboard</span>
                        </Link>
                        <Link :href="route('admin.users')" class="flex items-center px-4 py-4 text-amber-800 hover:bg-gradient-to-r hover:from-yellow-200 hover:to-amber-300 hover:text-amber-900 rounded-lg font-semibold transition-all">
                            <span class="text-sm">Users</span>
                        </Link>
                        <Link :href="route('admin.categories')" class="flex items-center px-4 py-4 text-amber-800 hover:bg-gradient-to-r hover:from-yellow-200 hover:to-amber-300 hover:text-amber-900 rounded-lg font-semibold transition-all">
                            <span class="text-sm">Categories</span>
                        </Link>
                        <Link :href="route('admin.subcategories')" class="flex items-center px-4 py-4 text-amber-800 hover:bg-gradient-to-r hover:from-yellow-200 hover:to-amber-300 hover:text-amber-900 rounded-lg font-semibold transition-all">
                            <span class="text-sm">Sub Categories</span>
                        </Link>
                        <Link href="#" class="flex items-center px-4 py-4 text-amber-800 hover:bg-gradient-to-r hover:from-yellow-200 hover:to-amber-300 hover:text-amber-900 rounded-lg font-semibold transition-all">
                            <span class="text-sm">Poems</span>
                        </Link>
                    </div>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-4 lg:p-8">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    title: String,
});

const showProfileDropdown = ref(false);
const sidebarOpen = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>
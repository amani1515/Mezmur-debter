<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="flex justify-between items-center px-6 py-4">
                <h1 class="text-xl font-semibold text-gray-800">{{ title }}</h1>
                
                <!-- Profile Dropdown -->
                <div class="relative">
                    <button @click="showProfileDropdown = !showProfileDropdown" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                        <img :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" class="w-8 h-8 rounded-full">
                        <span>{{ $page.props.auth.user.name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div v-show="showProfileDropdown" @click.away="showProfileDropdown = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <Link :href="route('profile.show')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</Link>
                        <form @submit.prevent="logout">
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-sm min-h-screen">
                <nav class="mt-8">
                    <div class="px-4 space-y-2">
                        <Link :href="route('dashboard')" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                            <span>Dashboard</span>
                        </Link>
                        <Link href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                            <span>Users</span>
                        </Link>
                        <Link href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                            <span>Categories</span>
                        </Link>
                        <Link href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                            <span>Sub Categories</span>
                        </Link>
                        <Link href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                            <span>Poems</span>
                        </Link>
                    </div>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-8">
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

const logout = () => {
    router.post(route('logout'));
};
</script>
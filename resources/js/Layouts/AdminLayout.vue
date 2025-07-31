<template>
    <div class="min-h-screen bg-blue-50">
        <!-- Header -->
        <header class="bg-blue-600 shadow-lg">
            <div class="flex justify-between items-center px-6 py-4">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-lg">ደ</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">ደቂቀ ብርሀን</h1>
                        <p class="text-blue-200 text-sm">Dekike Brhan</p>
                    </div>
                </div>
                
                <!-- Profile Dropdown -->
                <div class="relative">
                    <button @click="showProfileDropdown = !showProfileDropdown" class="flex items-center space-x-2 text-white hover:text-blue-200">
                        <img :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" class="w-8 h-8 rounded-full border-2 border-white">
                        <span>{{ $page.props.auth.user.name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div v-show="showProfileDropdown" @click.away="showProfileDropdown = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <Link :href="route('profile.show')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Settings</Link>
                        <form @submit.prevent="logout">
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-lg min-h-screen border-r border-blue-200">
                <nav class="mt-8">
                    <div class="px-4 space-y-2">
                        <Link :href="route('dashboard')" class="flex items-center px-4 py-3 text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg font-medium">
                            <span>Dashboard</span>
                        </Link>
                        <Link :href="route('admin.users')" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg">
                            <span>Users</span>
                        </Link>
                        <Link href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg">
                            <span>Categories</span>
                        </Link>
                        <Link href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg">
                            <span>Sub Categories</span>
                        </Link>
                        <Link href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg">
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

// Close dropdown when clicking outside
const closeDropdown = () => {
    showProfileDropdown.value = false;
};
</script>
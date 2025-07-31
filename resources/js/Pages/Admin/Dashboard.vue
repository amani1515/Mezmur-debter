<template>
    <AdminLayout title="Admin Dashboard">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-medium text-gray-900">
                    Ethiopian Orthodox Poem Management
                </h1>
                <p class="mt-4 text-gray-500 leading-relaxed">
                    Manage categories, subcategories, and poems submitted by users.
                </p>
            </div>

            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-lg font-semibold text-gray-900">Categories</div>
                    <div class="mt-2 text-3xl font-bold text-blue-600">{{ stats.categories }}</div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-lg font-semibold text-gray-900">Subcategories</div>
                    <div class="mt-2 text-3xl font-bold text-green-600">{{ stats.subcategories }}</div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-lg font-semibold text-gray-900">Poems</div>
                    <div class="mt-2 text-3xl font-bold text-purple-600">{{ stats.poems }}</div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    stats: Object,
});
</script>
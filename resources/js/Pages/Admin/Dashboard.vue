<template>
    <AdminLayout title="Admin Dashboard">
        <div class="bg-gradient-to-br from-amber-600 via-yellow-600 to-orange-600 overflow-hidden shadow-2xl rounded-2xl border border-amber-400">
            <div class="p-6 lg:p-8 bg-gradient-to-r from-amber-700 via-yellow-700 to-orange-700 text-white">
                <h1 class="text-3xl font-bold drop-shadow-xl">
                    Ethiopian Orthodox Poem Management
                </h1>
                <p class="mt-4 text-yellow-200 leading-relaxed text-lg">
                    Manage categories, subcategories, and poems submitted by users.
                </p>
            </div>

            <div class="bg-gradient-to-br from-amber-500 via-yellow-500 to-orange-500 grid grid-cols-1 md:grid-cols-3 gap-8 p-8">
                <div class="bg-gradient-to-br from-yellow-100 to-amber-200 p-8 rounded-2xl shadow-2xl border-2 border-amber-300 hover:shadow-3xl transition-all transform hover:-translate-y-2 hover:scale-105">
                    <div class="text-xl font-bold text-amber-900 mb-2">Categories</div>
                    <div class="text-5xl font-bold text-amber-800 drop-shadow-lg">{{ stats.categories }}</div>
                </div>

                <div class="bg-gradient-to-br from-amber-200 to-orange-300 p-8 rounded-2xl shadow-2xl border-2 border-orange-400 hover:shadow-3xl transition-all transform hover:-translate-y-2 hover:scale-105">
                    <div class="text-xl font-bold text-orange-900 mb-2">Subcategories</div>
                    <div class="text-5xl font-bold text-orange-800 drop-shadow-lg">{{ stats.subcategories }}</div>
                </div>

                <div class="bg-gradient-to-br from-orange-200 to-yellow-300 p-8 rounded-2xl shadow-2xl border-2 border-yellow-400 hover:shadow-3xl transition-all transform hover:-translate-y-2 hover:scale-105">
                    <div class="text-xl font-bold text-yellow-900 mb-2">Poems</div>
                    <div class="text-5xl font-bold text-yellow-800 drop-shadow-lg">{{ stats.poems }}</div>
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
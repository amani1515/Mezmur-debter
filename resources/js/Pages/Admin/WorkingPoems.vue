<template>
    <AdminLayout title="Poems">
        <div class="bg-gradient-to-br from-amber-600 via-yellow-600 to-orange-600 overflow-hidden shadow-2xl rounded-xl border border-amber-400">
            <div class="p-4 lg:p-6 bg-gradient-to-r from-amber-700 via-yellow-700 to-orange-700 text-white">
                <div>
                    <h1 class="text-xl lg:text-2xl font-bold drop-shadow-xl">Poems</h1>
                    <p class="mt-2 text-yellow-200 text-sm lg:text-base">Manage submitted poems</p>
                </div>
            </div>
            
            <!-- Search and Filter -->
            <div class="p-4 lg:p-6 bg-gradient-to-r from-amber-600 to-yellow-600 border-t border-amber-500">
                <div class="flex flex-col gap-3">
                    <input 
                        v-model="searchTerm" 
                        @input="performSearch"
                        type="text" 
                        placeholder="Search poems by title or author..." 
                        class="w-full p-2 border border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 text-sm"
                    >
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select 
                            v-model="selectedCategory" 
                            @change="onCategoryChange"
                            class="flex-1 p-2 border border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 text-sm"
                        >
                            <option value="">All Categories</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <select 
                            v-model="selectedSubcategory" 
                            @change="performSearch"
                            class="flex-1 p-2 border border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 text-sm"
                        >
                            <option value="">All Subcategories</option>
                            <option v-for="subcategory in filteredSubcategories" :key="subcategory.id" :value="subcategory.id">
                                {{ subcategory.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-4 lg:p-6 bg-gradient-to-br from-amber-500 via-yellow-500 to-orange-500">
                <div class="bg-gradient-to-br from-yellow-50 to-amber-100 rounded-xl shadow-xl border border-amber-300">
                    <!-- Mobile Cards -->
                    <div class="block sm:hidden">
                        <div v-if="!poems.data || poems.data.length === 0" class="p-8 text-center text-amber-700">
                            No poems found matching your criteria.
                        </div>
                        <div v-else v-for="poem in poems.data" :key="poem.id" class="p-4 border-b border-amber-200 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-bold text-amber-900">{{ poem.title }}</h3>
                                    <p class="text-sm text-amber-700 mt-1">{{ poem.author || 'Anonymous' }}</p>
                                    <p class="text-xs text-amber-600 mt-1">{{ poem.subcategory.category.name }} > {{ poem.subcategory.name }}</p>
                                    <p class="text-xs text-amber-600 mt-1">{{ formatDate(poem.created_at) }}</p>
                                </div>
                                <div class="flex space-x-2 ml-2">
                                    <Link :href="route('admin.poems.show', poem.id)" class="bg-blue-500 text-white p-2 rounded text-xs">
                                        View
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Desktop Table -->
                    <div class="hidden sm:block overflow-x-auto">
                        <div v-if="!poems.data || poems.data.length === 0" class="p-8 text-center text-amber-700">
                            No poems found matching your criteria.
                        </div>
                        <table v-else class="min-w-full divide-y divide-amber-300">
                            <thead class="bg-gradient-to-r from-amber-300 via-yellow-300 to-orange-300">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Title</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Author</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Category</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Subcategory</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Created</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gradient-to-br from-yellow-50 to-amber-100 divide-y divide-amber-200">
                                <tr v-for="poem in poems.data" :key="poem.id" class="hover:bg-gradient-to-r hover:from-yellow-200 hover:to-amber-300 transition-all">
                                    <td class="px-4 py-3 text-sm font-bold text-amber-900">{{ poem.title }}</td>
                                    <td class="px-4 py-3 text-sm text-amber-800">{{ poem.author || 'Anonymous' }}</td>
                                    <td class="px-4 py-3 text-sm text-amber-800">{{ poem.subcategory.category.name }}</td>
                                    <td class="px-4 py-3 text-sm text-amber-800">{{ poem.subcategory.name }}</td>
                                    <td class="px-4 py-3 text-sm text-amber-800">{{ formatDate(poem.created_at) }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex space-x-2">
                                            <Link :href="route('admin.poems.show', poem.id)" class="bg-blue-500 hover:bg-blue-600 text-white p-1 rounded text-xs transition-all" title="View Details">
                                                View
                                            </Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-4 py-3 bg-gradient-to-r from-amber-200 to-yellow-200 border-t border-amber-300 rounded-b-xl">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                            <div class="text-sm text-amber-800">
                                Showing {{ poems.from || 0 }} to {{ poems.to || 0 }} of {{ poems.total }} results
                            </div>
                            <div class="flex space-x-1">
                                <Link 
                                    v-for="link in poems.links" 
                                    :key="link.label" 
                                    :href="link.url" 
                                    :class="[
                                        'px-3 py-1 text-xs font-medium rounded transition-all',
                                        link.active 
                                            ? 'bg-amber-600 text-white' 
                                            : link.url 
                                                ? 'bg-white text-amber-800 hover:bg-amber-100' 
                                                : 'bg-gray-200 text-gray-400 cursor-not-allowed'
                                    ]"
                                    v-html="link.label"
                                ></Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    poems: Object,
    categories: Array,
    subcategories: Array,
    filters: Object,
});

const searchTerm = ref(props.filters?.search || '');
const selectedCategory = ref(props.filters?.category_id || '');
const selectedSubcategory = ref(props.filters?.subcategory_id || '');

let searchTimeout = null;

const filteredSubcategories = computed(() => {
    if (!selectedCategory.value) return props.subcategories;
    return props.subcategories.filter(sub => sub.category_id == selectedCategory.value);
});

const onCategoryChange = () => {
    selectedSubcategory.value = '';
    performSearch();
};

const performSearch = () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(route('admin.poems'), {
            search: searchTerm.value,
            category_id: selectedCategory.value,
            subcategory_id: selectedSubcategory.value
        }, {
            preserveState: true,
            replace: true
        });
    }, 300);
};

const formatDate = (dateStr) => new Date(dateStr).toLocaleDateString();
</script>
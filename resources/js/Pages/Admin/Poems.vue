<template>
    <AdminLayout title="Poems">
        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Poems</h1>

            <!-- Search -->
            <div class="mb-4 space-y-3">
                <input 
                    v-model="searchTerm" 
                    @input="performSearch"
                    type="text" 
                    placeholder="Search poems by title or author..." 
                    class="w-full p-2 border rounded"
                >
                <div class="flex space-x-3">
                    <select 
                        v-model="selectedCategory" 
                        @change="onCategoryChange"
                        class="flex-1 p-2 border rounded"
                    >
                        <option value="">All Categories</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                    <select 
                        v-model="selectedSubcategory" 
                        @change="performSearch"
                        class="flex-1 p-2 border rounded"
                    >
                        <option value="">All Subcategories</option>
                        <option v-for="subcategory in filteredSubcategories" :key="subcategory.id" :value="subcategory.id">
                            {{ subcategory.name }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Author</th>
                            <th class="px-4 py-2 text-left">Category</th>
                            <th class="px-4 py-2 text-left">Subcategory</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="poem in poems.data" :key="poem.id" class="border-t">
                            <td class="px-4 py-2">{{ poem.title }}</td>
                            <td class="px-4 py-2">{{ poem.author || 'Anonymous' }}</td>
                            <td class="px-4 py-2">{{ poem.subcategory.category.name }}</td>
                            <td class="px-4 py-2">{{ poem.subcategory.name }}</td>
                            <td class="px-4 py-2">
                                <Link :href="route('admin.poems.show', poem.id)" class="bg-blue-500 text-white px-2 py-1 rounded text-sm">
                                    View
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex justify-between items-center">
                <div>Showing {{ poems.from || 0 }} to {{ poems.to || 0 }} of {{ poems.total }}</div>
                <div class="flex space-x-1">
                    <Link 
                        v-for="link in poems.links" 
                        :key="link.label" 
                        :href="link.url" 
                        :class="['px-2 py-1 text-sm rounded', link.active ? 'bg-blue-500 text-white' : 'bg-gray-200']"
                        v-html="link.label"
                    ></Link>
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
</script>
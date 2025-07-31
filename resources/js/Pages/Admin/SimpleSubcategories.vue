<template>
    <AdminLayout title="Subcategories">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Subcategories</h1>
                <button @click="showModal = true" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Add Subcategory
                </button>
            </div>

            <!-- Search -->
            <div class="mb-4">
                <input 
                    v-model="searchTerm" 
                    @input="performSearch"
                    type="text" 
                    placeholder="Search..." 
                    class="w-full p-2 border rounded"
                >
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Category</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="subcategory in subcategories.data" :key="subcategory.id" class="border-t">
                            <td class="px-4 py-2">{{ subcategory.name }}</td>
                            <td class="px-4 py-2">{{ subcategory.category.name }}</td>
                            <td class="px-4 py-2">
                                <button @click="editSubcategory(subcategory)" class="bg-green-500 text-white px-2 py-1 rounded text-sm">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex justify-between items-center">
                <div>Showing {{ subcategories.from || 0 }} to {{ subcategories.to || 0 }} of {{ subcategories.total }}</div>
                <div class="flex space-x-1">
                    <Link 
                        v-for="link in subcategories.links" 
                        :key="link.label" 
                        :href="link.url" 
                        :class="['px-2 py-1 text-sm rounded', link.active ? 'bg-blue-500 text-white' : 'bg-gray-200']"
                        v-html="link.label"
                    ></Link>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg w-96">
                <h3 class="text-lg font-bold mb-4">{{ editingSubcategory ? 'Edit' : 'Add' }} Subcategory</h3>
                <form @submit.prevent="submitSubcategory">
                    <div class="mb-4">
                        <select v-model="selectedCategoryId" class="w-full p-2 border rounded" required>
                            <option value="">Select Category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <input 
                            v-model="subcategoryName" 
                            type="text" 
                            placeholder="Subcategory Name" 
                            class="w-full p-2 border rounded"
                            required
                        >
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    subcategories: Object,
    categories: Array,
    filters: Object,
});

const showModal = ref(false);
const subcategoryName = ref('');
const selectedCategoryId = ref('');
const editingSubcategory = ref(null);
const searchTerm = ref(props.filters?.search || '');

let searchTimeout = null;

const performSearch = () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(route('admin.subcategories'), {
            search: searchTerm.value
        }, {
            preserveState: true,
            replace: true
        });
    }, 300);
};

const editSubcategory = (subcategory) => {
    editingSubcategory.value = subcategory;
    subcategoryName.value = subcategory.name;
    selectedCategoryId.value = subcategory.category_id;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    subcategoryName.value = '';
    selectedCategoryId.value = '';
    editingSubcategory.value = null;
};

const submitSubcategory = () => {
    const url = editingSubcategory.value 
        ? route('admin.subcategories.update', editingSubcategory.value.id)
        : route('admin.subcategories.store');
    
    const method = editingSubcategory.value ? 'put' : 'post';
    
    router[method](url, {
        name: subcategoryName.value,
        category_id: selectedCategoryId.value
    }, {
        onSuccess: () => {
            closeModal();
            alert('Success!');
        }
    });
};
</script>
<template>
    <AdminLayout title="Subcategories">
        <div class="bg-gradient-to-br from-amber-600 via-yellow-600 to-orange-600 overflow-hidden shadow-2xl rounded-xl border border-amber-400">
            <div class="p-4 lg:p-6 bg-gradient-to-r from-amber-700 via-yellow-700 to-orange-700 text-white">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-xl lg:text-2xl font-bold drop-shadow-xl">Sub Categories</h1>
                        <p class="mt-2 text-yellow-200 text-sm lg:text-base">Manage poem subcategories</p>
                    </div>
                    <button @click="openModal()" class="bg-gradient-to-r from-yellow-400 to-amber-500 hover:from-yellow-500 hover:to-amber-600 text-amber-900 font-bold py-2 px-4 rounded-lg shadow-lg transition-all text-sm">
                        + Add Subcategory
                    </button>
                </div>
            </div>

            <div class="p-4 lg:p-6 bg-gradient-to-br from-amber-500 via-yellow-500 to-orange-500">
                <div class="bg-gradient-to-br from-yellow-50 to-amber-100 rounded-xl shadow-xl border border-amber-300">
                    <!-- Mobile Cards -->
                    <div class="block sm:hidden">
                        <div v-for="subcategory in subcategories" :key="subcategory.id" class="p-4 border-b border-amber-200 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-bold text-amber-900">{{ subcategory.name }}</h3>
                                    <p class="text-sm text-amber-700 mt-1">{{ subcategory.category.name }}</p>
                                    <p class="text-xs text-amber-600 mt-1">{{ new Date(subcategory.created_at).toLocaleDateString() }}</p>
                                </div>
                                <button @click="openModal(subcategory)" class="bg-amber-500 text-white px-3 py-1 rounded text-xs font-medium ml-2">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Desktop Table -->
                    <div class="hidden sm:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-amber-300">
                            <thead class="bg-gradient-to-r from-amber-300 via-yellow-300 to-orange-300">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Category</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Created</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-amber-900 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gradient-to-br from-yellow-50 to-amber-100 divide-y divide-amber-200">
                                <tr v-for="subcategory in subcategories" :key="subcategory.id" class="hover:bg-gradient-to-r hover:from-yellow-200 hover:to-amber-300 transition-all">
                                    <td class="px-4 py-3 text-sm font-bold text-amber-900">{{ subcategory.name }}</td>
                                    <td class="px-4 py-3 text-sm text-amber-800">{{ subcategory.category.name }}</td>
                                    <td class="px-4 py-3 text-sm text-amber-800">{{ new Date(subcategory.created_at).toLocaleDateString() }}</td>
                                    <td class="px-4 py-3">
                                        <button @click="openModal(subcategory)" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded text-xs font-medium transition-all">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-gradient-to-br from-yellow-50 to-amber-100 p-6 rounded-xl shadow-2xl border-2 border-amber-300 w-full max-w-md">
                <h3 class="text-xl font-bold text-amber-900 mb-4">{{ editingSubcategory ? 'Update Subcategory' : 'Add New Subcategory' }}</h3>
                <form @submit.prevent="submitSubcategory">
                    <div class="space-y-4">
                        <select 
                            v-model="selectedCategoryId" 
                            class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium text-sm"
                            required
                        >
                            <option value="">Select Category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        
                        <input 
                            v-model="subcategoryName" 
                            type="text" 
                            placeholder="Subcategory Name" 
                            class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium text-sm"
                            required
                        >
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" @click="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-400 transition-all text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-amber-500 to-yellow-500 text-white font-bold rounded-lg hover:from-amber-600 hover:to-yellow-600 transition-all text-sm">
                            {{ editingSubcategory ? 'Update' : 'Add' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    subcategories: Array,
    categories: Array,
});

const page = usePage();
const showModal = ref(false);
const subcategoryName = ref('');
const selectedCategoryId = ref('');
const editingSubcategory = ref(null);

const openModal = (subcategory = null) => {
    editingSubcategory.value = subcategory;
    subcategoryName.value = subcategory ? subcategory.name : '';
    selectedCategoryId.value = subcategory ? subcategory.category_id : '';
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
            Swal.fire({
                title: 'Success!',
                text: editingSubcategory.value ? 'Subcategory updated successfully!' : 'Subcategory added successfully!',
                icon: 'success',
                confirmButtonColor: '#f59e0b',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
};
</script>
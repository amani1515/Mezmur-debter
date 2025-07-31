<template>
    <AdminLayout title="Poem Details">
        <div class="bg-gradient-to-br from-amber-600 via-yellow-600 to-orange-600 overflow-hidden shadow-2xl rounded-xl border border-amber-400">
            <div class="p-4 lg:p-6 bg-gradient-to-r from-amber-700 via-yellow-700 to-orange-700 text-white">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-xl lg:text-2xl font-bold drop-shadow-xl">{{ poem.title }}</h1>
                        <p class="mt-2 text-yellow-200 text-sm lg:text-base">by {{ poem.author || 'Anonymous' }}</p>
                    </div>
                    <div class="flex space-x-3">
                        <Link :href="route('admin.poems')" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-all text-sm">
                            ← Back
                        </Link>
                        <button @click="showEditModal = true" class="bg-gradient-to-r from-yellow-400 to-amber-500 hover:from-yellow-500 hover:to-amber-600 text-amber-900 font-bold py-2 px-4 rounded-lg shadow-lg transition-all text-sm">
                            Edit Poem
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-4 lg:p-6 bg-gradient-to-br from-amber-500 via-yellow-500 to-orange-500">
                <div class="bg-gradient-to-br from-yellow-50 to-amber-100 rounded-xl shadow-xl border border-amber-300 p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Poem Details -->
                        <div class="lg:col-span-2">
                            <h3 class="text-lg font-bold text-amber-900 mb-4">Poem Content</h3>
                            <div class="bg-white p-4 rounded-lg border border-amber-200 min-h-96">
                                <pre class="whitespace-pre-wrap text-amber-900 font-medium leading-relaxed">{{ poem.body }}</pre>
                            </div>
                        </div>
                        
                        <!-- Metadata -->
                        <div>
                            <h3 class="text-lg font-bold text-amber-900 mb-4">Details</h3>
                            <div class="space-y-4">
                                <div class="bg-white p-3 rounded-lg border border-amber-200">
                                    <label class="text-xs font-bold text-amber-700 uppercase">Category</label>
                                    <p class="text-amber-900 font-medium">{{ poem.subcategory.category.name }}</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg border border-amber-200">
                                    <label class="text-xs font-bold text-amber-700 uppercase">Subcategory</label>
                                    <p class="text-amber-900 font-medium">{{ poem.subcategory.name }}</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg border border-amber-200">
                                    <label class="text-xs font-bold text-amber-700 uppercase">Author</label>
                                    <p class="text-amber-900 font-medium">{{ poem.author || 'Anonymous' }}</p>
                                </div>
                                <div class="bg-white p-3 rounded-lg border border-amber-200">
                                    <label class="text-xs font-bold text-amber-700 uppercase">Submitted</label>
                                    <p class="text-amber-900 font-medium">{{ new Date(poem.created_at).toLocaleDateString() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-gradient-to-br from-yellow-50 to-amber-100 p-6 rounded-xl shadow-2xl border-2 border-amber-300 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <h3 class="text-xl font-bold text-amber-900 mb-4">Edit Poem</h3>
                <form @submit.prevent="updatePoem">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
                        <input 
                            v-model="editForm.title" 
                            type="text" 
                            placeholder="Poem Title" 
                            class="p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium text-sm"
                            required
                        >
                        <input 
                            v-model="editForm.author" 
                            type="text" 
                            placeholder="Author (optional)" 
                            class="p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium text-sm"
                        >
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
                        <select 
                            v-model="editForm.selectedCategory" 
                            @change="onEditCategoryChange"
                            class="p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium text-sm"
                            required
                        >
                            <option value="">Select Category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <select 
                            v-model="editForm.subcategory_id" 
                            class="p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium text-sm"
                            required
                        >
                            <option value="">Select Subcategory</option>
                            <option v-for="subcategory in editFilteredSubcategories" :key="subcategory.id" :value="subcategory.id">
                                {{ subcategory.name }}
                            </option>
                        </select>
                    </div>
                    <textarea 
                        v-model="editForm.body" 
                        placeholder="Poem Content" 
                        rows="12"
                        class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium text-sm mb-4"
                        required
                    ></textarea>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="closeEditModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-400 transition-all text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-amber-500 to-yellow-500 text-white font-bold rounded-lg hover:from-amber-600 hover:to-yellow-600 transition-all text-sm">
                            Update Poem
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    poem: Object,
    categories: Array,
    subcategories: Array,
});

const showEditModal = ref(false);
const editForm = ref({
    title: '',
    author: '',
    body: '',
    subcategory_id: '',
    selectedCategory: ''
});

const editFilteredSubcategories = computed(() => {
    if (!editForm.value.selectedCategory) return props.subcategories || [];
    return (props.subcategories || []).filter(sub => sub.category_id == editForm.value.selectedCategory);
});

const openEditModal = () => {
    editForm.value = {
        title: props.poem.title,
        author: props.poem.author || '',
        body: props.poem.body,
        subcategory_id: props.poem.subcategory_id,
        selectedCategory: props.poem.subcategory.category_id
    };
    showEditModal.value = true;
};

const closeEditModal = () => {
    showEditModal.value = false;
    editForm.value = {
        title: '',
        author: '',
        body: '',
        subcategory_id: '',
        selectedCategory: ''
    };
};

const onEditCategoryChange = () => {
    editForm.value.subcategory_id = '';
};

const updatePoem = () => {
    router.put(route('admin.poems.update', props.poem.id), {
        title: editForm.value.title,
        author: editForm.value.author,
        body: editForm.value.body,
        subcategory_id: editForm.value.subcategory_id
    }, {
        onSuccess: () => {
            closeEditModal();
            alert('Poem updated successfully!');
        }
    });
};

// Initialize categories and subcategories if not provided
if (!props.categories) {
    // Fetch categories and subcategories if needed
    router.get(route('admin.poems.show', props.poem.id), {}, {
        only: ['categories', 'subcategories'],
        preserveState: true
    });
}
</script>
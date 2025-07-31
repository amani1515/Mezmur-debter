<template>
    <AdminLayout title="Edit Poem">
        <div class="bg-gradient-to-br from-amber-600 via-yellow-600 to-orange-600 overflow-hidden shadow-2xl rounded-xl border border-amber-400">
            <div class="p-4 lg:p-6 bg-gradient-to-r from-amber-700 via-yellow-700 to-orange-700 text-white">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-xl lg:text-2xl font-bold drop-shadow-xl">Edit Poem</h1>
                        <p class="mt-2 text-yellow-200 text-sm lg:text-base">{{ poem.title }}</p>
                    </div>
                    <Link :href="route('admin.poems')" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-all text-sm">
                        ← Back to Poems
                    </Link>
                </div>
            </div>

            <div class="p-4 lg:p-6 bg-gradient-to-br from-amber-500 via-yellow-500 to-orange-500">
                <div class="bg-gradient-to-br from-yellow-50 to-amber-100 rounded-xl shadow-xl border border-amber-300 p-6">
                    <form @submit.prevent="updatePoem" class="space-y-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-amber-900 mb-2">Title *</label>
                                <input 
                                    v-model="form.title" 
                                    type="text" 
                                    class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium"
                                    required
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-amber-900 mb-2">Author</label>
                                <input 
                                    v-model="form.author" 
                                    type="text" 
                                    class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium"
                                    placeholder="Author name"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-amber-900 mb-2">Registered By</label>
                                <input 
                                    v-model="form.registered_by" 
                                    type="text" 
                                    class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium"
                                    placeholder="Registered by"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-amber-900 mb-2">Category *</label>
                                <select 
                                    v-model="selectedCategory" 
                                    @change="onCategoryChange"
                                    class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium"
                                    required
                                >
                                    <option value="">Select Category</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-amber-900 mb-2">Subcategory *</label>
                            <select 
                                v-model="form.subcategory_id" 
                                class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium"
                                required
                            >
                                <option value="">Select Subcategory</option>
                                <option v-for="subcategory in filteredSubcategories" :key="subcategory.id" :value="subcategory.id">
                                    {{ subcategory.name }}
                                </option>
                            </select>
                        </div>

                        <!-- Structure Toggle -->
                        <div class="flex items-center space-x-3">
                            <input 
                                v-model="isStructured" 
                                type="checkbox" 
                                id="structured"
                                class="w-4 h-4 text-amber-600 border-amber-300 rounded focus:ring-amber-500"
                            >
                            <label for="structured" class="text-sm font-bold text-amber-900">Edit as structured poem (with verses)</label>
                        </div>

                        <!-- Structured Verses -->
                        <div v-if="isStructured">
                            <label class="block text-sm font-bold text-amber-900 mb-2">Poem Verses *</label>
                            <div class="space-y-4">
                                <div v-for="(verse, index) in verses" :key="index" class="bg-white p-4 rounded-lg border-2 border-amber-200">
                                    <div class="flex justify-between items-center mb-3">
                                        <h4 class="font-bold text-amber-900">Verse {{ index + 1 }}</h4>
                                        <button type="button" @click="removeVerse(index)" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">
                                            Remove
                                        </button>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="block text-xs font-bold text-amber-800 mb-1">Main Verse:</label>
                                        <textarea 
                                            v-model="verse.main" 
                                            rows="2"
                                            class="w-full p-2 border border-amber-300 rounded focus:border-amber-500 focus:outline-none text-amber-900 text-sm"
                                            required
                                        ></textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs font-bold text-amber-800 mb-1">Sub Verses:</label>
                                        <div class="space-y-2">
                                            <div v-for="(sub, subIndex) in verse.subs" :key="subIndex" class="flex gap-2">
                                                <textarea 
                                                    v-model="verse.subs[subIndex]" 
                                                    rows="1"
                                                    class="flex-1 p-2 border border-amber-300 rounded focus:border-amber-500 focus:outline-none text-amber-900 text-sm"
                                                ></textarea>
                                                <button type="button" @click="removeSubVerse(index, subIndex)" class="bg-red-400 text-white px-2 py-1 rounded text-xs hover:bg-red-500">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" @click="addSubVerse(index)" class="mt-2 bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">
                                            + Add Sub Verse
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" @click="addVerse" class="mt-4 bg-amber-500 text-white px-4 py-2 rounded font-medium hover:bg-amber-600">
                                + Add Verse
                            </button>
                        </div>

                        <!-- Simple Text Area -->
                        <div v-else>
                            <label class="block text-sm font-bold text-amber-900 mb-2">Poem Content *</label>
                            <textarea 
                                v-model="form.body" 
                                rows="12"
                                class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium"
                                required
                            ></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <Link :href="route('admin.poems')" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-400 transition-all">
                                Cancel
                            </Link>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-amber-500 to-yellow-500 text-white font-bold rounded-lg hover:from-amber-600 hover:to-yellow-600 transition-all">
                                Update Poem
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    poem: Object,
    categories: Array,
    subcategories: Array,
});

const form = ref({
    title: props.poem.title,
    author: props.poem.author || '',
    registered_by: props.poem.registered_by || '',
    body: props.poem.body,
    subcategory_id: props.poem.subcategory_id
});

const selectedCategory = ref(props.poem.subcategory.category_id);
const isStructured = ref(props.poem.is_structured || false);
const verses = ref([]);

const filteredSubcategories = computed(() => {
    if (!selectedCategory.value) return props.subcategories;
    return props.subcategories.filter(sub => sub.category_id == selectedCategory.value);
});

const onCategoryChange = () => {
    form.value.subcategory_id = '';
};

const addVerse = () => {
    verses.value.push({ main: '', subs: [''] });
};

const removeVerse = (index) => {
    if (verses.value.length > 1) {
        verses.value.splice(index, 1);
    }
};

const addSubVerse = (verseIndex) => {
    verses.value[verseIndex].subs.push('');
};

const removeSubVerse = (verseIndex, subIndex) => {
    if (verses.value[verseIndex].subs.length > 1) {
        verses.value[verseIndex].subs.splice(subIndex, 1);
    }
};

const updatePoem = () => {
    let updateData = { ...form.value };
    
    if (isStructured.value) {
        const cleanVerses = verses.value.map(verse => ({
            main: verse.main.trim(),
            subs: verse.subs.filter(sub => sub.trim()).map(sub => sub.trim())
        })).filter(verse => verse.main);
        
        updateData.verses = cleanVerses;
        updateData.is_structured = true;
        
        // Build body from structure
        let body = '';
        cleanVerses.forEach(verse => {
            body += verse.main + '\n';
            verse.subs.forEach(sub => {
                body += '    ' + sub + '\n';
            });
            body += '\n';
        });
        updateData.body = body.trim();
    } else {
        updateData.is_structured = false;
    }
    
    router.put(route('admin.poems.update', props.poem.id), updateData);
};

onMounted(() => {
    if (props.poem.structure && props.poem.is_structured) {
        verses.value = props.poem.structure.map(verse => ({
            main: verse.main || '',
            subs: verse.subs || ['']
        }));
    } else {
        verses.value = [{ main: '', subs: [''] }];
    }
});
</script>
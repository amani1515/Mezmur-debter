<template>
    <div class="min-h-screen relative" style="background-image: url('/images/backgrounds/welcome-background.jpg'); background-size: cover; background-position: center; background-attachment: fixed;">
        <!-- Background Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-30 backdrop-blur-sm"></div>
        <!-- Header -->
        <header class="bg-gradient-to-r from-amber-600 via-yellow-600 to-orange-600 shadow-2xl relative z-10">
            <div class="max-w-7xl mx-auto px-4 py-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center space-x-4">
                        <img src="/images/logos/dekikelogo.png" alt="Dekike Brhan Logo" class="w-16 h-16 object-contain drop-shadow-lg">
                        <div class="text-center sm:text-left">
                            <h1 class="text-2xl lg:text-3xl font-bold text-white drop-shadow-xl">ደቂቀ ብርሀን</h1>
                            <p class="text-yellow-200 text-sm lg:text-base">Dekike Brhan - Children of Light</p>
                        </div>
                    </div>
                    <Link :href="route('login.page')" class="bg-gradient-to-r from-yellow-400 to-amber-500 hover:from-yellow-500 hover:to-amber-600 text-amber-900 font-bold py-3 px-6 rounded-lg shadow-lg transition-all">
                        Admin Login
                    </Link>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="py-12 lg:py-20 relative z-10">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-5xl font-bold text-amber-900 mb-6 drop-shadow-lg">
                        Welcome to Dekike Brhan
                    </h2>
                    <p class="text-lg lg:text-xl text-amber-800 max-w-4xl mx-auto leading-relaxed">
                        A sacred digital sanctuary dedicated to preserving and sharing the rich heritage of Ethiopian Orthodox spiritual poetry. 
                        Our platform serves as a bridge between generations, connecting the timeless wisdom of our ancestors with the hearts of today's faithful.
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                    <div class="bg-gradient-to-br from-yellow-100 to-amber-200 p-6 rounded-xl shadow-xl border border-amber-300">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-amber-900 mb-3">Spiritual Heritage</h3>
                        <p class="text-amber-800">Preserving centuries-old Ethiopian Orthodox poems, hymns, and spiritual writings for future generations.</p>
                    </div>

                    <div class="bg-gradient-to-br from-yellow-100 to-amber-200 p-6 rounded-xl shadow-xl border border-amber-300">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-amber-900 mb-3">Community Driven</h3>
                        <p class="text-amber-800">Built by the faithful, for the faithful. Everyone can contribute to our growing collection of sacred poetry.</p>
                    </div>

                    <div class="bg-gradient-to-br from-yellow-100 to-amber-200 p-6 rounded-xl shadow-xl border border-amber-300">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-amber-900 mb-3">Sacred Connection</h3>
                        <p class="text-amber-800">Connecting hearts through the power of sacred words, fostering spiritual growth and unity.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Poem Submission Form -->
        <section class="py-12 bg-gradient-to-r from-amber-600 via-yellow-600 to-orange-600 relative z-10">
            <div class="max-w-4xl mx-auto px-4">
                <div class="text-center mb-8">
                    <h3 class="text-2xl lg:text-3xl font-bold text-white mb-4 drop-shadow-lg">Share Your Sacred Poetry</h3>
                    <p class="text-yellow-200 text-lg">Contribute to our spiritual heritage by sharing poems, hymns, or sacred writings</p>
                </div>

                <div class="bg-gradient-to-br from-yellow-50 to-amber-100 rounded-2xl shadow-2xl border-2 border-amber-300 p-6 lg:p-8 backdrop-blur-md bg-opacity-90">
                    <form @submit.prevent="submitStructuredPoem" class="space-y-6">
                        <!-- Success Message -->
                        <div v-if="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ successMessage }}
                            </div>
                        </div>

                        <!-- Error Messages -->
                        <div v-if="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ errorMessage }}
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-amber-900 mb-2">Poem Title *</label>
                                <input 
                                    v-model="form.title" 
                                    @input="checkTitleDuplicate"
                                    type="text" 
                                    :class="[
                                        'w-full p-3 border-2 rounded-lg focus:outline-none bg-white text-amber-900 font-medium',
                                        titleExists ? 'border-red-400 focus:border-red-500' : 'border-amber-300 focus:border-amber-500'
                                    ]"
                                    placeholder="Enter poem title"
                                    required
                                >
                                <div v-if="titleExists" class="mt-1 text-red-600 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    This title already exists. Please choose a different title.
                                </div>
                                
                                <!-- Related Poems -->
                                <div v-if="relatedPoems && relatedPoems.length > 0 && form.title.length > 2" class="mt-2 bg-yellow-50 border border-yellow-300 rounded-lg p-3">
                                    <h4 class="text-sm font-bold text-amber-900 mb-2">Similar titles found:</h4>
                                    <div class="space-y-1">
                                        <div v-for="poem in relatedPoems" :key="poem.title" class="text-xs text-amber-800 bg-white px-2 py-1 rounded border">
                                            <span class="font-medium">{{ poem.title }}</span>
                                            <span v-if="poem.author" class="text-amber-600"> - by {{ poem.author }}</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-amber-700 mt-2">Please check if your poem is already listed above.</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-amber-900 mb-2">Author (Optional)</label>
                                <input 
                                    v-model="form.author" 
                                    type="text" 
                                    class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium"
                                    placeholder="Author name (leave empty for Anonymous)"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-amber-900 mb-2">Your Name (Optional)</label>
                                <input 
                                    v-model="form.registered_by" 
                                    type="text" 
                                    class="w-full p-3 border-2 border-amber-300 rounded-lg focus:border-amber-500 focus:outline-none bg-white text-amber-900 font-medium"
                                    placeholder="Your name (leave empty for Anonymous)"
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

                        <!-- Verses Section -->
                        <div>
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
                                            placeholder="Enter main verse lines"
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
                                                    placeholder="Enter sub verse"
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

                        <div class="text-center">
                            <button 
                                type="submit" 
                                :disabled="processing || titleExists || verses.length === 0"
                                class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-bold py-4 px-8 rounded-lg shadow-lg transition-all text-lg disabled:opacity-50"
                            >
                                <span v-if="processing">Submitting...</span>
                                <span v-else-if="titleExists">Title Already Exists</span>
                                <span v-else-if="verses.length === 0">Add at least one verse</span>
                                <span v-else>Submit Structured Poem</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gradient-to-r from-amber-800 via-yellow-800 to-orange-800 text-white py-8 relative z-10">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <img src="/images/logos/dekikelogo.png" alt="Dekike Brhan Logo" class="w-10 h-10 object-contain">
                    <h4 class="text-xl font-bold">ደቂቀ ብርሀን</h4>
                </div>
                <p class="text-yellow-200 mb-4">Preserving Ethiopian Orthodox spiritual heritage through sacred poetry</p>
                <p class="text-yellow-300 text-sm">&copy; {{ new Date().getFullYear() }} Dekike Brhan. Built with love for our spiritual community.</p>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router, Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array,
});

const form = ref({
    title: '',
    author: '',
    registered_by: '',
    subcategory_id: ''
});

const verses = ref([{ main: '', subs: [''] }]);
const selectedCategory = ref('');
const processing = ref(false);
const titleExists = ref(false);
const relatedPoems = ref([]);
const successMessage = ref('');
const errorMessage = ref('');
let titleCheckTimeout = null;

const filteredSubcategories = computed(() => {
    if (!selectedCategory.value) return [];
    const category = props.categories.find(cat => cat.id == selectedCategory.value);
    return category ? category.subcategories : [];
});

const onCategoryChange = () => {
    form.value.subcategory_id = '';
};

const checkTitleDuplicate = () => {
    if (!form.value.title.trim()) {
        titleExists.value = false;
        return;
    }
    
    clearTimeout(titleCheckTimeout);
    titleCheckTimeout = setTimeout(() => {
        router.get(route('check.title'), { title: form.value.title }, {
            onSuccess: (page) => {
                titleExists.value = page.props.exists || false;
                relatedPoems.value = page.props.relatedPoems || [];
            },
            preserveState: true,
            preserveScroll: true,
            only: ['exists', 'relatedPoems']
        });
    }, 500);
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

const submitStructuredPoem = async () => {
    if (titleExists.value) return;
    
    processing.value = true;
    errorMessage.value = '';
    successMessage.value = '';
    
    const cleanVerses = verses.value.map(verse => ({
        main: verse.main.trim(),
        subs: verse.subs.filter(sub => sub.trim()).map(sub => sub.trim())
    })).filter(verse => verse.main);
    
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const response = await fetch('/api/submit-structured-poem', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                ...form.value,
                verses: cleanVerses
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            successMessage.value = 'Poem submitted successfully! Thank you for your contribution.';
            form.value = { title: '', author: '', registered_by: '', subcategory_id: '' };
            verses.value = [{ main: '', subs: [''] }];
            selectedCategory.value = '';
            titleExists.value = false;
            relatedPoems.value = [];
        } else {
            errorMessage.value = data.error || 'Error submitting poem';
        }
    } catch (error) {
        console.error('Submission error:', error);
        errorMessage.value = 'Network error. Please check your connection and try again.';
    }
    
    processing.value = false;
};
</script>
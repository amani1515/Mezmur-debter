<template>
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Test Subcategories Page</h1>
        <div class="bg-white p-4 rounded shadow">
            <p>Subcategories count: {{ subcategories?.data?.length || 0 }}</p>
            <p>Categories count: {{ categories?.length || 0 }}</p>
            <pre>{{ JSON.stringify(subcategories, null, 2) }}</pre>
        </div>
    </div>
</template>

<script setup>
defineProps({
    subcategories: Object,
    categories: Array,
    filters: Object,
});
</script>
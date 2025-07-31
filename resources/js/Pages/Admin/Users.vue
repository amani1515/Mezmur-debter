<template>
    <AdminLayout title="Users">
        <div class="bg-gradient-to-br from-amber-600 via-yellow-600 to-orange-600 overflow-hidden shadow-2xl rounded-2xl border border-amber-400">
            <div class="p-6 lg:p-8 bg-gradient-to-r from-amber-700 via-yellow-700 to-orange-700 text-white">
                <h1 class="text-3xl font-bold drop-shadow-xl">Users Management</h1>
                <p class="mt-4 text-yellow-200 leading-relaxed text-lg">Manage system users and their roles.</p>
            </div>

            <div class="p-8 bg-gradient-to-br from-amber-500 via-yellow-500 to-orange-500">
                <div class="overflow-x-auto bg-gradient-to-br from-yellow-50 to-amber-100 rounded-2xl shadow-2xl border-2 border-amber-300">
                    <table class="min-w-full divide-y divide-amber-300">
                        <thead class="bg-gradient-to-r from-amber-300 via-yellow-300 to-orange-300">
                            <tr>
                                <th class="px-8 py-5 text-left text-sm font-bold text-amber-900 uppercase tracking-wider">Name</th>
                                <th class="px-8 py-5 text-left text-sm font-bold text-amber-900 uppercase tracking-wider">Email</th>
                                <th class="px-8 py-5 text-left text-sm font-bold text-amber-900 uppercase tracking-wider">Role</th>
                                <th class="px-8 py-5 text-left text-sm font-bold text-amber-900 uppercase tracking-wider">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gradient-to-br from-yellow-50 to-amber-100 divide-y divide-amber-200">
                            <tr v-for="user in users" :key="user.id" class="hover:bg-gradient-to-r hover:from-yellow-200 hover:to-amber-300 transition-all transform hover:scale-[1.02]">
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-bold text-amber-900">{{ user.name }}</td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm text-amber-800 font-medium">{{ user.email }}</td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span class="px-4 py-2 inline-flex text-xs leading-5 font-bold rounded-full bg-gradient-to-r from-amber-500 to-yellow-500 text-white shadow-lg">
                                        {{ user.role }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm text-amber-800 font-semibold">
                                    {{ new Date(user.created_at).toLocaleDateString() }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    users: Array,
});
</script>
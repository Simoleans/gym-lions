<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash.debounce';
import Button from 'primevue/button';
import ShowUser from './Components/ShowUser.vue';
import EditUser from './Components/EditUser.vue';

const props = defineProps({
    users: Object,
    filters: Object,
});

const searchTerm = ref(props.filters.search || '');

const open = ref(false);
const user = ref(null);
const editUserData = ref({});
const modalEditUser = ref(false);

// Buscador con debounce para no saturar el servidor
const searchUsers = debounce((value) => {
    router.get(
        route('users.index'),
        { search: value },
        { preserveState: true, replace: true }
    );
}, 400);

watch(searchTerm, (value) => {
    searchUsers(value);
});

// Cambiar página (preserva el término de búsqueda)
const changePage = (url) => {
    if (url) {
        router.get(url, { search: searchTerm.value }, { preserveState: true, preserveScroll: true });
    }
};

const viewUser = (data) => {
    console.log(data);
    user.value = data;
    open.value = true;

}

const closeModal = () => {
    open.value = false;
}

const openEditUser = (user) => {
    editUserData.value = user;
    modalEditUser.value = true;
}

const closeEditUser = () => {
    modalEditUser.value = false;
}
</script>

<template>
    <Head title="Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Lista de Usuarios
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">

                    <!-- Buscador -->
                    <div class="mb-4">
                        <input
                            v-model="searchTerm"
                            type="text"
                            placeholder="Buscar por nombre o email..."
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        />
                    </div>

                    <!-- Tabla -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Nombre</th>
                                    <!-- <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Email</th> -->
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Teléfono</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Asistencias</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">Plan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ user.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ user.name }}</td>
                                    <!-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ user.email }}</td> -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ user.phone ?? 'N/A' }}</td>

                                    <!-- Estado -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium"
                                            :class="user.is_moroso ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'"
                                        >
                                            {{ user.is_moroso ? 'Moroso' : 'Activo' }}
                                        </span>
                                    </td>

                                    <!-- Asistencias -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span v-if="user.plan_personalizado" class="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">
                                            <span class="text-xs font-medium text-blue-800" :class="user.attendance_count >= user.plan_personalizado ? 'text-red-800' : 'text-blue-800'">{{ user.attendance_count }} asistencias</span>
                                        </span>
                                        <span v-else>
                                            <span class="inline-flex items-center rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">
                                                {{ user.attendance_count }} asistencias
                                            </span>
                                        </span>
                                    </td>

                                    <!-- Plan -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                        {{ user.plan_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                        <Button label="Ver" severity="success" @click="viewUser(user)" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="flex justify-between items-center mt-4">
                        <button v-if="users.prev_page_url" @click="changePage(users.prev_page_url)" class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded">
                            Anterior
                        </button>

                        <span class="text-gray-600 dark:text-gray-400 text-sm">
                            Página {{ users.current_page }} de {{ users.last_page }}
                        </span>

                        <button v-if="users.next_page_url" @click="changePage(users.next_page_url)" class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded">
                            Siguiente
                        </button>
                    </div>

                    <div v-if="users.data.length === 0" class="text-center text-gray-500 dark:text-gray-400 mt-4">
                        No se encontraron usuarios.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <ShowUser :user="user" :open="open" @close="closeModal" @openEdit="openEditUser" />
    <EditUser :user="editUserData" :open="modalEditUser" @close="closeEditUser" />
</template>

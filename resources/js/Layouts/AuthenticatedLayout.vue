<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const showingResponsiveOptionsDropdown = ref(false); // Estado para abrir el submenú "Opciones" en móvil

const toggleDarkMode = () => {
  const html = document.documentElement;
  if (html.classList.contains('dark')) {
    html.classList.remove('dark');
    localStorage.setItem('theme', 'light');
  } else {
    html.classList.add('dark');
    localStorage.setItem('theme', 'dark');
  }
};

const applySavedTheme = () => {
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'dark') {
    document.documentElement.classList.add('dark');
  }
};

applySavedTheme();
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <nav class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 justify-between">
            <div class="flex">
              <!-- Logo -->
              <div class="flex shrink-0 items-center">
                <Link :href="route('dashboard')">
                  <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">Inicio</NavLink>

                <!-- Dropdown Opciones (Desktop) -->
                <div class="relative">
                  <Dropdown align="left" width="48">
                    <template #trigger>
                      <span class="inline-flex rounded-md">
                        <button
                          type="button"
                          class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 transition duration-150 ease-in-out hover:text-gray-800 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                          :class="{ 'border-b-2 border-indigo-400 dark:border-indigo-600': route().current('users.*'),
                            'border-b-2 border-transparent': !route().current('users.*')
                           }"
                        >
                          Usuarios
                          <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
                        </button>
                      </span>
                    </template>

                    <template #content>
                      <DropdownLink :href="route('users.index')"> Usuarios </DropdownLink>
                      <DropdownLink :href="route('users.create')"> Registrar Usuario </DropdownLink>
                    </template>
                  </Dropdown>
                </div>
              </div>
            </div>

            <div class="hidden sm:ms-6 sm:flex sm:items-center">
              <!-- Settings Dropdown -->
              <div class="relative ms-3">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-800 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                        {{ $page.props.auth.user.name }}
                        <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <DropdownLink :href="route('profile.edit')"> Mi Perfil </DropdownLink>
                    <DropdownLink :href="route('logout')" method="post" as="button"> Salir </DropdownLink>
                  </template>
                </Dropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
              <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="p-2">
                ☰
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
          <ResponsiveNavLink :href="route('dashboard')">Inicio</ResponsiveNavLink>

          <!-- Responsive Dropdown Opciones -->
          <div class="px-4">
            <button @click="showingResponsiveOptionsDropdown = !showingResponsiveOptionsDropdown" class="w-full text-left text-gray-700 dark:text-gray-300 font-medium">
              Usuarios
              <span v-if="!showingResponsiveOptionsDropdown">▼</span>
              <span v-else>▲</span>
            </button>

            <div v-if="showingResponsiveOptionsDropdown" class="mt-2 space-y-1">
              <ResponsiveNavLink :href="route('users.index')"> Usuarios </ResponsiveNavLink>
              <ResponsiveNavLink :href="route('users.create')"> Registrar Usuario </ResponsiveNavLink>
            </div>
          </div>

          <!-- Responsive Settings Options -->
          <div class="border-t border-gray-200 dark:border-gray-600 mt-3 pt-3">
            <div class="px-4">
              <div class="font-medium text-gray-700 dark:text-gray-300">{{ $page.props.auth.user.name }}</div>
              <div class="text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
            </div>

            <div class="mt-3 space-y-1">
              <ResponsiveNavLink :href="route('profile.edit')">Mi Perfil</ResponsiveNavLink>
              <ResponsiveNavLink :href="route('logout')" method="post" as="button">Salir</ResponsiveNavLink>
            </div>
          </div>
        </div>
      </nav>

      <main>
        <slot />
      </main>
    </div>
  </div>
</template>

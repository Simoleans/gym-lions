<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { BarChart, PieChart } from 'vue-chart-3';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement, BarController,PieController  } from 'chart.js';
import { reactive, onMounted } from 'vue';
import Swal from 'sweetalert2';
import { usePage } from '@inertiajs/vue3';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement, BarController,PieController);

const chartDataBar = reactive({
  labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
  datasets: [
    {
      label: 'Usuarios Registrados',
      data: [50, 75, 100, 125, 150],
      backgroundColor: '#4CAF50',
    },
  ],
});

const user = usePage().props.auth.user;
onMounted(() => {
  Swal.fire({
    title: 'Hola ' + user.name,
    text: 'Este es tu perfil de usuario',
    icon: 'success',
  });
});

const chartOptionsBar = reactive({
  responsive: true,
  plugins: { legend: { position: 'top' } },
});

const chartDataPie = reactive({
  labels: ['Plan Básico', 'Plan Premium', 'Plan Empresarial'],
  datasets: [
    {
      label: 'Planes Elegidos',
      data: [60, 90, 50],
      backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
    },
  ],
});

const chartOptionsPie = reactive({
  responsive: true,
  plugins: { legend: { position: 'top' } },
});
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Cards -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-8">
          <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow flex justify-between items-center">
            <div>
              <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Usuarios Registrados</h3>
              <p class="text-3xl font-bold text-green-500">150</p>
            </div>
            <i class="bi bi-people text-4xl text-green-500"></i>
          </div>

          <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow flex justify-between items-center">
            <div>
              <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Usuarios Activos</h3>
              <p class="text-3xl font-bold text-blue-500">120</p>
            </div>
            <i class="bi bi-person-check text-4xl text-blue-500"></i>
          </div>

          <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow flex justify-between items-center">
            <div>
              <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Usuarios Morosos</h3>
              <p class="text-3xl font-bold text-red-500">30</p>
            </div>
            <i class="bi bi-exclamation-triangle text-4xl text-red-500"></i>
          </div>
        </div>

        <!-- Gráficos -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Usuarios Registrados por Mes</h3>
            <BarChart :chart-data="chartDataBar" :chart-options="chartOptionsBar" />
          </div>

          <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Planes Más Elegidos por Usuarios Activos</h3>
            <PieChart :chart-data="chartDataPie" :chart-options="chartOptionsPie" />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.bi {
  font-family: 'Bootstrap Icons';
}
</style>

<template>
    <div v-if="user.attendances.length" class="p-6 bg-gray-50 dark:bg-gray-800 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-3">Calendario de Asistencias</h3>
        <VCalendar :attributes="attendanceAttributes" expanded :initial-page="initialPage" />
    </div>
</template>

<script setup>
import { ref, computed, defineProps } from 'vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    }
});

// Configuración para que el calendario inicie en el mes y año actual
const initialPage = ref({
    month: new Date().getMonth() + 1,
    year: new Date().getFullYear(),
});

// Computed property para marcar los días de asistencia
const attendanceAttributes = computed(() => [{
    highlight: {
        color: 'green',
        fillMode: 'solid'
    },
    dates: props.user.attendances.map(a => new Date(a.created_at)),
}]);

</script>

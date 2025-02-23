<template>
    <!-- Fondo Oscuro al Abrir -->
    <div v-if="open" class="fixed z-[699] bg-black/50 top-0 left-0 h-screen w-screen" @click="handleClose"></div>

    <!-- Transición de Entrada y Salida -->
    <transition name="slide">
        <div
            v-if="open"
            class="fixed bg-white dark:bg-gray-900 shadow-2xl flex-column rounded-xl transition-transform transform"
            :class="{'w-full': isMobile, 'w-1/2': !isMobile}"
            :style="`top: ${containerTop}px; right: 0; min-height: calc(100vh - ${containerTop}px); height: calc(100vh - ${containerTop}px); z-index: 700;`"
            ref="ref_section_show"
        >
            <div class="flex flex-col h-full">
                <div class="flex justify-between items-center px-6 py-5 sticky top-0 z-10 bg-white dark:bg-gray-800 shadow-md border-b border-gray-200 dark:border-gray-700">
                    <h1 class="font-semibold text-2xl dark:text-white">{{ user.name }}</h1>
                    <button @click="handleClose" class="text-gray-500 hover:text-red-500 dark:hover:text-red-400 text-xl">✕</button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-6">

                    <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-gray-700 dark:text-white mb-4">Información Personal</h2>
                        <div class="space-y-3 text-lg text-gray-800 dark:text-white">
                            <p class="flex items-center gap-3"><i class="pi pi-user text-blue-500 text-xl"></i> <span class="font-medium">Cédula:</span> {{ user.id_number }}</p>
                            <p class="flex items-center gap-3"><i class="pi pi-envelope text-yellow-500 text-xl"></i> <span class="font-medium">Correo:</span> {{ user.email }}</p>
                            <p class="flex items-center gap-3"><i class="pi pi-phone text-green-500 text-xl"></i> <span class="font-medium">Teléfono:</span> {{ user.phone }}</p>
                            <p class="flex items-center gap-3">
                                <i class="pi pi-shield text-purple-500 text-xl"></i>
                                <span class="font-medium">Estado:</span>
                                <span :class="user.status ? 'text-green-500' : 'text-red-500'">
                                    {{ user.status ? 'Activo' : 'Inactivo' }}
                                </span>
                            </p>

                            <!-- QR Code -->
                            <div class="flex flex-col items-center gap-3 mt-4">
                                <!-- <vue-qr ref="qrRef" :text="user.id_number" qid="testid"></vue-qr> -->
                                <QRCodeVue3
                                    :width="225"
                                    :height="225"
                                    imgclass="souvenirs_img"
                                    :value="user.id_number"
                                    :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
                                    :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }" :dotsOptions="{
                                            type: 'square',
                                            color: '#333',
                                            gradient: {
                                                type: 'linear',
                                                rotation: 0,
                                                colorStops: [
                                                    { offset: 0, color: '#333' },
                                                    { offset: 1, color: '#333' },
                                                ],
                                            },
                                    }"
                                    fileExt="jpeg"
                                    :backgroundOptions="{ color: '#ffffff' }"
                                    :cornersSquareOptions="{ type: 'dot', color: '#333' }"
                                    :cornersDotOptions="{ type: undefined, color: '#333' }"
                                    downloadButton="view-cart bg-info mt-3 souvenirs_btn"
                                    :downloadOptions="{ name: user.id_number, extension: 'jpeg' }"
                                    crossOrigin="anonymous"
                                    :download="false"
                                    ref="qrCodeRef"
                                />

                                <button class="my-download-button" @click="downloadQr">Descargar QR</button>
                            </div>

                        </div>

                        <!-- Botones de Acción -->
                        <div class="mt-6 flex justify-between gap-3">
                            <button @click="toggleStatus"
                                class="flex-1 py-3 px-4 rounded-lg text-white font-medium text-lg transition duration-300 shadow-md
                                sm:py-2 sm:px-3 sm:text-sm"
                                :class="user.status ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600'">
                                {{ user.status ? 'Inhabilitar' : 'Habilitar' }}
                            </button>
                            <button @click="editUser"
                                class="flex-1 py-3 px-4 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium text-lg transition duration-300 shadow-md
                                sm:py-2 sm:px-3 sm:text-sm">
                                Editar
                            </button>
                        </div>
                    </div>

                    <!-- Sección del Plan de Suscripción -->
                    <div class="bg-blue-100 dark:bg-blue-900 p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-blue-700 dark:text-white mb-4">Suscripción</h2>
                        <div class="flex justify-between items-center text-lg">
                            <div>
                                <p class="font-medium text-xl text-gray-900 dark:text-white">{{ user.plan_name }}</p>
                                <p class="text-lg text-gray-700 dark:text-gray-300" v-if="user.plan_personalizado">
                                    <span class="font-medium">Clases Restantes:</span> {{ user.clases_restantes }}
                                </p>
                                <p class="text-lg">
                                    <span class="font-medium">Estado del Plan:</span>
                                    <span :class="user.is_moroso ? 'text-red-500' : 'text-green-500'">
                                        {{ user.is_moroso ? 'Expirado' : 'Activo' }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <button @click="renewPlan(user)"
                            class="mt-4 w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium text-lg transition duration-300 shadow-md
                            sm:py-2 sm:px-3 sm:text-sm">
                            Renovar Plan
                        </button>
                    </div>
                    <!-- Calendario de Asistencias -->
                   <CalendarAttendance :user="user" />

                </div>
            </div>
        </div>
    </transition>

    <RenewPlans :open="openRenewSubscription" :user="dataUser" @close="closeRenewSubscription" />

</template>

<script setup>
import { ref, defineProps, defineEmits, onMounted } from 'vue';
import vueQr from 'vue-qr/src/packages/vue-qr.vue';
import CalendarAttendance from './CalendarAttendance.vue';
import RenewPlans from './RenewPlans.vue';


import QRCodeVue3 from 'qrcode-vue3'


const props = defineProps({
    open: { type: Boolean, required: true },
    user: { type: Object, required: true },
});

const form = ref({
    plan_id: null,
    remaining_classes: null,
});

const emit = defineEmits(['close', 'openEdit']);
const isMobile = ref(false);
const updateMobileView = () => isMobile.value = window.innerWidth <= 640;
const handleClose = () => emit('close');

const openRenewSubscription = ref(false);
const dataUser = ref({});

const toggleStatus = () => console.log(`Cambiando estado de usuario a: ${!props.user.status}`);
const editUser = () => {
    emit('openEdit', props.user);
}

const renewPlan = (user) => {
    console.log("Renovando plan para usuario:", user);
    openRenewSubscription.value = true;
    dataUser.value = user;
}

const closeRenewSubscription = () => {
    openRenewSubscription.value = false;
}


const containerTop = ref(0);
onMounted(() => {
    updateMobileView();
    window.addEventListener('resize', updateMobileView);
});

function downloadQr () {
    console.log('Descargando QR');
    let element = document.querySelector('.souvenirs_img');
    let urlItem = element.getAttribute('src');
    if (!urlItem) {
        console.error('No se pudo obtener el atributo src');
        return;
    }
    axios({
        url: urlItem,
        method: 'GET',
        responseType: 'blob'
    })
    .then((response) => {
        let nameqr = props.user.id_number;
        const url = window.URL.createObjectURL(response.data);
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', nameqr + '.png');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(url);
        toast.warningToast('QR descargado con éxito','top-right');
    });
}
</script>

<style>
.attendance-day {
    background-color: #22c55e;
    color: white;
    border-radius: 50%;
    padding: 5px;
    display: inline-block;
    width: 28px;
    text-align: center;
}

.my-download-button {
    padding: 5px;
    border-radius: 5px;
    background-color: #22c55e !important;
    color: white;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Transición de entrada y salida del modal */
.slide-enter-active, .slide-leave-active {
    transition: transform 0.4s ease-in-out;
}

.slide-enter-from {
    transform: translateX(100%);
}

.slide-enter-to {
    transform: translateX(0);
}

.slide-leave-from {
    transform: translateX(0);
}

.slide-leave-to {
    transform: translateX(100%);
}
</style>

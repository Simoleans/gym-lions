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
                    <h1 class="font-semibold text-2xl dark:text-white">Editar {{ user.name }}</h1>
                    <button @click="handleClose" class="text-gray-500 hover:text-red-500 dark:hover:text-red-400 text-xl">✕</button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-6">
                    <form
                        @submit.prevent="handleStore"
                        class="mt-6 space-y-6"
                    >
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="id_number" value="Cédula" />

                                <TextInput
                                    id="id_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.id_number"
                                    autofocus
                                    autocomplete="id_number"
                                />

                                <InputError class="mt-2" :message="form.errors.id_number" />
                            </div>

                            <div>
                                <InputLabel for="name" value="Nombre" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Email" />
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="username"
                                />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div>
                                <InputLabel for="phone" value="Teléfono" />
                                <TextInput
                                    id="phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.phone"
                                    required
                                    autocomplete="phone"
                                />

                                <InputError class="mt-2" :message="form.errors.phone" />
                            </div>

                            <div>
                                <InputLabel for="allergy" value="Alergia" />
                                <!-- select option alergy-->
                                <select id="allergy" class="mt-1 block w-full" v-model="form.allergy" autocomplete="allergy">
                                    <option value="" :selected="form.allergy === null">Selecciona una opción</option>
                                    <option value="polen">Polen</option>
                                    <option value="polvo">Ácaros del polvo</option>
                                    <option value="alimentos">Alimentos</option>
                                    <option value="medicamentos">Medicamentos</option>
                                    <option value="animales">Animales (pelo o caspa)</option>
                                    <option value="insectos">Picaduras de insectos</option>
                                    <option value="latex">Látex</option>
                                    <option value="moho">Moho</option>
                                    <option value="quimicos">Productos químicos</option>
                                    <option value="otros">Otros</option>
                                </select>

                                <InputError class="mt-2" :message="form.errors.allergy" />
                            </div>

                            <div>
                                <InputLabel for="injury" value="Lesión" />
                                <TextInput
                                    id="injury"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.injury"
                                    autocomplete="injury"
                                />

                                <InputError class="mt-2" :message="form.errors.injury" />
                            </div>

                            <!-- <div>
                                <InputLabel for="role" value="Rol" />
                                <select id="role" class="mt-1 block w-full" v-model="form.role" required autocomplete="role">
                                    <option value="">Selecciona un rol</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Cliente</option>
                                </select>

                                <InputError class="mt-2" :message="form.errors.role" />
                            </div>

                            <div>
                                <InputLabel for="start_date" value="Fecha de inicio" />
                                <TextInput
                                    id="start_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.start_date"
                                    required
                                    autocomplete="start_date"
                                />

                                <InputError class="mt-2" :message="form.errors.start_date" />
                            </div> -->

                            <div class="col-span-2">
                                <InputLabel value="Plan" class="mb-2" />

                                <ul class="grid w-full gap-6 md:grid-cols-3">
                                    <li v-for="plan in user.plans" :key="plan.value">
                                        <input
                                            type="radio"
                                            :id="`plan-${plan.id}`"
                                            :value="plan.id"
                                            v-model="form.plan_id"
                                            class="hidden peer"
                                            required
                                        />
                                        <label
                                            :for="`plan-${plan.id}`"
                                            class="inline-flex flex-col items-start justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 transition"
                                        >
                                            <div class="flex items-center gap-3 mb-3">
                                                <img src="/images/logo.png" class="h-6 mr-3 sm:h-9" alt="Lions Logo" />
                                                <div class="text-lg font-semibold">{{ plan.name }}</div>
                                            </div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ plan.classes_per_month }} clases por mes
                                            </div>
                                            <div class="mt-2 font-semibold text-gray-800 dark:text-gray-200">
                                                {{ formatPrice(plan.price) }}
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <input
                                            type="radio"
                                            id="plan-custom"
                                            value="custom"
                                            v-model="form.plan_id"
                                            class="hidden peer"
                                            required
                                        />
                                        <label
                                            for="plan-custom"
                                            class="inline-flex flex-col items-start justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 transition"
                                        >
                                            <div class="text-lg font-semibold mb-3">Días Personalizados</div>

                                            <div v-if="form.plan_id === 'custom'" class="w-full mt-2">
                                                <InputLabel for="remaining_classes" value="Cantidad de clases" />
                                                <TextInput
                                                    id="remaining_classes"
                                                    type="number"
                                                    class="mt-1 block w-full"
                                                    v-model="form.remaining_classes"
                                                    min="1"
                                                    required
                                                />
                                                <InputError class="mt-2" :message="form.errors.remaining_classes" />
                                            </div>
                                        </label>
                                    </li>
                                </ul>


                                <InputError class="mt-2" :message="form.errors.plan" />
                            </div>
                        </div> <!-- fin grid -->


                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing || !isFormValid">Guardar</PrimaryButton>
                            <Link :href="route('dashboard')" class="text-sm text-gray-600 dark:text-gray-400">Cancelar</Link>

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p
                                    v-if="form.recentlySuccessful"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >
                                    Guardado.
                                </p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </transition>

</template>

<script setup>
import { ref, defineProps, defineEmits, onMounted, watch } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2'



const props = defineProps({
    open: { type: Boolean, required: true },
    user: { type: Object, required: true },
});

const form = useForm({
    id_number: '',
    name: props?.user?.name,
    email: props.user.email,
    role: props.user.role,
    phone: props.user.phone,
    allergy: props.user.allergy,
    injury: props.user.injury,
    plan_id: props.user.plan_id,
    start_date: props.user.start_date,
    remaining_classes: props.user.remaining_classes,
});

const emit = defineEmits(['close']);
const isMobile = ref(false);
const updateMobileView = () => isMobile.value = window.innerWidth <= 640;
const handleClose = () => emit('close');

watch(() => props.user, (newUser) => {
    if (newUser) {
        form.id_number = newUser.id_number;
        form.name = newUser.name;
        form.email = newUser.email;
        form.role = newUser.role;
        form.phone = newUser.phone;
        form.allergy = newUser.allergy;
        form.injury = newUser.injury;
        form.plan_id = newUser.plan_id;
        form.start_date = newUser.start_date;
        form.remaining_classes = newUser.remaining_classes;
    }
}, { deep: true, immediate: true });


const containerTop = ref(0);
onMounted(() => {
    updateMobileView();
    window.addEventListener('resize', updateMobileView);
});

const formatPrice = (price) => {
    const usdCurrency = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });
    return usdCurrency.format(price);
}

</script>

<style scoped>

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

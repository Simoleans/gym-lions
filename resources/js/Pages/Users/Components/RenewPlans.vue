<template>
    <Dialog v-model:visible="props.open" modal header="Renovar Suscripción" :style="{ width: '50vw' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }" :position="'bottom'" :close="closeRenewSubscription">
        <span class="text-surface-500 dark:text-surface-400 block mb-8">Renovar la suscripción de {{ user?.name }}.</span>
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
                        <div class="flex items-center flex-col gap-3 mb-3">
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

                <!-- personalizada -->
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
                        </div>
                    </label>
                </li>
            </ul>
        </div>
        <div class="flex justify-end gap-2">
        <Button type="button" label="Cancelar" severity="secondary" @click="closeRenewSubscription"></Button>
        <Button type="button" label="Renovar" @click="handleRenewSubscription"></Button>
    </div>
    </Dialog>
</template>

<script setup>
import { ref, defineProps,  watch,  defineEmits } from 'vue';
import Dialog from 'primevue/dialog';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Button from 'primevue/button';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2'
import { usePage } from '@inertiajs/vue3';
const props = defineProps({
    open: { type: Boolean, default: false },
    user: { type: Object, required: true },
});

const emit = defineEmits(['close']);


const openRenewSubscription = ref(false);
const dataUser = ref({});

const form = useForm({
    plan_id: null,
    remaining_classes: null,
});

const formatPrice = (price) => {
    const usdCurrency = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });
    return usdCurrency.format(price);
}

watch(props.open, (newVal) => {
    openRenewSubscription.value = newVal;
    dataUser.value = props.user;
});

const closeRenewSubscription = () => {
    emit('close');
}

const handleRenewSubscription = () => {
    form.post(route('users.renew-subscription', { user: props.user.id }), {
        onSuccess: () => {
            if(usePage().props.flash.success){
                Swal.fire({
                    title: '¡Suscripción renovada!',
                    text: 'El usuario ha renovado su suscripción correctamente.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                    });
            }else{
                Swal.fire({
                    title: 'Error',
                    text: usePage().props.flash.error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
            form.reset();
            closeRenewSubscription();
            setTimeout(() => {
                location.reload();
            }, 1000);
        },
        onError: (errors) => {
            Swal.fire({
                title: 'Error',
                text: errors.message || 'No se pudo renovar la suscripción.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
}






</script>



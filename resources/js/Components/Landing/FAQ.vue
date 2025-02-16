<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-24 lg:px-6">
        <h2 class="mb-6 text-3xl font-extrabold tracking-tight text-center text-gray-900 lg:mb-8 lg:text-3xl dark:text-white">
            Preguntas frecuentes
        </h2>
        <div class="max-w-screen-md mx-auto">
            <div id="accordion-flush">
            <!-- Pregunta 1 -->
            <h3 id="accordion-flush-heading-1">
                <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-900 bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
                @click="toggleAccordion(1)"
                >
                <span>¿Qué es el Crossfit?</span>
                <svg
                    class="w-6 h-6 shrink-0"
                    :class="{ 'rotate-180': activeAccordion === 1 }"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                    ></path>
                </svg>
                </button>
            </h3>
            <div
                id="accordion-flush-body-1"
                v-show="activeAccordion === 1"
                class="py-5 border-b border-gray-200 dark:border-gray-700"
            >
                <p class="mb-2 text-gray-500 dark:text-gray-400">
                El Crossfit es un programa de entrenamiento funcional que combina ejercicios de fuerza, resistencia y alta
                intensidad. Su objetivo es mejorar la condición física general mediante movimientos variados y efectivos.
                </p>
            </div>

            <!-- Pregunta 2 -->
            <h3 id="accordion-flush-heading-2">
                <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                @click="toggleAccordion(2)"
                >
                <span>¿Cuáles son los beneficios del Crossfit?</span>
                <svg
                    class="w-6 h-6 shrink-0"
                    :class="{ 'rotate-180': activeAccordion === 2 }"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                    ></path>
                </svg>
                </button>
            </h3>
            <div
                id="accordion-flush-body-2"
                v-show="activeAccordion === 2"
                class="py-5 border-b border-gray-200 dark:border-gray-700"
            >
                <p class="mb-2 text-gray-500 dark:text-gray-400">
                El Crossfit mejora la fuerza, resistencia, flexibilidad y coordinación. Además, ayuda a reducir el estrés,
                aumentar la energía y fortalecer la confianza en uno mismo. Es un entrenamiento completo que se adapta a
                cualquier nivel.
                </p>
            </div>

            <!-- Pregunta 3 -->
            <h3 id="accordion-flush-heading-3">
                <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                @click="toggleAccordion(3)"
                >
                <span>¿Qué es el entrenamiento funcional?</span>
                <svg
                    class="w-6 h-6 shrink-0"
                    :class="{ 'rotate-180': activeAccordion === 3 }"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                    ></path>
                </svg>
                </button>
            </h3>
            <div
                id="accordion-flush-body-3"
                v-show="activeAccordion === 3"
                class="py-5 border-b border-gray-200 dark:border-gray-700"
            >
                <p class="mb-2 text-gray-500 dark:text-gray-400">
                El entrenamiento funcional se centra en realizar movimientos naturales y dinámicos que mejoran las
                habilidades diarias. Aumenta la fuerza, el equilibrio y la movilidad, ayudándote a prevenir lesiones.
                </p>
            </div>

            <!-- Pregunta 4 -->
            <h3 id="accordion-flush-heading-4">
                <button
                type="button"
                class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                @click="toggleAccordion(4)"
                >
                <span>¿La primera clase en Lions Fitness es gratuita?</span>
                <svg
                    class="w-6 h-6 shrink-0"
                    :class="{ 'rotate-180': activeAccordion === 4 }"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                    ></path>
                </svg>
                </button>
            </h3>
            <div
                id="accordion-flush-body-4"
                v-show="activeAccordion === 4"
                class="py-5 border-b border-gray-200 dark:border-gray-700"
            >
                <p class="mb-2 text-gray-500 dark:text-gray-400">
                ¡Sí! En <span class="font-semibold text-blue-600">Lions Fitness</span>, creemos en darte la oportunidad de
                experimentar nuestra comunidad y servicios. La primera clase es completamente gratuita. ¡Te esperamos!
                </p>
            </div>
            </div>
        </div>
        </div>
    </section>
</template>
<script setup>
    import { ref } from "vue";

    // Estado para rastrear qué acordeón está activo
    const activeAccordion = ref(1);

    // Función para alternar el acordeón
    const toggleAccordion = (index) => {
        activeAccordion.value = activeAccordion.value === index ? null : index;
    };
</script>

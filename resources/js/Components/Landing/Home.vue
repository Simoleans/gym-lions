<template>
    <section class="bg-white dark:bg-gray-900 relative overflow-hidden">
        <div class="grid max-w-screen-xl px-4 pt-32 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-40">
            <div class="mr-auto place-self-center lg:col-span-7 z-30">
            <h1
                class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white"
            >
                Bienvenido a
                <span
                class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 via-purple-400 to-purple-500"
                >
                {{ nameGym }}
                </span>
                : Tu mejor opción en Crossfit y Entrenamiento Funcional
            </h1>
            <p
                class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400"
            >
                En <span class="font-semibold text-purple-600">{{ nameGym }}</span>,
                ofrecemos entrenamientos personalizados de crossfit y funcionales
                diseñados para alcanzar tus objetivos. Contamos con
                <span class="font-semibold">entrenadores certificados</span> y un
                ambiente motivador que te ayudará a sacar tu máximo potencial.
            </p>
            <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <a
                href="#contact"
                class="items-center justify-center w-full px-5 py-3 text-sm font-medium text-center text-gray-900 border border-gray-200 rounded-lg sm:w-auto hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800 flex gap-1"
                >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
        </svg>
                Contáctanos
                </a>
                <a
                href="#services"
                class="inline-flex items-center justify-center w-full px-5 py-3 mb-2 mr-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:w-auto focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                >
                Descubre nuestros planes
                </a>
            </div>
            </div>
        <!--  <div class="hidden lg:mt-0 lg:col-span-5 lg:flex z-30">
            <img src="/images/gym/home.png" alt="hero image" />
            </div> -->
        </div>
        <!-- Fondo con degradado -->
        <div class="absolute inset-0 bg-gradient-to-l from-transparent to-white dark:to-gray-900">
            <img
            src="/images/logo.png"
            alt="logo background"
            class="absolute right-0 h-full object-contain opacity-10"
            />
        </div>
    </section>
</template>
<script setup>
    const nameGym = 'Lions Fitness';
</script>

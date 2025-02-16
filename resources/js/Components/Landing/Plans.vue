<template>
    <section class="bg-white dark:bg-gray-900">
      <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-24 lg:px-6">
        <div class="max-w-screen-md mx-auto mb-8 text-center lg:mb-12">
          <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
            Planes de Lions Fitness 🦁
          </h2>
          <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">
            ¡Tu primera clase va por la casa! Aquí encontrarás los planes ideales para alcanzar tus objetivos físicos.
          </p>
          <p class="mb-5 font-semibold text-lg text-gray-700 dark:text-gray-300">
            Inscripción única: <span class="text-purple-600">$5</span>
          </p>
        </div>
        <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
          <div
            v-for="plan in plans"
            :key="plan.title"
            class="relative flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow transition-all duration-300 hover:shadow-2xl dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white hover:ring-4 hover:ring-purple-600"
          >
            <h3 class="mb-4 text-2xl font-semibold">{{ plan.title }}</h3>
            <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">{{ plan.description }}</p>
            <div class="flex items-baseline justify-center my-8">
              <span class="mr-2 text-5xl font-extrabold">{{ plan.price }}</span>
              <span class="text-gray-500 dark:text-gray-400">/mes</span>
            </div>
            <ul role="list" class="mb-8 space-y-4 text-left">
              <li v-for="feature in plan.features" :key="feature" class="flex items-center space-x-3">
                <svg
                  class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                <span>{{ feature }}</span>
              </li>
            </ul>
            <a
              :href="plan.link"
              target="_blank"
              class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-purple-900"
            >
              Comprar Plan
            </a>
          </div>
        </div>
      </div>
    </section>
  </template>

  <script setup>
  const plans = [
    {
      title: 'Plan Novato',
      description: '12 clases mensuales de una hora cada una.',
      price: '$15',
      features: ['Clases de lunes a viernes', 'Duración: 1 hora por clase'],
      link: 'https://wa.me/584142656733?text=Hola,%20estoy%20interesado%20en%20el%20Plan%20Novato%20de%20Lions%20Fitness.',
    },
    {
      title: 'Plan Intermedio',
      description: '20 clases mensuales de una hora cada una.',
      price: '$20',
      features: ['Clases de lunes a viernes', 'Duración: 1 hora por clase'],
      link: 'https://wa.me/584142656733?text=Hola,%20estoy%20interesado%20en%20el%20Plan%20Intermedio%20de%20Lions%20Fitness.',
    },
    {
      title: 'Plan Full',
      description: 'Programa híbrido de musculación y crosstraining.',
      price: '$40',
      features: [
        'Musculación y Crosstraining',
        'Seguimiento antropométrico',
        'Plan alimenticio personalizado',
        'Clases de lunes a viernes',
      ],
      link: 'https://wa.me/584142656733?text=Hola,%20estoy%20interesado%20en%20el%20Plan%20Full%20de%20Lions%20Fitness.',
    },
  ];
  </script>

  <style scoped>
  .hover-card:hover {
    box-shadow: 0 0 25px rgba(126, 34, 206, 0.9);
  }
  </style>

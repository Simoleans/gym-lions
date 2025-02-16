<template>
    <footer class="bg-white dark:bg-gray-800">
        <div class="max-w-screen-xl p-4 py-6 mx-auto lg:py-16 md:p-8 lg:p-10">
            <!-- Contenedor de dirección y mapa -->
            <div class="flex flex-col items-center lg:flex-row lg:justify-between">
                <!-- Dirección y botón de WhatsApp -->
                <div class="mb-6 text-center lg:mb-0 lg:text-left">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Contáctanos</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300">📍 Aragua - Cagua, Casiquiare</p>
                    <p class="text-gray-700 dark:text-gray-300">📞 Teléfono: +58 414-265-6733</p>
                    <a
                        href="https://wa.me/584142656733?text=Hola,%20quisiera%20información%20sobre%20los%20planes%20de%20entrenamiento"
                        target="_blank"
                        class="mt-4 inline-block px-5 py-2.5 text-sm font-medium text-white bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800">
                        Enviar mensaje por WhatsApp
                    </a>
                </div>
                <!-- Mapa de Google -->
                <div class="w-full h-64 lg:w-1/2 lg:h-72">
                    <iframe
                        src="https://www.google.com/maps?q=10.1632378,-67.4642877&z=17&hl=es&output=embed"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        class="rounded-lg shadow-lg">
                    </iframe>
                </div>
            </div>

            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">

            <!-- Créditos y redes sociales -->
            <div class="text-center">
                <!-- Logo -->
                <a href="/" class="flex items-center justify-center mb-5 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img src="/images/logo.png" class="h-6 mr-3 sm:h-9" alt="Lions Fitness Logo" />
                    Lions Fitness
                </a>
                <!-- Derechos reservados -->
                <span class="block text-sm text-gray-500 dark:text-gray-400">
                    © 2021-2023 <strong>Lions Fitness™</strong>. Todos los derechos reservados.
                </span>
                <!-- Redes sociales -->
                <div class="flex justify-center mt-5">
                    <a
                        href="https://instagram.com/lionsfitnesscenter"
                        aria-label="Instagram"
                        target="_blank"
                        class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>

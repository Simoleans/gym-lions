import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';


import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';
import Button from 'primevue/button';
import 'primeicons/primeicons.css'


import VCalendar from 'v-calendar';
import 'v-calendar/style.css';

import vueQr from 'vue-qr/src/packages/vue-qr.vue'




const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VCalendar)
            .use(vueQr)
            .use(PrimeVue,{
                theme : {
                    preset : Aura
                }
            })
            .component('Button', Button)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

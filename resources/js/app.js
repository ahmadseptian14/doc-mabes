import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { Ziggy } from './ziggy'; // Jika Ziggy didefinisikan di sini
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
     // Konfigurasi Toastification
    const toastOptions = {
        position: 'top-right', // Posisi notifikasi
        timeout: 3000,       // Durasi tampil
    };
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .use(Toast, toastOptions)
      .mount(el)
  },
})

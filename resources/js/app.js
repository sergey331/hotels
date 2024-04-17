import './bootstrap';
import '../css/app.css';
import 'flowbite';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import store from "@/store/index.js";
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
import VueSidebarMenu from 'vue-sidebar-menu'
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'
import '@vuepic/vue-datepicker/dist/main.css';
import VueDatePicker from '@vuepic/vue-datepicker';
import VueSelect  from "vue-select";
import CustomScrollbar from 'custom-vue-scrollbar';
import "vue-select/dist/vue-select.css";
import 'custom-vue-scrollbar/dist/style.css';

import Vue3Toastify from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import '../../node_modules/@syncfusion/ej2-base/styles/material.css';
import '../../node_modules/@syncfusion/ej2-inputs/styles/material.css';
import '../../node_modules/@syncfusion/ej2-popups/styles/material.css';
import '../../node_modules/@syncfusion/ej2-lists/styles/material.css';
import "../../node_modules/@syncfusion/ej2-vue-calendars/styles/material.css";
import { FwbPagination } from 'flowbite-vue'
import DropdownMenu from 'v-dropdown-menu'
// import 'v-dropdown-menu/dist/vue3/v-dropdown-menu.css'


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(store)
            .use(VueSidebarMenu)
            .use(
                Vue3Toastify,
                {
                    autoClose: 2000,
                    style: {
                        opacity: '1',
                        userSelect: 'initial',
                    },
                }
            )
            .use(ZiggyVue, Ziggy,DropdownMenu)
            .component('VueDatePicker', VueDatePicker)
            .component('VueSelect', VueSelect)
            .component('CustomScrollbar', CustomScrollbar)
            .component('pagination', FwbPagination)

            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

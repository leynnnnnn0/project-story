import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import PrimeVue from "primevue/config";
import Layout from "./Layouts/App.vue";
import ToastService from "primevue/toastservice";
import Aura from "@primevue/themes/aura";
import { Button } from "@/components/ui/button";
import Loading from "./Components/Loading.vue";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Layout", Layout)
            .component("Button", Button)
            .component("Loading", Loading)
            .use(PrimeVue, {
                theme: {
                    preset: Aura,
                    options: {
                        prefix: "p",
                        darkModeSelector: "system",
                        cssLayer: false,
                    },
                },
            })
            .use(ToastService)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});

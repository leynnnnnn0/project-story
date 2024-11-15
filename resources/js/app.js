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
import DivFlexCenter from "./Components/div/DivFlexCenter.vue";
import DivFlexCol from "./Components/div/DivFlexCol.vue";
import { Input } from "@/components/ui/input";
import Table from "./Components/table/Table.vue";
import TH from "./Components/table/TH.vue";
import TD from "./Components/table/TD.vue";
import { Link } from "@inertiajs/vue3";
import Popover from "primevue/popover";
import TableContainer from "./Components/table/TableContainer.vue";
import { MagnifyingGlassIcon } from "@radix-icons/vue";
import SearchBar from "./Components/table/SearchBar.vue";
import TableHeader from "./Components/table/TableHeader.vue";
import TableHead from "./Components/table/TableHead.vue";
import TableBody from "./Components/table/TableBody.vue";
import { Filter, Eye } from "lucide-vue-next";

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
            .component("DivFlexCenter", DivFlexCenter)
            .component("DivFlexCol", DivFlexCol)
            .component("Input", Input)
            .component("Table", Table)
            .component("TH", TH)
            .component("TD", TD)
            .component("Link", Link)
            .component("Popover", Popover)
            .component("TableContainer", TableContainer)
            .component("MagnifyingGlassIcon", MagnifyingGlassIcon)
            .component("SearchBar", SearchBar)
            .component("TableHeader", TableHeader)
            .component("TableHead", TableHead)
            .component("TableBody", TableBody)
            .component("Filter", Filter)
            .component("Eye", Eye)
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

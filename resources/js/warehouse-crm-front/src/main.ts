import { createApp } from 'vue';
import App from './App.vue';
import 'line-awesome/dist/line-awesome/css/line-awesome.min.css';
import VueApexCharts from 'vue3-apexcharts';
import { registerPlugins } from '@/plugins';
import { createPinia } from 'pinia';
const pinia = createPinia();

const app = createApp(App);

app.use(VueApexCharts);
app.use(pinia);
registerPlugins(app);

app.mount('#app');

import './bootstrap';
import { createApp } from 'vue';
import ApiForm from './forms/components/ApiForm.vue';

const app = createApp({});
app.component('ApiForm', ApiForm);

app.mount('#app');

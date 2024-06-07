import './bootstrap';
import { createApp } from 'vue';
import ApiForm from './forms/components/ApiForm.vue';
import PrimaryButton from './buttons/components/PrimaryButton.vue';

const app = createApp({});
app.component('ApiForm', ApiForm);
app.component('PrimaryButton', PrimaryButton);

app.mount('#app');

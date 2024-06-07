import './bootstrap';
import { createApp } from 'vue';
import ApiForm from './forms/components/ApiForm.vue';
import PrimaryButton from './buttons/components/PrimaryButton.vue';
import BooksList from './books/components/BooksList.vue';

const app = createApp({});
app.component('ApiForm', ApiForm);
app.component('PrimaryButton', PrimaryButton);
app.component('BooksList', BooksList);

app.mount('#app');

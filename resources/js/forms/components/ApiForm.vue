<template>
  <form @submit.prevent="submit">
    <div class="space-y-10 divide-y divide-gray-900/10">
      <div v-for="section in form.sections" :key="section.id" :id="section.id" class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div v-if="section.label || section.description" class="px-4 sm:px-0 space-y-1">
          <h2 v-if="section.label" class="text-base font-semibold leading-7 text-gray-900">
            {{ section.label }}
          </h2>
          <p v-if="section.description" class="text-sm leading-6 text-gray-600">
            {{ section.description }}
          </p>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-black/10 sm:rounded-xl md:col-span-2">
          <div class="px-4 py-6 sm:p-8">
            <div class="space-y-8">
              <div v-for="field in section.fields" :id="`Section-${section.id}-Field-${field.id}`">
                <component :is="formFields[field.type]" :field="field" v-model="values[field.name]" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex items-center justify-end gap-x-6 py-4">
      <ApiFormButtons :submitting="submitting" :buttons="form.form.buttons" />
    </div>
  </form>
</template>

<script setup>
import { useForm } from '../composables/forms.js';
import TextField from './fields/TextField.vue';
import TextareaField from './fields/TextareaField.vue';
import SelectField from './fields/SelectField.vue';
import RadioGroupField from './fields/RadioGroupField.vue';
import CheckboxField from './fields/CheckboxField.vue';
import ApiFormButtons from './ApiFormButtons.vue';

const props = defineProps({
  form: {
    required: true,
    type: Object,
  },
});

const formFields = {
  TextField,
  TextareaField,
  SelectField,
  RadioGroupField,
  CheckboxField,
  ToggleField: CheckboxField,
};

const { values, submitting, submit } = useForm(props);
</script>

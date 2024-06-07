<template>
  <component :is="tag" v-bind="bindings" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
    <slot />
  </component>
</template>

<script setup>
import { useButton } from '../composables/buttons.js';

const props = defineProps({
  type: {
    required: false,
    type: String,
    default: 'button',
  },

  href: {
    required: false,
    type: String,
    default: null,
  },
});

const { tag, bindings } = useButton(props);
</script>

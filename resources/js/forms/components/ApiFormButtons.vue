<template>
  <template v-for="button in buttons">
    <PrimaryButton v-if="button.type === 'submit'"
                   type="submit"
                   :disabled="submitting"
                   @click="$emit('submit')"
    >
      {{ button.label }}
    </PrimaryButton>
    <SecondaryButton v-else-if="button.type === 'cancel'"
                     type="button"
                     :disabled="submitting"
                     @click="$emit('cancel')"
    >
      {{ button.label }}
    </SecondaryButton>
    <SecondaryButton v-else-if="button.type === 'link'" :href="button.url">
      {{ button.label }}
    </SecondaryButton>
  </template>
</template>

<script setup>
import PrimaryButton from '../../buttons/components/PrimaryButton.vue';
import SecondaryButton from '../../buttons/components/SecondaryButton.vue';

defineProps({
  buttons: {
    required: true,
    type: Array,
  },

  submitting: {
    required: false,
    type: Boolean,
  },
});

defineEmits(['submit', 'cancel']);
</script>

import { ref } from 'vue';
import axios from 'axios';

export function useForm(props) {
  const values = ref({});
  const submitting = ref(false);
  const submit = async () => {
    if (submitting.value) {
      return false;
    }

    submitting.value = true;

    try {
      await axios.request({
        url: props.form.form.url,
        method: props.form.form.method,
        data: { ...values.value },
        headers: { ...props.form.form.headers },
      });

      alert('Form submitted successfully. Page will now reload.');

      location.reload();
    } catch (e) {
      alert(e?.response?.data?.error?.message || 'Something went wrong.');
      console.error(e);
    } finally {
      submitting.value = false;
    }
  };

  return {
    values,
    submitting,
    submit,
  };
}

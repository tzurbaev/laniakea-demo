import { computed } from 'vue';

export function useButton(props) {
  const tag = computed(() => props.href ? 'a' : 'button');
  const bindings = computed(() => {
    if (props.href) {
      return {
        href: props.href,
      };
    }

    return {
      type: props.type,
    };
  });

  return {
    tag,
    bindings,
  };
}

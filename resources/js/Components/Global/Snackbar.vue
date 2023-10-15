<template>
  <v-snackbar
      v-model="snackbar.show"
      :color="snackbar.color"
      :timeout="snackbar.timeout"
  >
    {{ snackbar.text }}

    <template v-slot:actions>
      <v-btn
          @click="snackbar.show = false"
      >
        Close
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
import { reactive } from 'vue';

const snackbar = reactive({
  show: false,
  text: '',
  color: '',
  timeout: 3000,
});

export const useSnackbar = () => {
  return {
    showSnackbar(text, color = 'success', timeout = 3000) {
      snackbar.show = true;
      snackbar.text = text;
      snackbar.color = color;
      snackbar.timeout = timeout;
    },
  };
};

export default {
  setup() {
    return {
      snackbar,
    };
  },
};
</script>

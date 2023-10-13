<script setup>
import {ref} from 'vue';
import MainMenu from "@/Components/MainMenu.vue";

const showingNavigationDropdown = ref(false);

</script>

<template>
  <main-menu></main-menu>
  <div class="min-h-screen bg-gray-100">
    <!-- Page Content -->
    <main>
      <slot/>
    </main>
  </div>
</template>

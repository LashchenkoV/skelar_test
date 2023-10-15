<script setup>
import MainMenu from "@/Components/MainMenu.vue";
import Snackbar from "@/Components/Global/Snackbar.vue";

</script>

<template>
  <v-app>
    <main-menu></main-menu>
    <v-main class="min-h-screen bg-gray-100">
      <v-container class="px-7">
        <slot/>
      </v-container>
    </v-main>
    <snackbar></snackbar>
  </v-app>
</template>

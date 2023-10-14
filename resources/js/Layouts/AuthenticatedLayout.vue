<script setup>
import MainMenu from "@/Components/MainMenu.vue";

</script>

<template>
  <v-app>
    <main-menu></main-menu>
    <v-main class="min-h-screen bg-gray-100">
      <v-container class="px-7">
        <slot/>
      </v-container>
    </v-main>
  </v-app>
</template>

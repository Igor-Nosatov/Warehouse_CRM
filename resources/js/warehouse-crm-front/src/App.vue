<template>
  <v-app class="main-layout">
    <router-view />
  </v-app>
</template>

<style scoped>

.main-layout:before {
  min-width: 1600px;
}

[data-v-app] {
  margin: 0;
  padding: 0;
}

.las {
  font-size: 26px;
}



</style>

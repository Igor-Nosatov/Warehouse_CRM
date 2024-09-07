<template>
  <v-card class="login-card" aria-labelledby="login-title" role="form">
    <v-card-title
      class="headline py-3 mr-3 font-weight-black"
      id="login-title"
    >
      Login
    </v-card-title>
    <v-card-text>
      <slot></slot>
    </v-card-text>
  </v-card>
</template>


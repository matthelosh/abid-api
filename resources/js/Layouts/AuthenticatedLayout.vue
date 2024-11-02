<script setup>
import { ref } from 'vue';

</script>

<template>
    <v-app>
        <v-app-bar>
            <v-app-bar-title>Abid API</v-app-bar-title>
        </v-app-bar>
        <v-navigation-drawer>
            <v-list>
                <v-list-item>Halo</v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>

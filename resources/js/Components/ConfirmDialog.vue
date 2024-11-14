<script setup>
import { ref } from 'vue';
import { VDialog, VCard, VCardTitle, VCardText, VCardActions, VBtn, VSpacer } from 'vuetify/lib/components/index.mjs';

const dialog = ref(false)
const title = ref('')
const message = ref('')

let resolvePromise

const openDialog = (options) => {
    title.value = options.title || 'Confirm'
    message.value = options.message || ''
    dialog.value = true

    return new Promise((resolve) => {
        resolvePromise = resolve
    })
}

const handleConfirm = () => {
    dialog.value = false
    if (resolvePromise) {
        resolvePromise(true)
    }
}

const close = () => {
    dialog.value = false
    if (resolvePromise) {
        resolvePromise(false)
    }
}

defineExpose({openDialog})

</script>

<template>
    <v-dialog
        v-model="dialog" 
        max-width="400"
    >
        <v-card>
            <v-card-title class="headline">{{ title }}</v-card-title>
            <v-card-text>
                {{ message }}
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green darken-1" text @click="handleConfirm">Iya</v-btn>
                <v-btn color="grey darken-1" text @click="close">Batal</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>


<script setup>
import { defineAsyncComponent, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const WriteMateri = defineAsyncComponent(() => import('@/Components/WriteMateri.vue'))
const Soal = defineAsyncComponent(() => import('@/Components/Soal.vue'))

const props = defineProps({ kelas: Array})

const materiHeaders = ref([
    { title: 'Cover', key: 'cover'},
    { title: 'Judul', key: 'bab'},
    { title: 'Konten', key: 'content'},
    { title: 'Soal', key: 'soals'},
    { title: 'Opsi', key: 'opsi'},
])
const selectedBab = ref(null)
const selectedMateri = ref(null)
const openWriteWateri = ref(false)
const addMateri = (bab) => {
    selectedBab.value = bab
    openWriteWateri.value = true
}

const closeWriteMateri = () => {
    selectedBab.value = null
    selectedMateri.value = null
    openWriteWateri.value = null
    router.reload({only: ['kelas']})
}

const openSoal = ref(false)
const addSoal = (materi) => {
    selectedMateri.value = materi
    openSoal.value = true
}

const closeSoal = () => {
    selectedMateri.value = null
    openSoal.value = false
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>
        <div class="content pa-4" style="background: linear-gradient(#78e79888, #a389d589)">
            <v-card >
                <v-card-title>Data Bab</v-card-title>
                <v-card-text>
                    <v-expansion-panels>

                        <v-expansion-panel
                            v-for="kelas in kelas"
                            :title="`${kelas.label}`"
                        >
                            <v-expansion-panel-text>
                                <v-expansion-panels>
                                    <v-expansion-panel
                                        v-for="bab in kelas.babs"
                                        :title="`${bab.label}`"
                                    >
                                        <v-expansion-panel-text>
                                            <v-toolbar density="compact" color="primary" >
                                                <v-toolbar-title>Daftar Materi</v-toolbar-title>
                                                <v-spacer></v-spacer>
                                                <v-btn text @click="addMateri(bab)">
                                                    <v-icon>mdi-plus</v-icon>
                                                    Tulis Materi
                                                </v-btn>
                                            </v-toolbar>
                                            <v-data-table :items="bab.materis" :headers="materiHeaders">
                                                <template v-slot:item.cover="{item}">
                                                    <v-img :src="item.cover">
                                                        <template v-slot:default v-if="!item.cover">
                                                            <v-icon>mdi-image</v-icon>
                                                        </template>
                                                    </v-img>
                                                </template>
                                                <template v-slot:item.bab="{item}">
                                                    {{ item?.title }}
                                                </template>
                                                <template v-slot:item.content="{item}">
                                                    {{ item?.content.substring(0,100) }}
                                                </template>
                                                <template v-slot:item.soals="{item}">
                                                    <v-btn color="primary" @click="addSoal(item)" size="small" variant="outlined" >
                                                        {{ item?.soals.length }} butir
                                                    </v-btn>
                                                </template>
                                                <template v-slot:item.opsi="{item}">
                                                    <div class="v-btn-group" size="small" >
                                                        <v-btn color="warning" size="small" variant="outlined" >
                                                            <v-icon>mdi-pencil</v-icon>
                                                        </v-btn>
                                                        <v-btn color="error" size="small" variant="outlined" >
                                                            <v-icon>mdi-trash-can</v-icon>
                                                        </v-btn>
                                                    </div>
                                                </template>
                                            </v-data-table>
                                        </v-expansion-panel-text>
                                    </v-expansion-panel>
                                </v-expansion-panels>
                            </v-expansion-panel-text>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-card-text>
            </v-card>
        </div>
    </AuthenticatedLayout>
    <WriteMateri v-if="openWriteWateri" :selected-materi="selectedMateri" :selected-bab="selectedBab" :open="openWriteWateri" @close="closeWriteMateri" />
    <Soal v-if="openSoal" :selected-materi="selectedMateri" :open="openSoal" @close="closeSoal" />
</template>

<style>
    .content {
        background: linear-gradient(to botton, #890790, #334688);
    }
</style>

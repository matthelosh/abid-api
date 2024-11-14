<script setup>
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { onBeforeMount, ref } from 'vue';
import { BaseKit, Bold, BulletList, Color, FontFamily, FontSize, Fullscreen, Heading, Highlight, History, Image, Italic, Link, OrderedList, Strike, Table, TaskList, TextAlign, Underline, Video, VuetifyTiptap, VuetifyViewer } from 'vuetify-pro-tiptap'
import 'vuetify-pro-tiptap/style.css'
const QuestionExtensions = [
  BaseKit.configure({
    placeholder: {
      placeholder: 'Enter some text...'
    }
  }),
  Bold,
  Italic,
  Underline,
  Strike,
  OrderedList,
  BulletList,
  TextAlign,
  FontSize,
  FontFamily,
  Color,
  Highlight,
  Heading,
  Link,
  Image.configure({
    divider: true,
    upload: (file, response) => {
        let fd = new FormData()
        fd.append("file", file)
        return axios.post(route('dashboard.soal.image.upload'),fd)
            .then(res => {
                console.log(res.data)
                return Promise.resolve(res.data)
            }).catch(err => {
                console.log(err)
                return Promise.reject(err)
            })
    }
  }),
  Video,
  Table,
  Fullscreen,
  History
]
const OptionExtensions = [
  BaseKit.configure({
    placeholder: {
      placeholder: 'Tulis Pilihan'
    }
  }),
  TextAlign,
  FontSize,
  Bold,
  Italic,
  Underline,
  Strike,
  OrderedList,
  BulletList,
  TaskList,
  Color,
  Highlight,
  Heading,
  Link,
  Image.configure({
    divider: true,
    upload: (file, response) => {
        let fd = new FormData()
        fd.append("file", file)
        return axios.post(route('dashboard.soal.image.upload'),fd)
            .then(res => {
                console.log(res.data)
                return Promise.resolve(res.data)
            }).catch(err => {
                console.log(err)
                return Promise.reject(err)
            })
    }
  }),
  Video,
  Table,
  History
]

const props = defineProps({ selectedMateri: Object, open: Boolean })
const emit = defineEmits(['close'])
const show = ref(false)
const mode = ref('list')
const soals = ref([])

const pertanyaan = ref('Tulis pertanyaan')
const soalId = ref(null)
const a = ref('Pilihan A')
const b = ref('Pilihan B')
const c = ref('Pilihan C')
const d = ref('Pilihan D')
const kunci = ref('')
const selectedSoal = ref(null)

const edit = (item) => {
    selectedSoal.value = item
    pertanyaan.value = item.pertanyaan
    soalId.value = item.id
    a.value = item.a
    b.value = item.b
    c.value = item.c
    d.value = item.d
    kunci.value = item.kunci
    mode.value = 'form'
}

const closeForm = () => {
    selectedSoal.value = null
    soalId.value = null
    a.value = ""
    b.value = ""
    c.value = ""
    d.value = ""
    kunci.value = ""
    mode.value = 'list'

    router.reload({only: ['kelas']})
}

const simpan = async() => {
    let fd = new FormData()
    fd.append("materi_id", props.selectedMateri.id)
    if (soalId.value) {
        fd.append("soalId", soalId.value)
    }
    fd.append("pertanyaan", pertanyaan.value)
    fd.append("a", a.value)
    fd.append("b", b.value)
    fd.append("c", c.value)
    fd.append("d", d.value)
    fd.append("kunci", kunci.value)

    await axios.post(route('dashboard.soal.store'), fd)
        .then(res => {
            console.log(res)
            closeForm()
        }).catch(err => {
            console.log(err)
        })
}

const hapus = async(item) => {
    await axios.delete(route('dashboard.soal.delete', {id: item.id}))
        .then(res => {
            router.reload({only: ['kelas']})
            soals.value = props.selectedMateri.soals ?? []
            let index = soals.value.findIndex(soal => soal.id == item.id)
            soals.value.splice(index,1)
        }).catch(err => {
            console.log(err)
        })
}

const soalHeaders = ref([
    { title: 'Pertanyaan', key: 'pertanyaan'},
    { title: 'A', key: 'a'},
    { title: 'B', key: 'b'},
    { title: 'C', key: 'c'},
    { title: 'D', key: 'd'},
    { title: 'Kunci', key: 'kunci'},
    { title: 'Opsi', key: 'opsi'},
])

onBeforeMount(() => {
    show.value = props.open
    soals.value = props.selectedMateri.soals ?? []
})
</script>

<template>
<v-dialog v-model="show" fullscreen scrollable>
    <v-card>
        <v-card-title class="pa-0">
            <v-toolbar color="primary">
                <v-toolbar-title>Daftar Soal: {{ props.selectedMateri?.title }}</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-btn color="white" variant="outlined"  class="mr-2" v-if="mode=='list'" @click="mode = 'form'" >
                    <v-icon>mdi-plus</v-icon>
                     Buat
                </v-btn>
                <v-btn color="red-lighten-4" variant="outlined" @click="mode = 'list'" class="mr-2" v-else >
                    <v-icon>mdi-close</v-icon>
                     Batal
                </v-btn>
                <v-btn color="white" variant="outlined" @click="simpan" class="mr-2">
                    Simpan
                </v-btn>
                <v-btn color="red-lighten-2" icon @click="emit('close')">
                    <v-icon>mdi-close-circle</v-icon>
                </v-btn>
            </v-toolbar>
        </v-card-title>
        <v-card-text>
            <v-data-table :headers="soalHeaders" :items="soals" v-if="mode=='list'">
                <template v-slot:item.pertanyaan="{item}">
                    <div v-html="item.pertanyaan"></div>
                </template>
                <template v-slot:item.a="{item}">
                    <div v-html="item.a"></div>
                </template>
                <template v-slot:item.b="{item}">
                    <div v-html="item.b"></div>
                </template>
                <template v-slot:item.c="{item}">
                    <div v-html="item.c"></div>
                </template>
                <template v-slot:item.d="{item}">
                    <div v-html="item.d"></div>
                </template>
                <template v-slot:item.kunci="{item}">
                    <div v-html="item.kunci"></div>
                </template>
                <template v-slot:item.opsi="{item}">
                    <span>
                        <v-btn color="warning" variant="flat" icon size="small" class="mr-2" @click="edit(item)">
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn color="error" variant="flat" icon size="small" @click="hapus(item)">
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </span>
                </template>
            </v-data-table>

            <v-container v-if="mode=='form'">
                <v-row justify="center">
                    <v-col cols="12" sm="12" lg="8">
                        <v-form>
                            <v-card variant="outlined" color="blue-darken-4">
                                <v-card-title>Form Soal</v-card-title>
                                <v-card-text>
                                    <h2 class="font-bold">Pertanyaan</h2>
                                    <VuetifyTiptap v-model="pertanyaan" :extensions="QuestionExtensions" :outlined="true" />
                                    
                                    <v-divider></v-divider>
                                    <h3 class="mt-8 font-bold">Jawaban:</h3>
                                    <h3 class="mt-8 font-bold">Pilihan A:</h3>
                                    <VuetifyTiptap v-model="a" :extensions="OptionExtensions" />
                                    <h3 class="mt-8 font-bold">Pilihan B:</h3>
                                    <VuetifyTiptap v-model="b" :extensions="OptionExtensions"  />
                                    <h3 class="mt-8 font-bold">Pilihan C:</h3>
                                    <VuetifyTiptap v-model="c" :extensions="OptionExtensions"   />
                                    <h3 class="mt-8 font-bold">Pilihan D:</h3>
                                    <VuetifyTiptap v-model="d" :extensions="OptionExtensions"  />
                                    <h3 class="mt-8 font-bold">Kunci Jawaban</h3>
                                    <v-radio-group v-model="kunci" inline>
                                        <v-radio
                                            v-for="key in ['a','b','c','d']"
                                            :label="key.toUpperCase()"
                                            :value="key"
                                        ></v-radio>
                                    </v-radio-group>
                                </v-card-text>
                            </v-card>
                        </v-form>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
    </v-card>
</v-dialog>
</template>
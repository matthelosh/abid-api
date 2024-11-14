<template>
    <div>
        <v-dialog fullscreen v-model="show" scrollable>
            <v-card>
                <v-card-title class="pa-0">
                    <v-toolbar color="primary">
                        <v-toolbar-title
                            >Tulis Materi
                            {{ props.selectedBab.label }}</v-toolbar-title
                        >
                        <v-spacer></v-spacer>
                        <v-btn
                            color="white"
                            variant="outlined"
                            size="small"
                            class="mr-2"
                            @click="simpan"
                            >Simpan</v-btn
                        >
                        <v-btn
                            icon
                            color="red-lighten-2"
                            @click="emit('close')"
                        >
                            <v-icon>mdi-close-circle</v-icon>
                        </v-btn>
                    </v-toolbar>
                </v-card-title>
                <v-card-text>
                    <v-text-field
                        label="Judul"
                        v-model="materi.title"
                    ></v-text-field>
                    <v-expansion-panels class="mb-4">
                        <v-expansion-panel title="Gambar Sampul">
                            <v-expansion-panel-text>
                                
                                <input
                                    type="file"
                                    ref="inputCover"
                                    class="hidden"
                                    @change="onCoverPicked"
                                    accept=".jpg, .JPG, .jpeg, .JPEG, .png, .PNG, .webp, .svg"
                                />
                                <v-img
                                    @click="$refs.inputCover.click()"
                                    :src="materi.cover"
                                    max-width="400"
                                >
                                    <template
                                        v-slot:default
                                        v-if="!materi.cover"
                                    >
                                        <v-icon style="font-size: 10rem; text-align: center; cursor: pointer;">mdi-image</v-icon>
                                    </template>
                                </v-img>
                            </v-expansion-panel-text>
                        </v-expansion-panel>
                    </v-expansion-panels>
                    <VuetifyTiptap
                        v-model="materi.content"
                        :extensions="extensions"
                    />
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-snackbar
            v-model="snackbar.show"
            :duration="snackbar.duration"
            :color="snackbar.color"
        >
            {{ snackbar.message }}
        </v-snackbar>
    </div>
</template>

<script setup>
import axios from "axios";
import { computed, onBeforeMount, onMounted, ref } from "vue";
// import { computed, markRaw, onBeforeMount, onMounted, reactive, ref } from 'vue';
import {
    BaseKit,
    Bold,
    Color,
    Fullscreen,
    Heading,
    Highlight,
    History,
    Image,
    Italic,
    Link,
    OrderedList,
    BulletList,
    TaskList,
    Strike,
    Table,
    Underline,
    Video,
    VuetifyTiptap,
    VuetifyViewer,
    FontFamily,
    FontSize,
    TextAlign,
} from "vuetify-pro-tiptap";
import "vuetify-pro-tiptap/style.css";

const props = defineProps({
    selectedMateri: Object,
    open: Boolean,
    selectedBab: Object,
});
const emit = defineEmits(["close"]);
// const apiUri = computed(() => )
const extensions = [
    BaseKit.configure({
        placeholder: {
            placeholder: "Enter some text...",
        },
    }),
    Bold,
    Italic,
    Underline,
    Strike,
    FontFamily,
    FontSize,
    TextAlign,
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
            let fd = new FormData();
            fd.append("file", file);
            return axios
                .post(route("dashboard.materi.image.upload"), fd)
                .then((res) => {
                    console.log(res.data);
                    return Promise.resolve(res.data);
                })
                .catch((err) => {
                    console.log(err);
                    return Promise.reject(err);
                });
        },
    }),
    Video,
    Table,
    Fullscreen,
    History,
];
const loading = ref(false);
const snackbar = ref({
    show: false,
    message: "Pesan",
    color: "success",
    duration: 1000,
    position: "center",
});
const materi = ref({
    content: "",
});
const show = ref(false);

const onCoverPicked = (e) => {
    const file = e.target.files[0];
    materi.value.cover = URL.createObjectURL(file);
    materi.value.fileCover = file;
};

const simpan = async () => {
    let fd = new FormData();
    if (materi.value.id) {
        fd.append("id", materi.value.id);
    }
    fd.append("title", materi.value.title);
    fd.append(
        "slug",
        materi.value.slug ?? materi.value.title.replace(" ", "-").toLowerCase(),
    );
    if (materi.value.fileCover) {
        fd.append("fileCover", materi.value.fileCover);
    } else {
        fd.append("cover", materi.value.cover)
    }
    fd.append("content", materi.value.content);
    fd.append("bab_id", props.selectedBab.id);

    await axios
        .post(route("dashboard.materi.store"), fd)
        .then((res) => {
            snackbar.value = {
                show: true,
                color: "success",
                message: res.data.message,
            };

            setTimeout(() => {
                emit('close')
            }, 500)
        })
        .catch((err) => {
            console.log(err);
        });
};

onMounted(() => {
    materi.value = props.selectedMateri ?? { content: "" };
});

onBeforeMount(() => {
    show.value = props.open;
});
</script>


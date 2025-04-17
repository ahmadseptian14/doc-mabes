<template>
    <div>
        <AppLayout>

            <Head :title="`Detail Folder - ${folder.name}`" />

            <div class="d-flex justify-content-between align-items-center pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#createFolderModal">
                    Buat Folder
                </button>
            </div>

            <div class="container py-4">
                <div class="card">
                    <div class="card-body">
                        <p><strong>Nama Folder:</strong> {{ folder.name }}</p>
                        <p>
                            <strong>Dibuat oleh:</strong>
                            {{ folder.user?.name ?? "Tidak diketahui" }}
                        </p>
                        <p>
                            <strong>Tanggal Dibuat:</strong>
                            {{ formatDate(folder.created_at) }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4" v-for="children in childrens" :key="children.id">
                        <Link :href="`/document/${children.full_path}`">
                        <div class="card card-secondary">
                            <div class="card-body skew-shadow d-flex gap-3">
                                <i class="fas fa-folder fa-3x"></i>
                                <h5 class="mt-2">{{ children.name }}</h5>
                            </div>
                        </div>
                        </Link>
                    </div>
                </div>
            </div>
        </AppLayout>
    </div>
    <div class="modal fade" id="createFolderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Folder</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit">
                        <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-12 col-form-label">Nama Folder</label>
                            <div class="col-md-12 p-0">
                                <input type="text" class="form-control input-full" v-model="folderName"
                                    id="inlineinput" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary" @click="createFolder">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, router, Link } from "@inertiajs/vue3"
import AppLayout from "@/Layouts/AppLayout.vue"
import { ref } from "vue"
import dayjs from "dayjs"
import { useToast } from "vue-toastification"
import { route } from 'ziggy-js'

const props = defineProps({
    folder: Object,
    childrens: Object
})

const formatDate = (date) => {
    return dayjs(date).format("DD MMMM YYYY HH:mm")
}

const folderName = ref('')
const toast = useToast()

const createFolder = () => {
    if (!folderName.value) {
        toast.error("Nama folder tidak boleh kosong")
        return
    }

    router.post(route('folder.store'), {
        name: folderName.value,
        parent_id: props.folder?.id ?? null
    }, {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Berhasil Membuat Folder Baru")
            folderName.value = ''
            const modal = bootstrap.Modal.getInstance(document.getElementById('createFolderModal'))
            modal.hide()
        },
        onError: (errors) => {
            if (errors.name) {
                toast.error(errors.name)
            } else {
                toast.error("Gagal membuat folder baru")
            }
        }
    })
}
</script>

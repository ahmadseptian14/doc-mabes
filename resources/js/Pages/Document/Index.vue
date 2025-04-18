<template>
    <div>
        <AppLayout>

            <Head title="Dashboard" />

            <div class="d-flex justify-content-between align-items-center pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createFolderModal">
                        Buat Folder
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#uploadFileModal">
                        Upload File
                    </button>
                </div>
            </div>

            <!-- Folder Section -->
            <div class="row mb-4" v-if="folders.length > 0">
                <div class="col-12 mb-2">
                    <h5 class="fw-bold">📁 Folder</h5>
                </div>
                <div class="col-md-4 mb-3" v-for="folder in folders" :key="folder.id">
                    <Link :href="`/document/${folder.full_path}`">
                    <div class="card card-secondary">
                        <div class="card-body skew-shadow d-flex gap-3 align-items-center">
                            <i class="fas fa-folder fa-3x text-warning"></i>
                            <h5 class="mt-2">{{ folder.name }}</h5>
                        </div>
                    </div>
                    </Link>
                </div>
            </div>

            <!-- File Section -->
            <div class="row" v-if="files.length > 0">
                <div class="col-12 mb-2">
                    <h5 class="fw-bold">📄 Files</h5>
                </div>
                <div class="col-md-4 mb-3" v-for="file in files" :key="file.id">
                    <a :href="`/storage/${file.path}`" target="_blank">
                        <div class="card card-info">
                            <div class="card-body d-flex gap-3 align-items-center">
                                <i class="fas fa-file-alt fa-3x text-primary"></i>
                                <h6 class="mb-0 truncate-text" style="max-width: 200px" :title="file.name">{{ file.name }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Empty State -->
            <div class="row" v-if="folders.length === 0 && files.length === 0">
                <div class="col-12 text-center text-muted py-4">
                    Belum ada folder atau file.
                </div>
            </div>

        </AppLayout>
    </div>
    <!-- Create Folder Modal -->
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

    <!-- File Upload Modal -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit">
                        <div class="form-group form-inline">
                            <label for="inlineinput" class="col-md-12 col-form-label">Upload File</label>
                            <div class="col-md-12 p-0">
                                <input type="file" @change="handleFileUpload" accept=".pdf,.doc,.docx" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary" @click="uploadFile">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { useToast } from "vue-toastification"
import { route } from 'ziggy-js'

const props = defineProps({
    folders: {
        type: Array,
        default: () => []
    },
    files: Array,
})

const folderName = ref('')
const toast = useToast()
const form = useForm({
    file: null,
    folder_id: props.folders?.id || null,
})

const createFolder = () => {
    if (!folderName.value) {
        toast.error("Nama folder tidak boleh kosong")
        return
    }

    router.post(route('folder.store'), {
        name: folderName.value,
        parent_id: null
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

const handleFileUpload = (e) => {
    form.file = e.target.files[0]
}

const uploadFile = () => {
    if (!form.file) {
        toast.error("File tidak boleh kosong")
        return
    }
    form.post(route('file.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Berhasil Upload File")
            form.reset()
            const modal = bootstrap.Modal.getInstance(document.getElementById('uploadFileModal'))
            modal.hide()
        },
        onError: () => {
            toast.error("Gagal upload file")
        }
    })
};

</script>

<style scoped>
.truncate-text {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
}
</style>

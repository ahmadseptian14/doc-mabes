<template>
    <GuestLayout>
        <Head title="Login" />
        <div class="container-fluid">
            <div class="row no-gutter">
                <img src="/admin/img/logo-mabes.jpg" class="col-md-6 d-none d-md-flex"></img>
                <div class="col-md-6 bg-light">
                    <div class="login d-flex align-items-center py-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 col-xl-7 mx-auto">
                                    <h3 class="display-4 text-center">Login</h3>
                                    <p class="text-muted mb-4 text-center">Create a login split page using Bootstrap 4.
                                    </p>
                                    <form @submit.prevent="submit">
                                        <div class="form-group mb-3">
                                            <input id="inputEmail" type="email" placeholder="Email address" required
                                                class="form-control rounded-pill border-0 shadow-sm px-4"
                                                v-model="form.email">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input id="inputPassword" type="password" placeholder="Password" required
                                                class="form-control rounded-pill border-0 shadow-sm px-4"
                                                v-model="form.password">
                                        </div>
                                        <div v-if="form.errors.email || form.errors.password" class="text-danger text-center mb-3">
                                            <p v-if="form.errors.email">{{ form.errors.email }}</p>
                                            <p v-if="form.errors.password">{{ form.errors.password }}</p>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit"
                                                class="btn btn-primary text-uppercase rounded-pill shadow-sm px-4"
                                                :disabled="form.processing">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { route } from 'ziggy-js'; // Perbaikan impor
import { useToast } from "vue-toastification";


const form = useForm({
    email: '',
    password: ''
})
const toast = useToast();

const submit = async () => {
    await form.post(route('login'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Berhasil Login");
        },
        onError: () => {
            toast.error("Gagal Login");
            form.reset('password');

        },
    });
};
</script>

<style scoped>
.login,
.image {
    min-height: 100vh;
}

.bg-image {
    background-size: cover;
    background-position: center center;
}
</style>

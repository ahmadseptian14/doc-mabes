<template>
    <AppLayout>
      <Head :title="`Detail Folder - ${folder.name}`" />

      <div class="container py-4">
        <h2 class="fw-bold mb-3">Detail Folder</h2>
        <div class="card">
          <div class="card-body">
            <p><strong>Nama Folder:</strong> {{ folder.name }}</p>
            <p><strong>Dibuat oleh:</strong> {{ folder.user?.name ?? 'Tidak diketahui' }}</p>
            <p><strong>Tanggal Dibuat:</strong> {{ formatDate(folder.created_at) }}</p>
          </div>
        </div>
      </div>
    </AppLayout>
  </template>

  <script setup>
  import { Head } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue'
  import { defineProps } from 'vue'
  import dayjs from 'dayjs'

  const props = defineProps({
    folder: Object
  })

  const formatDate = (date) => {
    return dayjs(date).format('DD MMMM YYYY HH:mm')
  }
  </script>

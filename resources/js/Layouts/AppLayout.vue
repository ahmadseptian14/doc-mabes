<template>
    <div>
        <div class="wrapper">
            <!-- Sidebar -->
            <Sidebar />
            <!-- End Sidebar -->
            <div class="main-panel">
                <Navbar />
                <div class="container">
                    <div class="page-inner">
                      <slot />
                    </div>
                </div>
                <Footer/>
            </div>
        </div>
    </div>
</template>
<script setup>
import Sidebar from "@/Components/Sidebar.vue";
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
</script>

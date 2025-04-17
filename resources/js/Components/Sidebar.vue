<template>
    <div>
        <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
            <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                    <img src="/admin/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                        height="20" />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item active">
                        <Link :href="route('index')" class="block py-2 px-4 hover:bg-gray-700 font-bold"><i class="fas fa-home"></i>Dashbaord</Link>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Document</h4>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('document.index')">
                            <i class="fas fa-layer-group"></i>
                            My Document
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
</script>

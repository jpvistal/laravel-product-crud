<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingSideBar = ref(false);
const widthToggle = ref('w-10');

const toggleSideBar = () => {
    showingSideBar.value = !showingSideBar.value;

    if (showingSideBar.value) {
        widthToggle.value = 'w-1/5';
    } else {
        widthToggle.value = 'w-10';
    }
}

</script>

<template>
    <div class="flex">
        <div class="sidebartop-0 bottom-0 lg:left-0 p-2  overflow-y-auto text-center bg-gray-900" :class="widthToggle">
            <div class="text-gray-100 text-xl">
                <div class="p-2.5 mt-1 flex items-center">
                    <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i>

                </div>
                <div class="p-2.5 mt-1 flex items-center">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                        class="text-[15px] ml-4 text-gray-200 font-bold">
                        Dashboard
                    </NavLink>
                </div>
                <div class="p-2.5 mt-1 flex items-center">
                    <NavLink :href="route('products.index')" :active="route().current('products.index')"
                        class="text-[15px] ml-4 text-gray-200 font-bold">
                        Products
                    </NavLink>
                </div>
                <div class="p-2.5 mt-1 flex items-center">
                    <NavLink :href="route('products.create')" :active="route().current('products.create')"
                        class="text-[15px] ml-4 text-gray-200 font-bold">
                        Create a Product
                    </NavLink>
                </div>
            </div>
        </div>
        <div class="w-full">
            <Head :title="title" />
            <Banner />
            <div class="min-h-screen bg-gray-100">
                <nav class="bg-white border-b border-gray-100">
                    <div class="">
                        <div class="flex justify-between h-16">
                            <div class="flex items-center">
                                <div class="flex items-center px-2">
                                    <i class="pi pi-bars" style="font-size: 1.5rem" @click="toggleSideBar"></i>
                                </div>

                                <!-- Navigation Links -->
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                        Dashboard
                                    </NavLink>
                                </div>

                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <NavLink :href="route('products.index')" :active="route().current('products.index')">
                                        Products
                                    </NavLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Page Heading -->
                <header v-if="$slots.header" class="bg-white shadow">
                    <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </div>

    </div>

</template>

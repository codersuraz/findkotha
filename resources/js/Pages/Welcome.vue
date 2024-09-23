<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Listing from '@/Components/Listing.vue';
import Header from '@/Layouts/Header.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const listings = [1,2,3,4,5,6,9,7,8,4,5,4,2,1,54];

</script>

<template>
    <Head title="Welcome" />
    
    <Header />

    <!-- Filter header -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center space-x-4 overflow-x-auto">
                <button class="px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-100 rounded-full focus:outline-none">
                    Price
                </button>
                <button class="px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-100 rounded-full focus:outline-none">
                    Type of place
                </button>
                <button class="px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-100 rounded-full focus:outline-none">
                    Instant Book
                </button>
                <button class="px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-100 rounded-full focus:outline-none">
                    More filters
                </button>
            </div>
        </div>
    </div>

    <!-- Listings grid -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Listing card (repeat this for each listing) -->
            <Listing v-for="item in listings"/>
            <!-- Repeat the above card structure for more listings -->
        </div>
    </main>
</template>

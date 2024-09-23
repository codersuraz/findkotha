<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '@/Layouts/Header.vue';
// Assume we receive the listing data as a prop
const props = defineProps({
    listing: {
        type: Object,
        required: true,
    },
});

// Mock data for the example (replace with actual data from your backend)
const listing = {
    title: "Charming Cottage with Ocean View",
    location: "Malibu, California",
    rating: 4.9,
    reviews: 128,
    host: {
        name: "John Doe",
        image: "https://via.placeholder.com/64",
    },
    images: [
        "https://via.placeholder.com/800x600",
        "https://via.placeholder.com/800x600",
        "https://via.placeholder.com/800x600",
        "https://via.placeholder.com/800x600",
        "https://via.placeholder.com/800x600",
    ],
    price: 250,
    description: "Enjoy breathtaking ocean views from this cozy cottage. Perfect for a romantic getaway or a small family vacation.",
    amenities: ["Wifi", "Kitchen", "Free parking", "Air conditioning", "Washer"],
    bedrooms: 2,
    beds: 3,
    bathrooms: 2,
    maxGuests: 4,
};
</script>

<template>
    <Head :title="listing.title" />

    <Header />

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ listing.title }}</h1>
        <div class="flex items-center justify-between mb-6">
            <div>
                <span class="text-sm font-semibold">★ {{ listing.rating }}</span>
                <span class="text-sm text-gray-500"> ({{ listing.reviews }} reviews)</span>
                <span class="text-sm text-gray-500"> · </span>
                <span class="text-sm font-semibold">{{ listing.location }}</span>
            </div>
            <button class="text-sm font-semibold text-red-500 hover:underline">Share</button>
        </div>

        <!-- Image gallery -->
        <div class="grid grid-cols-4 gap-2 mb-8">
            <img v-for="(image, index) in listing.images.slice(0, 5)" :key="index"
                 :src="image" :alt="'Listing image ' + (index + 1)"
                 class="w-full h-64 object-cover rounded-lg"
                 :class="{ 'col-span-2 row-span-2': index === 0 }">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-semibold">Hosted by {{ listing.host.name }}</h2>
                        <p class="text-gray-500">
                            {{ listing.maxGuests }} guests · {{ listing.bedrooms }} bedrooms · 
                            {{ listing.beds }} beds · {{ listing.bathrooms }} bathrooms
                        </p>
                    </div>
                    <img :src="listing.host.image" :alt="listing.host.name" class="w-16 h-16 rounded-full">
                </div>

                <hr class="my-6">

                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-2">Description</h3>
                    <p class="text-gray-700">{{ listing.description }}</p>
                </div>

                <hr class="my-6">

                <div>
                    <h3 class="text-xl font-semibold mb-2">Amenities</h3>
                    <ul class="grid grid-cols-2 gap-2">
                        <li v-for="amenity in listing.amenities" :key="amenity" class="flex items-center">
                            <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ amenity }}
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <div class="bg-white border rounded-lg p-6 shadow-lg sticky top-8">
                    <h3 class="text-2xl font-semibold mb-4">${{ listing.price }} <span class="text-base font-normal">/ night</span></h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                        <input type="date" class="w-full border rounded-md px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                        <input type="date" class="w-full border rounded-md px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
                        <select class="w-full border rounded-md px-3 py-2">
                            <option>1 guest</option>
                            <option>2 guests</option>
                            <option>3 guests</option>
                            <option>4 guests</option>
                        </select>
                    </div>
                    <button class="w-full bg-red-500 text-white py-3 rounded-lg font-semibold hover:bg-red-600 transition duration-200">
                        Reserve
                    </button>
                </div>
            </div>
        </div>
    </main>
</template>
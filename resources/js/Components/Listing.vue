<script setup>
import { Link } from '@inertiajs/vue3';


</script>

<template>
    <div class="relative bg-white rounded-lg shadow-md overflow-hidden">
        <img
            src="https://via.placeholder.com/300x200"
            alt="Listing image"
            class="w-full h-48 object-cover"
        >
        <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-800">Cozy Apartment in City Center</h3>
            <p class="text-sm text-gray-600 mt-1">2 guests · 1 bedroom · 1 bed · 1 bath</p>
            <div class="flex items-center mt-2">
                <svg
                    class="h-4 w-4 text-red-500"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                    />
                </svg>
                <span class="text-sm text-gray-600 ml-1">4.95 (120 reviews)</span>
            </div>
            <p class="text-sm font-semibold text-gray-800 mt-2">$100 / night</p>
        </div>

        <Link href="/listing/234234234" class="absolute inset-0"></Link>
    </div>
</template>
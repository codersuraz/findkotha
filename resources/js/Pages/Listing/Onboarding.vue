<script setup>
    import ListingLayout from '@/Layouts/ListingLayout.vue';
    import { router } from '@inertiajs/vue3';

    const createDraftListing = () => {
        router.get(route('listing.create.draft'));
    }
</script>
<template>
    <ListingLayout>
        <div class="md:max-w-[1200px] h-full mx-auto flex items-center gap-6 relative ">
            <div class="flex-1">
                <h2 class="text-5xl font-bold leading-tight text-gray-800">It's easy to list your House, Flat or Room on
                    findkotha</h2>
            </div>
            <div class="flex-1">
                <ul class="flex flex-col divide-y divide-gray-200  text-gray-700">
                    <li class="flex flex-row items-start gap-4 py-8">
                        <span class="text-primary-500 text-2xl font-bold leading-tight mt-1">1</span>
                        <span class="flex-1">
                            <h3 class="text-2xl font-bold leading-normal text-gray-700 mb-2">Tell us about your place
                            </h3>
                            <p class="text-lg text-gray-500 leading-snug">Share some basic info type what type of place
                                you have, where it's located, and what's monthly rent.</p>
                        </span>
                        <span>
                            <img
                                class="w-full max-w-[150px] mx-auto"
                                src="/home.png"
                                alt="illustration"
                            >
                        </span>
                    </li>
                    <li class="flex flex-row items-start gap-4 py-8">
                        <span class="text-primary-500 text-2xl font-bold leading-tight mt-1">2</span>
                        <span class="flex-1">
                            <h3 class="text-2xl font-bold leading-tight text-gray-700 mb-2">What services and amenities
                                do you offer?</h3>
                            <p class="text-lg text-gray-500 leading-snug">Highlight the unique features and amenities
                                that make your place stand out.</p>

                        </span>
                        <span>
                            <img
                                class="w-full max-w-[150px] mx-auto"
                                src="/home_loc.png"
                                alt="illustration"
                            >
                        </span>
                    </li>
                    <li class="flex flex-row items-start gap-4 py-8">
                        <span class="text-primary-500 text-2xl font-bold leading-tight mt-1">3</span>
                        <span class="flex-1">
                            <h3 class="text-2xl font-bold leading-normal text-gray-700 mb-2">Show it off.</h3>
                            <p class="text-lg text-gray-500 leading-snug">A picture is worth a thousand words. Upload
                                some photos and add a description to make your listing shine.</p>
                        </span>
                        <span>
                            <img
                                class="w-full max-w-[150px] mx-auto"
                                src="/house-show.png"
                                alt="illustration"
                            >
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <template #footer>
            <div
                class="absolute top-0 left-0 w-full progress-bar flex flex-row items-center justify-start bg-gray-200 h-1">
            </div>
            <button
                @click="createDraftListing"
                class="px-10 py-4 font-medium bg-gradient-to-tr from-primary-500 to-primary-600 text-white rounded-lg active:scale-95 transition duration-100 ease-in-out"
            >Get Started</button>
        </template>
    </ListingLayout>
</template>
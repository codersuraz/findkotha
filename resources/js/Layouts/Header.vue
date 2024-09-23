<script setup>
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="bg-white shadow-sm py-4 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <Link href="/">
                    <ApplicationLogo class="w-32 text-[#e83d5f]" />
                    </Link>
                </div>

                <!-- Search bar -->
                <div class="flex-1 max-w-lg mx-4">
                    <div class="relative">
                        <input
                            type="text"
                            class="w-full border border-gray-300 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            placeholder="Start your search"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg
                                class="h-5 w-5 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex items-center space-x-4">
                    <a
                        href="#"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900"
                    >List your Room</a>
                    <button
                        href="#"
                        class="inline-grid place-items-center text-sm font-medium text-gray-700 w-10 h-10 rounded-full transition duration-100 hover:text-gray-900 hover:bg-gray-100"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"
                            />
                        </svg>

                    </button>
                    <div
                        class="relative"
                        v-if="$page.props.auth?.user"
                    >
                        <button
                            class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:text-gray-900"
                        >
                            <span class="sr-only">Open user menu</span>
                            <img
                                class="h-8 w-8 rounded-full"
                                src="https://via.placeholder.com/32"
                                alt="User avatar"
                            >
                        </button>
                    </div>
                    <div class="relative flex items-center gap-4">
                        <button
                            class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:text-gray-900"
                        >
                            <span class="sr-only">Open signup menu</span>
                            <Link
                                href="/register"
                                class="text-sm font-medium text-gray-700 hover:text-gray-900"
                            >Signup</Link>
                        </button>
                        <button
                            class="flex items-center text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:bg-red-600 rounded-full px-4 py-2"
                        >
                            <span class="sr-only">Open login menu</span>
                            <Link
                                href="/login"
                                class="text-sm font-medium text-white"
                            >Login</Link>
                        </button>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>
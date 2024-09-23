<script setup>
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import Globe from '@/Icons/Globe.vue';
    import NepalFlag from '@/Icons/NepalFlag.vue';
    import UsFlag from '@/Icons/UsFlag.vue';
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
                <nav class="flex items-center space-x-1">
                    <a
                        href="#"
                        class="inline-flex items-center px-4 py-3 h-10 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-full"
                    >List your Room</a>

                    <!-- Language Switcher -->
                    <Dropdown>
                        <template #trigger>
                            <button
                                class="inline-grid place-items-center text-sm font-medium text-gray-700 w-10 h-10 rounded-full transition duration-100 hover:text-gray-900 hover:bg-gray-100"
                            >
                                <Globe />
                            </button>
                        </template>
                        <template #content>
                            <div class="py-1">
                                <a
                                    href="#"
                                    class="flex items-center gap-0.5 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    <NepalFlag class="w-5"/>
                                    नेपाली
                                </a>
                                <a
                                    href="#"
                                    class="flex items-center gap-1 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    <UsFlag class="w-4"/>
                                    English
                                </a>
                            </div>
                        </template>
                    </Dropdown>

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
                    <div class="relative flex items-center gap-1">
                        <button
                            class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:text-gray-900"
                        >
                            <span class="sr-only">Open signup menu</span>
                            <Link
                                href="/register"
                                class="text-sm font-medium text-gray-700 hover:text-gray-900 inline-flex items-center px-4 py-3 h-10 hover:bg-gray-100 rounded-full"
                            >
                            Signup</Link>
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
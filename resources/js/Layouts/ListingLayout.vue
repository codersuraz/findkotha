<script setup>
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import ArrowLeft from '@/Icons/ArrowLeft.vue';
    import { router, useForm } from '@inertiajs/vue3';
    import AuthModal from '@/Layouts/AuthModal.vue';
    import { ref } from 'vue';

    const showModal = ref(false);
    const modalType = ref('');

    const exit = () => {
        // ask user if they want to discard the listing
        if (confirm('Are you sure you want to discard the listing?')) {
            router.visit('/');
        }
    };
</script>

<template>
    <div class="flex flex-col h-screen">
        <header class="flex items-center justify-between flex-row-reverse md:flex-row px-10 pt-4">
            <ApplicationLogo class="text-primary-500 w-32" />
            <SecondaryButton
                @click="exit"
                class="rounded-md"
            >
                <ArrowLeft class="size-4 " />
                Exit
            </SecondaryButton>
        </header>

        <div class="main-content flex-1 h-full overflow-y-auto">
            <slot />
        </div>

        <footer class="relative action-bar flex flex-row items-center justify-end gap-4 px-10 py-4">
            <slot name="footer" />

            
        </footer>
    </div>
    <AuthModal v-model="showModal" v-model:type="modalType" />
</template>
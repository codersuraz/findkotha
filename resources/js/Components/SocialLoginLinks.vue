<script setup>
import GoogleIcon from '@/Icons/GoogleIcon.vue';
import FacebookIcon from '@/Icons/FacebookIcon.vue';

const props = defineProps({
    dividerOrder: {
        type: String,
        default: 'top',
    },
});

</script>
<template>
    <div v-if="dividerOrder === 'top'" class="relative flex items-center justify-center my-6">
        <span class="flex-1 border-b border-gray-300" />
        <span class="px-2 text-sm text-gray-500">or</span>
        <span class="flex-1 border-b border-gray-300" />
    </div>

    <div class="flex space-x-4 " :class="dividerOrder === 'top' ? 'mb-6' : 'mt-6'">
        <a :href="route('auth.google')"
            class="flex-1 flex items-center justify-center gap-2 py-2 px-4 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition">
            <GoogleIcon />
            Log in with Google
        </a>
        <a :href="route('auth.facebook')"
            class="flex-1 flex items-center justify-center gap-2 py-2 px-4 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition">
            <FacebookIcon />
            Log in with Facebook
        </a>
    </div>

    <div v-if="dividerOrder === 'bottom'" class="relative flex items-center justify-center my-6">
        <span class="flex-1 border-b border-gray-300" />
        <span class="px-2 text-sm text-gray-500">or</span>
        <span class="flex-1 border-b border-gray-300" />
    </div>
</template>
<script setup>
    import { ref } from 'vue';
    import { Link, useForm } from '@inertiajs/vue3';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import Checkbox from '@/Components/Checkbox.vue';
    import SocialLoginLinks from '@/Components/SocialLoginLinks.vue';

    const emit = defineEmits(['switchModal', 'closeModal']);

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const handleLogin = () => {
        form.post('/login', {
            onSuccess: () => emit('closeModal'),
            onFinish: () => form.reset('password'),
        });
    };

    const gotoRegister = () => {
        emit('switchModal', 'register');
    }

    const closeModal = () => {
        emit('closeModal');
    }

</script>

<style scoped>
    /* Add any additional styles here */
</style>

<template>
    <div class="p-6 max-w-full mx-auto bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-4">Login</h2>
        <button @click="closeModal" class="absolute top-0 right-0 px-3 py-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <form @submit.prevent="handleLogin">
            <div class="mb-4">
                <InputLabel
                    for="email"
                    value="Email"
                />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.email"
                />
            </div>
            <div class="mb-4">
                <div class="flex items-center justify-between">
                    <InputLabel
                        for="password"
                        value="Password"
                    />
                    <Link
                        :href="route('password.request')"
                        class=" text-sm text-red-500 hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                    Forgot your password?
                    </Link>
                </div>

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password"
                />
            </div>

            <div class="block mb-4">
                <label class="flex items-center">
                    <Checkbox
                        name="remember"
                        v-model:checked="form.remember"
                    />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            
            <button
                type="submit"
                class="w-full py-2 px-4 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:bg-red-600"
            >
                Login
            </button>
        </form>

        <p class="flex items-center gap-2 text-sm mt-4">
            Don't have an account?<button @click="gotoRegister" class="font-medium text-red-500">Register</button>
        </p>

        <SocialLoginLinks />
        
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import SocialLoginLinks from '@/Components/SocialLoginLinks.vue';
    import EyeIcon from '@/Icons/EyeIcon.vue';
    import EyeSlashIcon from '@/Icons/EyeSlashIcon.vue';

    const emit = defineEmits(['switchModal', 'closeModal']);

    const showPassword = ref(false);

    const form = useForm({
        name: '',
        email: '',
        password: '',
    });

    const handleRegister = () => {
        form.post('/register', {
            onSuccess: () => emit('closeModal'),
            onFinish: () => form.reset('password'),
        });
    }

    const togglePasswordVisibility = () => {
        showPassword.value = !showPassword.value;
    }

    const gotoLogin = () => {
        emit('switchModal', 'login');
    }

    const closeModal = () => {
        emit('closeModal');
    }
</script>
<template>
    <div class="p-6 max-w-full mx-auto bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-4">Register</h2>

        <button
            @click="closeModal"
            class="absolute top-0 right-0 px-3 py-3"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18 18 6M6 6l12 12"
                />
            </svg>
        </button>


        <form @submit.prevent="handleRegister">
            <div class="mb-4">
                <InputLabel
                    for="name"
                    value="Name"
                />

                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    required
                    class="mt-1 block w-full"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.name"
                />
            </div>

            <div class="mb-4">
                <InputLabel
                    for="email"
                    value="Email"
                />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    class="mt-1 block w-full"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.email"
                />
            </div>

            <div class="mb-4 relative">
                <InputLabel
                    for="password"
                    value="Password"
                />

                <TextInput
                    id="password"
                    :type="showPassword ? 'text' : 'password'"
                    v-model="form.password"
                    required
                    class="mt-1 block w-full pr-10"
                />

                <button
                    type="button"
                    @click="togglePasswordVisibility"
                    class="absolute bottom-0 right-0 px-3 py-2.5"
                >
                    <EyeIcon v-if="!showPassword" />
                    <EyeSlashIcon v-else />

                </button>

                <InputError
                    class="mt-2"
                    :message="form.errors.password"
                />
            </div>

            <div class="flex justify-center">
                <button
                    type="submit"
                    class="w-full py-2 px-4 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:bg-red-600"
                >
                    Register
                </button>
            </div>
        </form>

        <p class="flex items-center gap-2 text-sm mt-4">
            Already have an account?<button
                @click="gotoLogin"
                class="font-medium text-red-500"
            >Login</button>
        </p>


        <SocialLoginLinks />
    </div>
</template>
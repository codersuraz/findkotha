<script setup>  
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ArrowLeft from '@/Icons/ArrowLeft.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';
import Onboarding from './Onboarding.vue';

const form = useForm({
    title: '',
    description: '',
    price: '',
    location: '',
    status: '',
});

const step = ref(0);

const submit = () => {
    form.post('/listings');
};

const back = () => {
    // ask user if they want to discard the listing
    if (confirm('Are you sure you want to discard the listing?')) {
        router.visit('/listings');
    }
};

const beforeUnload = (event) => {
    if (form.isDirty) {
        event.preventDefault();
        event.returnValue = true;
    }
};

onMounted(() => {
    window.addEventListener('beforeunload', beforeUnload);
});

onUnmounted(() => {
    window.removeEventListener('beforeunload', beforeUnload);
});
</script>

<template>
    <div class="flex flex-col h-screen">
        <header class="flex items-center justify-between flex-row-reverse md:flex-row px-10 pt-4">
            <ApplicationLogo class="text-primary-500 w-32"/>
            <button @click="back" class="inline-flex items-center gap-1 px-4 py-2 font-medium text-gray-800 active:scale-95 transition duration-100 ease-in-out border border-gray-300 rounded-lg">
                <ArrowLeft class="size-4 " />
                Back
            </button>
        </header>

        <div class="main-content flex-1 h-full ">

            <!-- Onboarding -->
            <Onboarding v-if="step === 0" />


        </div>

        

        <footer class="action-bar flex flex-row items-center justify-end gap-4 px-10 py-4">
            <button v-if="step === 0" @click="step++" class="px-10 py-4 font-medium bg-gradient-to-tr from-primary-500 to-primary-600 text-white rounded-lg active:scale-95 transition duration-100 ease-in-out">Get Started</button>

            <div v-if="step === 1" class="flex-1 flex flex-row items-center justify-between gap-4">
                <button @click="step--" class="inline-flex items-center gap-1 px-10 py-4 font-medium text-gray-800 rounded-lg active:scale-95 transition duration-100 ease-in-out">
                    <ArrowLeft class="size-4 " />
                    Back
                </button>
                <button v-if="step === 0" @click="step++" class="btn btn-primary px-10 py-4 bg-gradient-to-tr from-primary-500 to-primary-600 text-primary-50 rounded-lg active:scale-95 transition duration-100 ease-in-out">Next</button>
            </div>
            
        </footer>

        

        <!-- 1. Tell us about your place -->
        <!-- <div>
            <h2>Tell us about your place</h2>
            <p>Share some basic information about your place to help guests understand what you have to offer.</p>
        </div> -->

        <!-- 2. What makes your place special? -->
        <!-- <div>
            <h2>What makes your place special?</h2>
            <p>Highlight the unique features and amenities that make your place stand out.</p>
        </div> -->

        <!-- 3. Show it off. -->
        <!-- <div>
            <h2>Show it off.</h2>
            <p>Add photos and videos to showcase your place.</p>
        </div> -->

        <!-- 4. Successfully created listing -->
        <!-- <div>
            <h2>Successfully created listing</h2>
            <p>Your listing has been created successfully. You can now view it on the listing page.</p>
        </div> -->
        

        
    </div>
</template>
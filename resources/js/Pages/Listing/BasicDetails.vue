<script setup>
    import InputError from '@/Components/InputError.vue';
    import ListingLayout from '@/Layouts/ListingLayout.vue';
    import { useForm } from '@inertiajs/vue3';
    import { computed, onMounted, ref } from 'vue';
    import L from 'leaflet';
    import 'leaflet/dist/leaflet.css';

    const form = useForm({
        title: '',
        location: '',
        city: '',
        state: '',
        latitude: '',
        longitude: '',
        nearest_landmark: '',
        rent_amount: '',
        rent_payment_period: '',
        is_rent_negotiable: false,
        require_deposit: false,
        deposit_amount: '',
        property_type: '',
    });

    const map = ref(null);
    const marker = ref(null);

    onMounted(() => {
        if(activeStep.value == 'location'){
            initMap();
            initAutocomplete();
        }
    });

    const activeStep = ref('property_type');

    const steps = ref({
        property_type: {
            title: 'What type of place are you offering?',
            description: 'Select the type of property you are offering.',
            options: [
                { value: 'room', label: 'Room', description: 'A room in a shared property.' },
                { value: 'flat', label: 'Flat', description: 'A flat in a residential building.' },
                { value: 'house', label: 'House', description: 'A standalone house.' },
            ],
            done: false,
        },

        rent: {
            title: 'Setup Rent Options',
            description: 'Set the rent options for your property.',

            rent_payment_period: {
                title: 'Payment Period',
                description: 'Set the rental payment period for your property.',
                options: [
                    { value: 'monthly', label: 'Monthly', description: 'Rent is paid monthly.' },
                    { value: 'weekly', label: 'Weekly', description: 'Rent is paid weekly.' },
                ],
            },

            is_rent_negotiable: {
                title: 'Rent Negotiable?',
                description: 'Set the rent for your property.',
                options: [
                    { value: true, label: 'Yes', description: 'Rent is negotiable.' },
                    { value: false, label: 'No', description: 'Rent is not negotiable.' },
                ],
            },

            rent_amount: {
                title: 'Rent Amount',
                description: 'Set the rental amount for your property.',
            },

            done: false,
        },
        deposit: {
            title: 'Tenants need to pay a deposit?',
            description: 'Set the deposit for your property.',
            options: [
                { value: true, label: 'Yes', description: 'Deposit is required.' },
                { value: false, label: 'No', description: 'Deposit is not required.' },
            ],
            if_required: {
                title: 'Deposit Amount',
                description: 'Set the deposit amount for your property.',
            },
            done: false,
        },
        location: {
            title: 'Where is your property located?',
            description: 'Set the location for your property.',
            done: false,
        },
        city: {
            title: 'City',
            description: 'Set the city for your property.',
            done: false,
        },
        state: {
            title: 'State',
            description: 'Set the state for your property.',
            done: false,
        },
    });

    const nextStep = () => {
        switch (activeStep.value) {
            case 'property_type':
                steps.value.property_type.done = true;
                activeStep.value = 'rent';
                break;
            case 'rent':
                steps.value.rent.done = true;
                activeStep.value = 'deposit';
                break;
            case 'deposit':
                steps.value.deposit.done = true;
                activeStep.value = 'location';
                break;
            case 'location':
                steps.value.location.done = true;
                activeStep.value = 'city';
                break;
            case 'city':
                steps.value.city.done = true;
                activeStep.value = 'state';
                break;

        }
    };

    const backStep = () => {
        switch (activeStep.value) {
            case 'rent':
                activeStep.value = 'property_type';
                break;
            case 'deposit':
                activeStep.value = 'rent';
                break;
            case 'location':
                activeStep.value = 'deposit';
                break;
        }
    };

    const validateDepositStep = () => {
        if (form.deposit) {
            return form.deposit_amount !== '';
        }
        return true;
    };

    const checkIfCurrentStepIsValid = computed(() => {
        switch (activeStep.value) {
            case 'property_type':
                return form.property_type !== '';
            case 'rent':
                return form.rent_amount !== '' && form.rent_payment_period !== '' && form.is_rent_negotiable !== '';
            case 'deposit':
                return validateDepositStep();
            case 'location':
                return form.location !== '';
            case 'city':
                return form.city !== '';
            case 'state':
                return form.state !== '';
        }
    });

    const initMap = () => {
        map.value = L.map('map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map.value);
    };

    const updateMarker = (lat, lng) => {
        if (marker.value) {
            marker.value.setLatLng([lat, lng]);
        } else {
            marker.value = L.marker([lat, lng]).addTo(map.value);
        }
        map.value.setView([lat, lng], 15);
    };

    const initAutocomplete = () => {
        const autocomplete = new Microsoft.Maps.AutosuggestManager({ credentials: 'YOUR_BING_MAPS_KEY' });
        autocomplete.attachAutosuggest('#location-input', '#location-container', (suggestionResult) => {
            const result = suggestionResult.formattedSuggestion;
            form.location = result.address;
            form.city = result.city;
            form.state = result.state;
            form.latitude = result.location.latitude;
            form.longitude = result.location.longitude;
            updateMarker(form.latitude, form.longitude);
        });
    };

    const useCurrentLocation = () => {
        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition((position) => {
                const { latitude, longitude } = position.coords;
                updateMarker(latitude, longitude);
                reverseGeocode(latitude, longitude);
            });
        } else {
            alert('Geolocation is not supported by your browser');
        }
    };

    const reverseGeocode = (lat, lng) => {
        const url = `https://dev.virtualearth.net/REST/v1/Locations/${lat},${lng}?key=YOUR_BING_MAPS_KEY`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const address = data.resourceSets[0].resources[0].address;
                form.location = address.formattedAddress;
                form.city = address.locality;
                form.state = address.adminDistrict;
                form.latitude = lat;
                form.longitude = lng;
            });
    };

</script>

<template>
    <ListingLayout>

        <div class="max-w-[1200px] mx-auto h-full flex flex-col items-start justify-center">
            <div class="flex items-center w-full">
                <div class="flex-1 h-full flex flex-col items-start justify-center">
                    <h2 class="text-4xl font-bold mb-4">Tell us about your place</h2>
                    <p class="text-gray-500 text-lg">Share some basic information about your place to help tenants
                        understand what you have to offer.</p>
                </div>
                <div class="flex-1">

                    <!-- Property Type -->
                    <div v-if="activeStep === 'property_type'">
                        <h3 class="text-2xl font-bold mb-4">{{ steps.property_type.title }}</h3>

                        <div class="flex flex-col items-start justify-center gap-4">
                            <label
                                :for="option.value"
                                v-for="option in steps.property_type.options"
                                :key="option.value"
                                :class="{ ' border-gray-600': form.property_type === option.value, 'border-gray-300': form.property_type !== option.value }"
                                class="flex flex-col items-start justify-center gap-1 p-4 border-2 rounded-lg w-full cursor-pointer"
                            >
                                <input
                                    type="radio"
                                    :id="option.value"
                                    :name="option.value"
                                    :value="option.value"
                                    v-model="form.property_type"
                                    class="hidden"
                                />
                                <span class="text-lg font-medium text-gray-800">{{ option.label }}</span>
                                <span class="text-lg font-medium text-gray-500">{{ option.description }}</span>
                            </label>
                        </div>
                    </div>

                    <!-- Rent Options -->
                    <div v-if="activeStep === 'rent'">
                        <h3 class="text-2xl font-bold mb-4">{{ steps.rent.title }}</h3>

                        <!-- Rental Amount -->
                        <div class="flex flex-col items-start justify-center gap-4 mb-4">
                            <label
                                for="rent_amount"
                                class="text-xl font-bold text-gray-800"
                            >{{ steps.rent.rent_amount.title }}</label>
                            <div class="flex items-center justify-center relative w-full">
                                <span
                                    class="text-lg font-medium text-gray-800 absolute left-5 top-1/2 -translate-y-1/2">Rs</span>
                                <input
                                    type="text"
                                    id="rent_amount"
                                    v-model="form.rent_amount"
                                    class="w-full text-lg py-4 px-4 border border-gray-400 rounded-lg pl-16"
                                    placeholder="Enter rent amount"
                                />
                            </div>
                        </div>

                        <hr class="w-full border-gray-100 my-3">

                        <!-- Rental Payment period -->
                        <div>
                            <h3 class="text-xl font-bold mb-1">{{ steps.rent.rent_payment_period.title }}</h3>
                            <p class="text-lg font-medium text-gray-500 mb-4">
                                {{ steps.rent.rent_payment_period.description }}</p>

                            <!-- Rental Payment period options -->
                            <div class="flex flex-col items-start justify-center gap-4">
                                <label
                                    :for="option.value"
                                    v-for="option in steps.rent.rent_payment_period.options"
                                    :key="option.value"
                                    :class="{ ' border-gray-600': form.rent_payment_period === option.value, 'border-gray-300': form.rent_payment_period !== option.value }"
                                    class="flex flex-col items-start justify-center gap-1 px-4 py-2 border-2 rounded-lg w-full cursor-pointer"
                                >
                                    <input
                                        type="radio"
                                        :id="option.value"
                                        :name="option.value"
                                        :value="option.value"
                                        v-model="form.rent_payment_period"
                                        class="hidden"
                                    />
                                    <span class="text-lg font-medium text-gray-800">{{ option.label }}</span>
                                    <span class="text-lg font-medium text-gray-500">{{ option.description }}</span>
                                </label>
                            </div>

                            <InputError :message="form.errors.rent_payment_period" />
                        </div>

                        <hr class="w-full border-gray-100 my-3">

                        <!-- Is Rent Negotiable -->
                        <div class="flex flex-col items-start justify-center">
                            <h3 class="text-xl font-bold mb-4">{{ steps.rent.is_rent_negotiable.title }}</h3>


                            <div class="flex flex-row items-start justify-center gap-4 w-full">
                                <label
                                    :for="option.value"
                                    v-for="option in steps.rent.is_rent_negotiable.options"
                                    :key="option.value"
                                    :class="{ ' border-gray-600': form.is_rent_negotiable === option.value, 'border-gray-300': form.is_rent_negotiable !== option.value }"
                                    class="flex flex-col items-start justify-center gap-1 px-4 py-2 border-2 rounded-lg w-full cursor-pointer"
                                >
                                    <input
                                        type="radio"
                                        :id="option.value"
                                        :name="option.value"
                                        :value="option.value"
                                        v-model="form.is_rent_negotiable"
                                        class="hidden"
                                    />
                                    <span class="text-lg font-medium text-gray-800">{{ option.label }}</span>
                                    <span class="text-lg font-medium text-gray-500">{{ option.description }}</span>
                                </label>
                            </div>

                            <InputError :message="form.errors.is_rent_negotiable" />

                        </div>

                    </div>

                    <!-- Deposit -->
                    <div v-if="activeStep === 'deposit'">
                        <h3 class="text-2xl font-bold mb-1">{{ steps.deposit.title }}</h3>
                        <p class="text-lg font-medium text-gray-500 mb-4">{{ steps.deposit.description }}</p>
                        <div class="flex flex-col items-start justify-center gap-4">
                            <label
                                :for="option.value"
                                v-for="option in steps.deposit.options"
                                :key="option.value"
                                :class="{ ' border-gray-600': form.deposit === option.value, 'border-gray-300': form.deposit !== option.value }"
                                class="flex flex-col items-start justify-center gap-1 p-4 border-2 rounded-lg w-full cursor-pointer"
                            >
                                <input
                                    type="radio"
                                    :id="option.value"
                                    :name="option.value"
                                    :value="option.value"
                                    v-model="form.deposit"
                                    class="hidden"
                                />
                                <span class="text-lg font-medium text-gray-800">{{ option.label }}</span>
                                <span class="text-lg font-medium text-gray-500">{{ option.description }}</span>
                            </label>
                        </div>
                        <Transition
                            name="fade"
                            mode="out-in"
                            enter-active-class="opacity-1 transition-opacity duration-500"
                            leave-active-class="opacity-0 transition-opacity duration-300"
                            enter-from-class="opacity-0"
                            leave-to-class="opacity-0"
                        >
                            <div
                                v-if="form.deposit"
                                class="mt-6"
                            >
                                <h3 class="text-2xl font-bold mb-2">{{ steps.deposit.if_required.title }}</h3>
                                <div class="flex flex-col items-start justify-center">
                                    <label
                                        for="deposit_amount"
                                        class="text-lg font-medium text-gray-800"
                                    >{{ steps.deposit.if_required.label }}</label>
                                    <div class="flex items-center justify-center gap-4 relative w-full">
                                        <span
                                            class="text-lg font-medium text-gray-800 absolute left-5 top-1/2 -translate-y-1/2"
                                        >Rs</span>
                                        <input
                                            type="text"
                                            id="deposit_amount"
                                            v-model="form.deposit_amount"
                                            class="text-lg w-full py-4 px-4 border border-gray-300 rounded-lg pl-16"
                                            placeholder="Enter deposit amount"
                                        />
                                    </div>
                                    <span class="text-sm font-medium text-gray-500 mt-1 ml-1">{{
                                        steps.deposit.if_required.description }}</span>
                                </div>
                            </div>
                        </Transition>
                    </div>

                    <!-- Location -->
                    <div v-if="activeStep === 'location'">
                        <h3 class="text-2xl font-bold mb-1">{{ steps.location.title }}</h3>
                        <p class="text-lg font-medium text-gray-500 mb-4">{{ steps.location.description }}</p>

                        <!-- here we will use leaflet for map and input with bing location autocomplete and also allows user to pick their current location. -->
                        <div class="location-container">
                            <div
                                id="location-container"
                                class="relative mb-4"
                            >
                                <input
                                    type="text"
                                    id="location-input"
                                    v-model="form.location"
                                    class="text-lg w-full py-4 px-4 border border-gray-300 rounded-lg"
                                    placeholder="Enter location"
                                />
                                <button
                                    @click="useCurrentLocation"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-primary-500 text-white px-3 py-1 rounded-lg text-sm"
                                >
                                    Use Current Location
                                </button>
                            </div>

                            <div id="map" class="h-64 w-full mb-4"></div>
                            <InputError :message="form.errors.location" />
                        </div>

                    </div><!-- /location -->


                </div>
            </div>
        </div>

        <template #footer>
            <div class="flex items-center justify-between gap-4 w-full">
                <button
                    @click="backStep"
                    :disabled="activeStep === 'property_type'"
                    class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg"
                >Back</button>
                <button
                    @click="nextStep"
                    :disabled="!checkIfCurrentStepIsValid"
                    class="bg-primary-500 text-white px-4 py-2 rounded-lg disabled:bg-gray-200 disabled:text-gray-800"
                >Next</button>
            </div>
        </template>


    </ListingLayout>

</template>
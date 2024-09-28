<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Header from '@/Layouts/Header.vue';
import { useForm } from '@inertiajs/vue3';
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/default.css'

// create a single reactive variable with filter options
const filterForm = useForm({
    price: {
        min: null,
        max: null,
    },
    type: [],
    amenities: [],
});

const applyPriceFilter = () => {
    console.log('applyPriceFilter', filterForm.price);
}

</script>

<template>
    <Header />
    <div class="container mx-auto px-4 py-8">
        <div class="filter-options mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div>
                    <Dropdown width="54" align="left">
                        <template #trigger> 
                            <SecondaryButton class="rounded-full">
                                Price Range
                            </SecondaryButton>
                        </template>
                        <template #content>
                            <div  class="px-6 py-3 min-w-[400px]">
                                <div class="flex gap-2">
                                    <span>
                                        <InputLabel value="Min Price" />
                                        <input type="number" v-model="filterForm.price.min" placeholder="Set min price" class="w-full border-gray-300 rounded-md"/>
                                    </span>
                                    
                                    <span>
                                        <InputLabel value="Max Price" />
                                        <input type="number" v-model="filterForm.price.max" placeholder="Set max price" class="w-full border-gray-300 rounded-md"/>
                                    </span>
                                </div>
                                <span class="flex justify-end gap-2 mt-4">
                                    <button class="text-sm border px-4 py-2 border-gray-300 text-gray-500 hover:text-gray-700 rounded-md">Clear</button>
                                    <button @click="applyPriceFilter" class="text-sm bg-primary-500 text-white px-4 py-2 rounded-md">Apply</button>
                                </span>
                            </div>
                        </template>
                    </Dropdown>
                </div>
                <div>
                    <Dropdown width="54" align="left">
                        <template #trigger> 
                            <SecondaryButton class="rounded-full" :class="{ 'bg-primary-100 border-primary-500': filterForm.type.length > 0 }">
                                <span v-if="filterForm.type.length > 0" class="flex flex-wrap gap-0">
                                    <span v-for="(type, index) in filterForm.type" :key="type" class="text-sm text-primary-500 font-semibold">
                                        {{ type.charAt(0).toUpperCase() + type.slice(1) }}{{ index === filterForm.type.length - 2 ? ' &&nbsp' : index < filterForm.type.length - 2 ? ',&nbsp' : '' }}
                                    </span>
                                   
                                </span>
                                <span v-else>
                                    Rental Type
                                </span>
                            </SecondaryButton>
                        </template> 
                        <template #content>
                            <div class="px-2 py-2 min-w-[400px]">
                                <label for="room" class="flex items-center gap-2 mb-2 hover:bg-gray-100 p-2 rounded-md">
                                    <input type="checkbox" id="room" name="room" value="room" v-model="filterForm.type" /> Room
                                </label>
                                <label for="flat" class="flex gap-2 mb-2 hover:bg-gray-100 p-2 rounded-md">
                                    <input type="checkbox" id="flat" name="flat" value="flat" v-model="filterForm.type" /> Flat
                                </label>
                                <label for="house" class="flex gap-2 mb-2 hover:bg-gray-100 p-2 rounded-md">
                                    <input type="checkbox" id="house" name="house" value="house" v-model="filterForm.type" /> House
                                </label>
                                
                            </div>
                        </template>
                    </Dropdown>
                </div>
                <div>
                    <Dropdown width="54" align="left">
                        <template #trigger> 
                            <SecondaryButton class="rounded-full">
                                Amenities
                            </SecondaryButton>
                        </template>
                        <template #content>
                            <div class="px-6 py-2 min-w-[400px]">
                                
                            </div>
                        </template> 
                    </Dropdown>
                </div>
            </div>
        </div>
        <div class="listings">
            <h2 class="text-2xl font-bold mb-4">Listings</h2>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <!-- Mock Listing 1 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/400x200" alt="Listing 1" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Cozy Studio Apartment</h3>
                        <p class="text-gray-600 mb-2">$80 per night</p>
                        <p class="text-sm text-gray-500">Private room • 1 bed • Wi-Fi</p>
                    </div>
                </div>
                <!-- Mock Listing 2 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/400x200" alt="Listing 2" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Spacious Loft with City View</h3>
                        <p class="text-gray-600 mb-2">$120 per night</p>
                        <p class="text-sm text-gray-500">Entire place • 2 beds • Kitchen</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

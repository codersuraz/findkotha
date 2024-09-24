<script setup>  
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    price: '',
    location: '',
    status: '',
});

const submit = () => {
    form.post('/listings');
};
</script>

<template>
    <div>
        <h1>Create a new listing</h1>
        <form @submit.prevent="submit">
            <input type="text" v-model="form.title" placeholder="Title">
            <input type="text" v-model="form.description" placeholder="Description">
            <input type="number" v-model="form.price" placeholder="Price">
            <input type="text" v-model="form.location" placeholder="Location">
            <select v-model="form.status">
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>    
            </select>
            <button type="submit">Create</button>
        </form>
    </div>
</template>
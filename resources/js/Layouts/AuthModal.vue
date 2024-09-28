<script setup>
    import { router, usePage } from '@inertiajs/vue3';
    import LoginModal from '@/Pages/Auth/LoginModal.vue';
    import RegisterModal from '@/Pages/Auth/RegisterModal.vue';
    import Modal from '@/Components/Modal.vue';
    import { onMounted } from 'vue';


    const showModal = defineModel();
    const modalType = defineModel('type', {
        default: 'login',
    });

    const page = usePage();

    onMounted(() => {
        if(page.props.flash.modal?.show) {
            openModal(page.props.flash.modal.type);
        }
    });

    const openModal = (type) => {
        modalType.value = type;
        showModal.value = true;
    };

    const closeModal = () => {
        showModal.value = false;
       
    };

    router.on('invalid', (event) => {
        event.preventDefault()
        if (event.detail.response.status === 401) {
            openModal('login');
        }
    });

</script>

<template>
    <Modal
        :show="showModal"
        max-width="sm"
        :center="true"
        @close="closeModal"
    >
        <template v-if="modalType === 'login'">
            <LoginModal
                @switchModal="openModal('register')"
                @closeModal="closeModal"
            />
        </template>
        <template v-else-if="modalType === 'register'">
            <RegisterModal
                @switchModal="openModal('login')"
                @closeModal="closeModal"
            />
        </template>
    </Modal>
</template>
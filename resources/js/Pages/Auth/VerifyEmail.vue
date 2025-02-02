<script setup lang="ts">
import AuthCard from '@/Components/AuthCard.vue';
import { Button } from '@/Components/ui/button';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const title = 'Verify Email';
const description =
    'Before moving forward, could you verify your email address by clicking on the link we just emailed to you?';
const verificationLinkSent = 'A new verification link has been sent.';

const props = defineProps<{
    status?: string;
}>();

const form = useForm({});

const resend = () => {
    form.post(route('verification.send'));
};

const logout = () => {
    form.post(route('logout'));
};

const statusMessage = computed(() =>
    props.status === 'verification-link-sent'
        ? verificationLinkSent
        : props.status,
);
</script>

<template>
    <GuestLayout>
        <Head :title />

        <AuthCard :title :description :status="statusMessage">
            <form @submit.prevent="resend">
                <Button
                    :disabled="form.processing"
                    type="submit"
                    class="w-full"
                >
                    Resend Verification Email
                </Button>
            </form>
            <form @submit.prevent="logout">
                <Button
                    :disabled="form.processing"
                    variant="outline"
                    class="w-full"
                >
                    Log Out
                </Button>
            </form>
        </AuthCard>
    </GuestLayout>
</template>

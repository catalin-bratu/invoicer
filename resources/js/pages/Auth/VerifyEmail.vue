<script setup lang="ts">
import AuthCard from '@/components/AuthCard.vue';
import { Button } from '@/components/ui/button';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const title = 'Verify Email';
const description =
    'Before moving forward, could you verify your email address by clicking on the link we just emailed to you?';
const verificationLinkSent = 'A new verification link has been sent.';

const props = defineProps<{
    status?: string;
}>();

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
            <Button as-child>
                <Link :href="route('verification.send')" method="post">
                    Resend Verification Email
                </Link>
            </Button>
            <Button as-child variant="outline">
                <Link :href="route('logout')" method="post">Logout</Link>
            </Button>
        </AuthCard>
    </GuestLayout>
</template>

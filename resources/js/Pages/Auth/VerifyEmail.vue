<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

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

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <GuestLayout>
        <Head title="Verify Email" />

        <Card class="mx-auto max-w-sm">
            <CardHeader>
                <CardTitle class="text-2xl">Verify Email</CardTitle>
                <CardDescription>
                    Before moving forward, could you verify your email address
                    by clicking on the link we just emailed to you?
                </CardDescription>
                <CardDescription
                    v-if="verificationLinkSent"
                    class="text-primary"
                >
                    A new verification link has been sent.
                </CardDescription>
            </CardHeader>
            <CardContent class="grid gap-4">
                <form @submit.prevent="resend">
                    <Button
                        :disabled="form.processing"
                        type="submit"
                        class="w-full"
                        :class="{ 'opacity-25': form.processing }"
                    >
                        Resend Verification Email
                    </Button>
                </form>
                <form @submit.prevent="logout">
                    <Button
                        :disabled="form.processing"
                        variant="outline"
                        class="w-full"
                        :class="{ 'opacity-25': form.processing }"
                    >
                        Log Out
                    </Button>
                </form>
            </CardContent>
        </Card>
    </GuestLayout>
</template>

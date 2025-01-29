<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import { Button } from '@/Components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <Card class="mx-auto max-w-sm">
            <CardHeader>
                <CardTitle class="text-2xl">Forgot Password</CardTitle>
                <CardDescription>
                    No worries, we'll send you reset instructions
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input id="email" type="email" v-model="form.email" />
                        <InputError :message="form.errors.email" />
                    </div>
                    <Button
                        :disabled="form.processing"
                        type="submit"
                        class="w-full"
                        :class="{ 'opacity-25': form.processing }"
                    >
                        Reset Password
                    </Button>
                </form>
            </CardContent>
        </Card>
    </GuestLayout>
</template>

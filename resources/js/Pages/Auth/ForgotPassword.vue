<script setup lang="ts">
import AuthCard from '@/Components/AuthCard.vue';
import InputError from '@/Components/InputError.vue';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const title = 'Forgot Password';
const description = "No worries, we'll send you reset instructions";

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head :title />

        <AuthCard :title :description>
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
                    Continue
                </Button>
            </form>
        </AuthCard>
    </GuestLayout>
</template>

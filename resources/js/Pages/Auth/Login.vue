<script setup lang="ts">
import AuthCard from '@/Components/AuthCard.vue';
import InputError from '@/Components/InputError.vue';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const title = 'Login';
const description = 'Enter your email below to login to your account';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head :title />

        <AuthCard :title :description :status>
            <form @submit.prevent="submit" class="grid gap-4">
                <div class="grid gap-2">
                    <Label for="email">Email</Label>
                    <Input id="email" type="email" v-model="form.email" />
                    <InputError :message="form.errors.email" />
                </div>
                <div class="grid gap-2">
                    <div class="flex items-center">
                        <Label for="password">Password</Label>
                        <Link
                            :href="route('password.request')"
                            class="ml-auto inline-block text-sm underline"
                        >
                            Forgot your password?
                        </Link>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        v-model="form.password"
                    />
                    <InputError :message="form.errors.password" />
                </div>
                <Button
                    :disabled="form.processing"
                    type="submit"
                    class="w-full"
                >
                    Continue
                </Button>
                <Button
                    as="a"
                    :href="route('login.redirect')"
                    :disabled="form.processing"
                    variant="outline"
                    class="w-full"
                >
                    Continue with Github
                </Button>
            </form>
            <div class="text-center text-sm">
                Don't have an account?
                <Link :href="route('register')" class="underline">
                    Sign up
                </Link>
            </div>
        </AuthCard>
    </GuestLayout>
</template>

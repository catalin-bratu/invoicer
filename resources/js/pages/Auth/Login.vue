<script setup lang="ts">
import AuthCard from '@/components/AuthCard.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import GuestLayout from '@/layouts/GuestLayout.vue';
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
                        <Button
                            variant="link"
                            as-child
                            class="ml-auto leading-none"
                        >
                            <Link :href="route('password.request')">
                                Forgot your password?
                            </Link>
                        </Button>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        v-model="form.password"
                    />
                    <InputError :message="form.errors.password" />
                </div>
                <Button :disabled="form.processing" type="submit">
                    Continue
                </Button>
                <Button
                    as="a"
                    :href="route('login.redirect')"
                    variant="outline"
                >
                    Continue with Github
                </Button>
            </form>
            <div class="text-center text-sm">
                Don't have an account?
                <Button variant="link" as-child>
                    <Link :href="route('register')">Sign up</Link>
                </Button>
            </div>
        </AuthCard>
    </GuestLayout>
</template>

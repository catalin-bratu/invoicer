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
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};

const setLoadingState = () => {
    form.processing = true;
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <Card class="maw-w-sm mx-auto">
            <CardHeader>
                <CardTitle class="text-2xl">Register</CardTitle>
                <CardDescription>
                    Create a free account to get started
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input id="name" type="text" v-model="form.name" />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input id="email" type="email" v-model="form.email" />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="password">Password</Label>
                        <Input
                            id="password"
                            type="password"
                            v-model="form.password"
                            autocomplete="new-password"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="password_confirmation">
                            Confirm Password
                        </Label>
                        <Input
                            id="password_confirmation"
                            type="password"
                            v-model="form.password_confirmation"
                            autocomplete="new-password"
                        />
                        <InputError
                            :message="form.errors.password_confirmation"
                        />
                    </div>
                    <Button
                        :disabled="form.processing"
                        type="submit"
                        class="w-full"
                        :class="{ 'opacity-25': form.processing }"
                    >
                        Continue
                    </Button>
                    <Button
                        as="a"
                        :href="route('login.redirect')"
                        :disabled="form.processing"
                        variant="outline"
                        class="w-full"
                        :class="{ 'opacity-25': form.processing }"
                        @click="setLoadingState"
                    >
                        Continue with Github
                    </Button>
                </form>
                <div class="mt-4 text-center text-sm">
                    Already registered?
                    <Link :href="route('login')" class="underline">
                        Sign in
                    </Link>
                </div>
            </CardContent>
        </Card>
    </GuestLayout>
</template>

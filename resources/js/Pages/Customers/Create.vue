<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/Components/ui/breadcrumb';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    vat: '',
    email: '',
    phone: '',
    iban: '',
    bank: '',
});

const submit = () => {
    form.post(route('customers.store'));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Customers" />
        <Breadcrumb>
            <BreadcrumbList>
                <BreadcrumbItem>
                    <BreadcrumbLink as-child>
                        <Link :href="route('dashboard')">Dashboard</Link>
                    </BreadcrumbLink>
                </BreadcrumbItem>
                <BreadcrumbSeparator />
                <BreadcrumbItem>
                    <BreadcrumbLink as-child>
                        <Link :href="route('customers.index')">Customers</Link>
                    </BreadcrumbLink>
                </BreadcrumbItem>
                <BreadcrumbSeparator />
                <BreadcrumbPage>Create Customer</BreadcrumbPage>
            </BreadcrumbList>
        </Breadcrumb>
        <Card class="max-w-md">
            <CardHeader>
                <CardTitle>Create Customer</CardTitle>
            </CardHeader>
            <CardContent class="grid gap-4">
                <form @submit.prevent="submit" class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input id="name" type="text" v-model="form.name" />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="vat">VAT</Label>
                        <Input id="vat" type="text" v-model="form.vat" />
                        <InputError :message="form.errors.vat" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input id="email" type="email" v-model="form.email" />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="phone">Phone</Label>
                        <Input id="phone" type="tel" v-model="form.phone" />
                        <InputError :message="form.errors.phone" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="iban">IBAN</Label>
                        <Input id="iban" type="text" v-model="form.iban" />
                        <InputError :message="form.errors.iban" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="bank">Bank</Label>
                        <Input id="bank" type="text" v-model="form.bank" />
                        <InputError :message="form.errors.bank" />
                    </div>
                    <Button
                        :disabled="form.processing"
                        type="submit"
                        class="ml-auto w-fit"
                    >
                        Create
                    </Button>
                </form>
            </CardContent>
        </Card>
    </AuthenticatedLayout>
</template>

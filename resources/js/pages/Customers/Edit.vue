<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/components/ui/breadcrumb';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Customer } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    customer: Customer;
}>();

const form = useForm({
    name: props.customer.name,
    vat: props.customer.vat,
    email: props.customer.email,
    phone: props.customer.phone,
    iban: props.customer.iban,
    bank: props.customer.bank,
});

const submit = () => {
    form.patch(route('customers.update', { id: props.customer.id }));
};

const destroy = () => {
    if (confirm('Are you sure you want to delete this customer?')) {
        form.delete(route('customers.destroy', { id: props.customer.id }));
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="customer.name" />
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
                <BreadcrumbPage>Edit Customer</BreadcrumbPage>
            </BreadcrumbList>
        </Breadcrumb>
        <Card class="max-w-md">
            <CardHeader>
                <CardTitle class="flex items-center justify-between">
                    {{ props.customer.name }}
                    <Button
                        :disabled="form.processing"
                        variant="destructive"
                        class="w-fit"
                        @click.prevent="destroy"
                    >
                        Delete
                    </Button>
                </CardTitle>
            </CardHeader>
            <CardContent class="grid gap-4">
                <form @submit.prevent="submit" class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            type="text"
                            v-model="form.name"
                            autocomplete="off"
                        />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="vat">VAT</Label>
                        <Input
                            id="vat"
                            type="text"
                            v-model="form.vat"
                            autocomplete="off"
                        />
                        <InputError :message="form.errors.vat" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            type="email"
                            v-model="form.email"
                            autocomplete="off"
                        />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="phone">Phone</Label>
                        <Input
                            id="phone"
                            type="tel"
                            v-model="form.phone"
                            autocomplete="off"
                        />
                        <InputError :message="form.errors.phone" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="iban">IBAN</Label>
                        <Input
                            id="iban"
                            type="text"
                            v-model="form.iban"
                            autocomplete="off"
                        />
                        <InputError :message="form.errors.iban" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="bank">Bank</Label>
                        <Input
                            id="bank"
                            type="text"
                            v-model="form.bank"
                            autocomplete="off"
                        />
                        <InputError :message="form.errors.bank" />
                    </div>
                    <div class="flex justify-between">
                        <Button
                            :disabled="form.processing"
                            variant="secondary"
                            class="w-fit"
                            @click.prevent="form.reset()"
                        >
                            Discard
                        </Button>
                        <Button
                            :disabled="form.processing"
                            type="submit"
                            class="w-fit"
                        >
                            Save
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </AuthenticatedLayout>
</template>

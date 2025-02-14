<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />
        <div class="flex items-center">
            <h1 class="text-lg font-semibold md:text-2xl">Dashboard</h1>
        </div>
        <div
            class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm"
        >
            <div class="flex flex-col items-center gap-1 text-center">
                <h3 class="text-2xl font-bold tracking-tight">
                    You have no customers
                </h3>
                <p class="text-sm text-muted-foreground">
                    You can start selling as soon as you add a customer.
                </p>
                <Button class="mt-4"> Add Customer </Button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

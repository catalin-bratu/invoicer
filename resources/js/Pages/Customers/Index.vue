<script setup lang="ts">
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/Components/ui/breadcrumb';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Customer } from '@/types';
import { Link } from '@inertiajs/vue3';
import { formatDate, normalizeDate } from '@vueuse/core';

defineProps<{
    customers: Customer[];
}>();

const formatDateForDisplay = (date: string) =>
    formatDate(normalizeDate(date), 'MMM DD YYYY HH:mm');
</script>

<template>
    <AuthenticatedLayout>
        <Breadcrumb>
            <BreadcrumbList>
                <BreadcrumbItem>
                    <BreadcrumbLink as-child>
                        <Link :href="route('dashboard')">Dashboard</Link>
                    </BreadcrumbLink>
                </BreadcrumbItem>
                <BreadcrumbSeparator />
                <BreadcrumbPage>Customers</BreadcrumbPage>
            </BreadcrumbList>
        </Breadcrumb>
        <Card>
            <CardHeader>
                <CardTitle class="px-2">Customers</CardTitle>
                <CardDescription class="px-2">
                    Manage your customers.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Name</TableHead>
                            <TableHead>VAT</TableHead>
                            <TableHead>Phone</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>Created at</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow
                            v-for="customer in customers"
                            :key="customer.id"
                        >
                            <TableCell>{{ customer.name }}</TableCell>
                            <TableCell>{{ customer.vat }}</TableCell>
                            <TableCell>{{ customer.phone }}</TableCell>
                            <TableCell>{{ customer.email }}</TableCell>
                            <TableCell class="whitespace-nowrap">
                                {{ formatDateForDisplay(customer.created_at) }}
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
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

defineProps<{
    customers: Customer[];
}>();
</script>

<template>
    <AuthenticatedLayout>
        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead>Name</TableHead>
                    <TableHead>VAT</TableHead>
                    <TableHead>Phone</TableHead>
                    <TableHead>Email</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="customer in customers" :key="customer.id">
                    <TableCell>{{ customer.name }}</TableCell>
                    <TableCell>{{ customer.vat }}</TableCell>
                    <TableCell>{{ customer.phone }}</TableCell>
                    <TableCell>{{ customer.email }}</TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </AuthenticatedLayout>
</template>

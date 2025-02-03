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

const customers = [
    {
        id: 'eda06937-0330-44f2-bf69-21b32a582593',
        name: 'Stehr - Hills',
        vat: '620427636',
        phone: '868-492-0960',
        email: 'Ellsworth73@yahoo.com',
    },
    {
        id: '4a292682-3c44-4f43-99ca-dff272e16ec9',
        name: 'Paucek, Klocko and Collins',
        vat: '950022552',
        phone: '691.401.4018',
        email: 'Antonietta_Carroll12@gmail.com',
    },
    {
        id: '080408de-0769-4fe2-8513-25a21ccfe41c',
        name: 'Kozey and Sons',
        vat: '187950293',
        phone: '553-315-5727',
        email: 'Dominic69@gmail.com',
    },
    {
        id: '6873adbe-3e23-4d6e-b914-9de05e278eba',
        name: 'White, Keeling and Stoltenberg',
        vat: '142245590',
        phone: '234-934-8464',
        email: 'Aryanna_Rutherford@yahoo.com',
    },
    {
        id: 'fb7d9172-3797-4d47-9f11-a7a66b36b6f3',
        name: 'Corkery and Sons',
        vat: '773018280',
        phone: '802-280-9073',
        email: 'Clara63@gmail.com',
    },
];
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

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
import { Input } from '@/Components/ui/input';
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
import { Link, router } from '@inertiajs/vue3';
import { formatDate, normalizeDate, useDebounceFn } from '@vueuse/core';
import { isEmpty, shake } from 'radashi';
import { ref } from 'vue';

const props = defineProps<{
    customers: Customer[];
    search?: string;
}>();

const searchQuery = ref(props.search);

const throttleSearch = useDebounceFn(() => {
    router.get(
        route('customers.index'),
        shake({ search: searchQuery.value }, isEmpty),
        { preserveState: true },
    );
});

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
                <CardTitle>Customers</CardTitle>
                <CardDescription> Manage your customers. </CardDescription>
            </CardHeader>
            <CardContent class="space-y-4">
                <Input
                    v-model="searchQuery"
                    placeholder="Filter customers..."
                    class="h-8 w-[150px] lg:w-[250px]"
                    @input="throttleSearch"
                />
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

<script setup lang="ts">
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/Components/ui/breadcrumb';
import { Button } from '@/Components/ui/button';
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
import { Customer, Paginator } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { ChevronLeftIcon, ChevronRightIcon } from '@radix-icons/vue';
import { formatDate, normalizeDate, useDebounceFn } from '@vueuse/core';
import { isEmpty, shake } from 'radashi';
import { ref } from 'vue';

const props = defineProps<{
    customers: Paginator<Customer>;
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
        <Head title="Customers" />
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
                            v-for="customer in customers.data"
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
                <div class="flex items-center justify-between">
                    <Button as-child variant="outline" size="icon">
                        <Link
                            preserve-state
                            as="button"
                            :href="customers.prev_page_url ?? ''"
                            :disabled="!customers.prev_page_url"
                        >
                            <ChevronLeftIcon />
                        </Link>
                    </Button>
                    <Button as-child variant="outline" size="icon">
                        <Link
                            preserve-state
                            as="button"
                            :href="customers.next_page_url ?? ''"
                            :disabled="!customers.next_page_url"
                        >
                            <ChevronRightIcon />
                        </Link>
                    </Button>
                </div>
            </CardContent>
        </Card>
    </AuthenticatedLayout>
</template>

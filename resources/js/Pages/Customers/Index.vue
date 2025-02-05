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
import {
    ChevronLeftIcon,
    ChevronRightIcon,
    MagnifyingGlassIcon,
} from '@radix-icons/vue';
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
        <Card v-if="customers.data.length || search">
            <CardHeader>
                <CardTitle>Customers</CardTitle>
                <CardDescription> Manage your customers. </CardDescription>
            </CardHeader>
            <CardContent class="space-y-4">
                <div class="flex items-center justify-between">
                    <Button size="sm" variant="outline">Add Customer</Button>
                    <div class="relative w-56 items-center">
                        <Input
                            v-model="searchQuery"
                            type="text"
                            autocomplete="off"
                            placeholder="Filter customers..."
                            class="h-8 pl-10"
                            @input="throttleSearch"
                        />
                        <span
                            class="absolute inset-y-0 start-0 flex items-center justify-center px-2"
                        >
                            <MagnifyingGlassIcon
                                class="size-6 text-muted-foreground"
                            />
                        </span>
                    </div>
                </div>
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
                <div
                    v-if="customers.data.length"
                    class="flex items-center justify-between"
                >
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
                    <div class="text-sm font-medium">
                        Showing {{ customers.from }} to {{ customers.to }}
                    </div>
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
                <p v-else class="text-center text-sm font-medium">
                    We couldn't find any results based on your search.
                </p>
            </CardContent>
        </Card>
        <div
            v-else
            class="flex flex-1 items-center justify-center rounded-xl border-2 border-dashed bg-card text-card-foreground"
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

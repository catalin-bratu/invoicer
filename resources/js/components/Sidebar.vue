<script setup lang="ts">
import ApplicationLogo from '@/components/ApplicationLogo.vue';
import NavLink from '@/components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import { BackpackIcon, HomeIcon } from '@radix-icons/vue';
</script>

<template>
    <div class="flex h-full max-h-screen flex-col gap-3">
        <Link
            href="/"
            class="flex h-14 items-center gap-3 font-semibold md:border-b md:px-2 lg:px-4"
        >
            <ApplicationLogo class="h-6 w-12 fill-current" />
            Invoicer
        </Link>
        <div class="flex-1">
            <nav
                class="grid items-start gap-1 text-sm font-medium md:px-2 lg:px-4"
            >
                <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    <HomeIcon class="h-4 w-4" />
                    Dashboard
                </NavLink>
                <NavLink
                    :href="route('customers.index')"
                    :active="route().current('customers.index')"
                >
                    <BackpackIcon class="h-4 w-4" />
                    Customers
                </NavLink>
            </nav>
        </div>
    </div>
</template>

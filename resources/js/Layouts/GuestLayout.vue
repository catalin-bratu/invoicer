<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-background pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="h-8 w-20 fill-current" />
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden px-6 py-4 sm:max-w-md">
            <slot />
        </div>
    </div>
</template>

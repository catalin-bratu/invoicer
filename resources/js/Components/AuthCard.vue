<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card';

defineProps<{
    title?: string;
    description?: string;
    status?: string;
}>();
</script>

<template>
    <Card class="mx-auto max-w-sm">
        <CardHeader>
            <CardTitle v-if="title" class="text-2xl">{{ title }}</CardTitle>
            <CardDescription v-if="description">
                {{ description }}
            </CardDescription>
            <CardDescription v-if="status" class="text-primary">
                {{ status }}
            </CardDescription>
        </CardHeader>
        <CardContent class="grid gap-4">
            <slot />
        </CardContent>
    </Card>
</template>

<script setup lang="ts">
import Sidebar from '@/Components/Sidebar.vue';
import { Button } from '@/Components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet';
import { Link } from '@inertiajs/vue3';
import { HamburgerMenuIcon, PersonIcon } from '@radix-icons/vue';
import { onMounted, onUnmounted, ref } from 'vue';

const isMobileSidebarOpen = ref(false);
const closeMobileSidebar = () => {
    isMobileSidebarOpen.value = false;
};

onMounted(() => {
    window.addEventListener('resize', closeMobileSidebar);
});

onUnmounted(() => {
    window.removeEventListener('resize', closeMobileSidebar);
});
</script>

<template>
    <div
        class="grid h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]"
    >
        <div class="hidden border-r bg-muted/40 md:block">
            <Sidebar />
        </div>
        <div class="flex flex-col">
            <header
                class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:px-6"
            >
                <Sheet v-model:open="isMobileSidebarOpen">
                    <SheetTrigger as-child>
                        <Button
                            variant="outline"
                            size="icon"
                            class="shrink-0 md:hidden"
                        >
                            <HamburgerMenuIcon class="h-5 w-5" />
                            <span class="sr-only">Toggle navigation menu</span>
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left" class="flex flex-col">
                        <Sidebar />
                    </SheetContent>
                </Sheet>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button
                            variant="secondary"
                            size="icon"
                            class="ml-auto rounded-full"
                        >
                            <PersonIcon class="h-5 w-5" />
                            <span class="sr-only">Toggle user menu</span>
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuLabel>My Account</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <Link :href="route('profile.edit')">
                            <DropdownMenuItem>Profile</DropdownMenuItem>
                        </Link>
                        <Link
                            :href="route('logout')"
                            method="post"
                            class="w-full"
                        >
                            <DropdownMenuItem>Logout</DropdownMenuItem>
                        </Link>
                    </DropdownMenuContent>
                </DropdownMenu>
            </header>
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
                <slot />
            </main>
        </div>
    </div>
</template>

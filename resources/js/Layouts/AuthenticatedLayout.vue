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
import {
    Half2Icon,
    HamburgerMenuIcon,
    MoonIcon,
    PersonIcon,
    SunIcon,
} from '@radix-icons/vue';
import { useColorMode } from '@vueuse/core';
import { onMounted, onUnmounted, ref } from 'vue';

const isMobileSidebarOpen = ref(false);
const closeMobileSidebar = () => {
    isMobileSidebarOpen.value = false;
};

const colorMode = useColorMode({ emitAuto: true });

onMounted(() => {
    window.addEventListener('resize', closeMobileSidebar);
});

onUnmounted(() => {
    window.removeEventListener('resize', closeMobileSidebar);
});
</script>

<template>
    <div
        class="grid h-screen w-full md:grid-cols-[224px_1fr] lg:grid-cols-[288px_1fr]"
    >
        <div class="hidden border-r bg-muted/40 md:block">
            <Sidebar />
        </div>
        <div class="flex flex-col overflow-hidden">
            <header
                class="flex h-14 items-center gap-3 border-b bg-muted/40 px-4 lg:px-6"
            >
                <Sheet v-model:open="isMobileSidebarOpen">
                    <SheetTrigger as-child>
                        <Button
                            variant="ghost"
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
                            variant="ghost"
                            size="icon"
                            class="ml-auto rounded-full"
                        >
                            <Half2Icon
                                v-if="colorMode === 'auto'"
                                class="h-5 w-5"
                            />
                            <SunIcon
                                v-if="colorMode === 'light'"
                                class="h-5 w-5"
                            />
                            <MoonIcon
                                v-if="colorMode === 'dark'"
                                class="h-5 w-5"
                            />
                            <span class="sr-only">Toggle theme</span>
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuItem @click="colorMode = 'auto'">
                            Auto
                        </DropdownMenuItem>
                        <DropdownMenuItem @click="colorMode = 'light'">
                            Light
                        </DropdownMenuItem>
                        <DropdownMenuItem @click="colorMode = 'dark'">
                            Dark
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button
                            variant="ghost"
                            size="icon"
                            class="rounded-full"
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

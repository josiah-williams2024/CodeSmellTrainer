<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { LucideWrench, LayoutGrid, Video } from '@lucide/vue';
import AppLogo from '@/components/AppLogo.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
];

const resourceNavItems: NavItem[] = [
    {
        title: 'Code Smells Reference',
        href: 'https://refactoring.guru/refactoring/smells',
        icon: LucideWrench,
    },
    {
        title: 'Code Smells Video',
        href: 'https://www.youtube.com/watch?v=H3L0aN9KItA',
        icon: Video,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton class="p-4">
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />

            <SidebarGroup class="px-2 py-0">
                <SidebarGroupLabel>Resources</SidebarGroupLabel>

                <SidebarMenu>
                    <SidebarMenuItem
                        v-for="item in resourceNavItems"
                        :key="item.title"
                    >
                        <SidebarMenuButton as-child :tooltip="item.title">
                            <a
                                :href="item.href"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                <component :is="item.icon" />
                                <span>{{ item.title }}</span>
                            </a>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarGroup>
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>

    <slot />
</template>

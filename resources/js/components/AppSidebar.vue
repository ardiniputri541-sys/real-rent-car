<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { index as carsIndex } from "@/routes/admin/cars/index";
import { index as reservationsIndex } from "@/routes/admin/reservations/index";
import { index as clientsIndex } from "@/routes/admin/clients/index";
import { index as paymentsIndex } from "@/routes/admin/payments/index";
import { index as reportsIndex } from "@/routes/admin/reports/index";
import { index as supportIndex } from "@/routes/admin/support/index";
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Car, Calendar, User, CreditCard, BarChart, LifeBuoy } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { home } from '@/routes';

const mainNavItems: NavItem[] = [
    {
        title: 'Data Mobil',
        href: carsIndex(),
        icon: Car,
    },
    {
        title: 'Pemesanan',
        href: reservationsIndex(),
        icon: Calendar,
    },
    {
        title: 'Pelanggan',
        href: clientsIndex(),
        icon: User,
    },
    {
        title: 'Pembayaran',
        href: paymentsIndex(),
        icon: CreditCard,
    },
    {
        title: 'Laporan',
        href: reportsIndex(),
        icon: BarChart,
    },
    {
        title: 'Bantuan',
        href: supportIndex(),
        icon: LifeBuoy,
    },
];

</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="home()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>

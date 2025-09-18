<script setup lang="ts">
import { reactive, ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import { type BreadcrumbItem } from '@/types';
import { dashboard } from '@/routes';
import { productIndex, productEdit } from '@/routes/admin/products';
import type { ProductType } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import TextLink from '@/components/TextLink.vue';
import { Package, Pencil, Trash2 } from 'lucide-vue-next';
import VueApexCharts from 'vue3-apexcharts';

// defines
defineEmits([])

// variables
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Products',
        href: productIndex().url,
    },
];

interface Props {
    products?: ProductType[];
    totals: Object,
}

defineProps<Props>();

const chartOptions = {
    chart: {
      type: 'radialBar',
      offsetY: -20,
      sparkline: {
        enabled: true
      }
    },
    plotOptions: {
      radialBar: {
        startAngle: -90,
        endAngle: 90,
        track: {
          background: "#e7e7e7",
          strokeWidth: '97%',
          margin: 5,
          dropShadow: {
            enabled: true,
            top: 2,
            left: 0,
            color: '#444',
            opacity: 1,
            blur: 2
          }
        },
        dataLabels: {
          name: {
            show: false
          },
          value: {
            offsetY: -2,
            fontSize: '22px'
          }
        }
      }
    },
    grid: {
      padding: {
        top: -10
      }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        shadeIntensity: 0.4,
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 50, 53, 91]
      },
    },
    labels: [],
};

// computed properties

// watchers

// lifecycle hooks

// methods

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 grid grid-cols-12 gap-6">
            <div class="col-span-12">Search options</div>

            <div class="col-span-12 border-b">
                <h3 class="text-3xl font-bold pb-2">Product Statistics</h3>
            </div>

            <div class="col-span-3 grid grid-flow-row gap-2 py-2 px-4">
                <div>Active Products</div>
                <div><span class="text-xl font-bold">{{ totals.active_products }}</span> Products</div>
            </div>

            <div class="col-span-3 grid grid-flow-row gap-2 py-2 px-4 border-l">
                <div>Most Popular</div>
                <div class="text-ellipsis flex items-center">
                    <img :src="totals.most_popular_product.featured_photo_url" height="40px" width="40px" class="mr-2">
                    <span class="font-bold">{{ totals.most_popular_product.title }}</span>
                </div>
            </div>

            <div class="col-span-3 grid grid-flow-row gap-2 py-2 px-4 border-l">
                <div>Average Sale</div>
                <div><span class="text-xl font-bold">{{ totals.average_performance }}</span></div>
            </div>

            <div class="col-span-3 grid grid-flow-row gap-2 py-2 px-4 border-l">
                <div>Total Products Sold</div>
                <div><span class="text-xl font-bold">{{ totals.products_sold }}</span></div>
            </div>

            <div v-for="product in products" :key="product.id" class="col-span-12 grid grid-cols-12 bg-stone-200 p-2 rounded text-zinc-800">
                <div class="col-span-1 flex items-center justify-center">
                    <img :src="product.featured_photo_url" height="100px" width="100px" class="rounded-lg">
                </div>
                <div class="col-span-3 grid grid-flow-row gap-2">
                    <p class="font-bold">{{ product.title }}</p>
                </div>
                <div class="col-span-3 grid grid-flow-row gap-2 items-center">
                    <div class="text-sm">Performance</div>
                    <VueApexCharts width="200" type="radialBar" :options="chartOptions" :series="[50]" />
                </div>
                <div class="col-span-2 grid grid-flow-row gap-2">
                    <div class="text-sm">Stock</div>
                    <div class="flex items-centery"><Package class="mr-2" /> {{ product.inventory_remaining_human }}</div>
                </div>
                <div class="col-span-2 grid grid-flow-row gap-2">
                    <div class="text-sm">Price</div>
                    <div>{{ product.price_human }}</div>
                </div>
                <div class="col-span-1 flex items-center justify-center space-x-2">
                    <button><Pencil /></button>
                    <button><Trash2 /></button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

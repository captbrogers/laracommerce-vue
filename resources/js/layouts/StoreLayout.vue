<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import Breadcrumbs from '@/components/Breadcrumbs.vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div>
        <header>

        </header>
        <template v-if="breadcrumbs && breadcrumbs.length > 0">
            <Breadcrumbs :breadcrumbs="breadcrumbs" />
        </template>
        <div class="grid grid-cols-12 gap-6 mx-12">
            <div class="col-span-9 grid grid-cols-9 gap-6">
                <div class="col-span-9">
                    <h1 class="text-5xl">Find Your Next Awesome Thing</h1>
                    <p class="text-lg">Remember, everything is a statement. What you wear, how you wear it, even where you wear it.</p>
                </div>
                <slot />
            </div>
            <div class="col-span-3">
                <aside class="cart">
                    <p>Your Shopping Bag</p>
                    <p>Total: amount</p>
                    <div class="grid grid-flow-row gap-4">
                        <div v-for="(index, thing) in things" :key="index">
                            <img src="" height="80px" width="80px">
                            <div class="">

                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</template>

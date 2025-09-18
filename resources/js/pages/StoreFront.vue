<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import type { ProductType } from '@/types';
import { show } from '@/routes/store/products';
import StoreLayout from '@/layouts/StoreLayout.vue';
import TextLink from '@/components/TextLink.vue';

// defines

// variables
interface Props {
    products?: ProductType[];
}

defineProps<Props>();

// computed properties

// watchers

// lifecycle hooks

// methods

</script>

<template>
    <Head title="Store Front" />

    <StoreLayout>
        <div v-for="product in products" :key="product.id" class="col-span-3 bg-stone-200 p-2 rounded text-zinc-800 space-y-4">
            <div class="img-wrapper flex items-center justify-center">
                <img :src="product.featured_photo_url" height="200px" width="200px">
            </div>
            <TextLink :href="show(product.id)" class="font-bold">{{ product.title }}</TextLink>
            <div class="flex items-center justify-between">
                <p class="font-bold">{{ product.price_human }}</p>
                <button class="">Add To Bag</button>
            </div>
        </div>
    </StoreLayout>
</template>

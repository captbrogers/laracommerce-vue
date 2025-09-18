<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import type { ProductType } from '@/types';

// defines

// variables
interface Props {
    product: ProductType[];
}

defineProps<Props>();

// computed properties

// watchers

// lifecycle hooks

// methods

</script>

<template>
    <Head title="Store Front" />
    <div>
        {{ product.title }}
    </div>
</template>

<template>
    <div class="flex">
        <Link 
            v-if="backLink"
            :href="backLink"
            class="text-4xl mt-1 mr-2">
            <i class="fas fa-arrow-left"></i>
        </Link>
        <Link 
            :href="ownLink">
            <h1 class="text-5xl text-black no-underline font-black">
                {{ title }}
            </h1>
        </Link>
    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3';
    export default {
        components: {
            Link
        },

        props: {
            title: {
                type: String,
                required: true,
            },
            backLink: {
                type: String,
                default: null
            },

            ownLink: {
                type: String
            },
        }
    };
</script>
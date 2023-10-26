<template>
    <div class="flex">
        <Link 
            :href="ownLink">
            <h1 class="text-5xl text-black no-underline font-black">
                {{ title }}
            </h1>
        </Link>
        <Link 
            v-if="addLink"
            :href="addLink"
            class="text-white bg-green-300 rounded-full text-4xl inline-block py-1 px-2 w-12 h-12 ml-3">
            <i class="fas fa-plus"></i>
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
            addLink: {
                type: String,
                default: null
            },

            ownLink: {
                type: String
            },
        }
    };
</script>
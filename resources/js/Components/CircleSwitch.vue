<template>
    <div 
        class="w-6 h-6 rounded-full"
        :class="{'bg-red-500':bgRed, 'bg-green-500': bgGreen }" >

    </div>
</template>
<script>
    export default {
        props: {
            item: String,
            value: Number,
            orderId: Number,
            url: String
        },

        data () {
            return {
                localValue: this.value,
            }
        },

        computed: {
            bgRed () {
                return this.localValue === 0;
            },

            bgGreen () {
                return this.localValue === 1;
            }
        }

    };
</script>
<template>
    <div 
        class="w-6 h-6 rounded-full mx-auto"
        :class="{'bg-red-500':bgRed, 'bg-green-500': bgGreen }" 
        @click="toggleState">

    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        props: {
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
        },

        methods: {
            async toggleState () {
                const res = await axios.post(this.url, {
                    value: this.localValue,
                    order_id: this.orderId,
                });
                this.localValue = res.data ? 1:0;
            }
        }

    };
</script>
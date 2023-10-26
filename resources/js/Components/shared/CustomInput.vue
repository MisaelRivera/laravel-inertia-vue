<template>
    <div class="mb-4" v-if="!inline">
        <label 
            :for="id"
            v-if="label">{{ text }}</label>
        <input
            :type="type"
            :id="id"
            :name="name"
            :step="step"
            :min="min"
            class="border-2 border-slate-300 rounded-lg py-2 px-4 block w-full text-gray-900 text-sm focus:outline-none focus:border-blue-200"
            :value="modelValue"
            @input="updateModelValue"/>
    </div>
</template>
<script>
    export default {
        props: {
            modelValue: {
                type: String,
                required: true,
            },

            type: {
                type: String,
                default: 'text',
            },

            id: {
                type: String,
                default: null
            },
            text: {
                type: String
            },

            label: {
                type: Boolean,
                default: true,
            },

            name: {
                type: String,
                default: null
            },

            inline: {
                type: Boolean,
            },

            step: {
                type: Number,
                default: null
            },

            min: {
                type: Number,
                default: null
            },

            disabled: {
                type: Boolean,
            },
        },

        methods: {
            updateModelValue () {
                this.$emit('update:modelValue', event.target.value);
                this.$emit('custom');
            }
        }
    };
</script>
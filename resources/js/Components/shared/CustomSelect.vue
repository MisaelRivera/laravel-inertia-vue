<template>
    <div class="mb-4">
        <label :for="id" v-if="text">{{ text }}</label>
        <select
            :id="id"
            :name="name"
            class="border-2 border-slate-300 rounded-lg py-2 px-4 block w-full text-gray-900 text-sm focus:outline-none focus:border-blue-200">
            <slot></slot>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                type: String,
                default: null
            },

            text: {
                type: String
            },

            name: {
                type: String,
                default: null
            },

            inline: {
                type: Boolean,
            },

            disabled: {
                type: Boolean,
            },

            value: String,
        },
        data() {
            return {
                selectedValue: this.value,
            };
        },
        watch: {
            value(newValue) {
                this.selectedValue = newValue;
            },
            
            selectedValue(newValue) {
                this.$emit("input", newValue); // Emit the input event when the selected value changes
            },
        },
    }
</script>

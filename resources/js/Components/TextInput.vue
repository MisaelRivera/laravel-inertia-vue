<template>
    <input
      class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
      :value="modelValue"
      @input="updateModelValue"
      ref="input"
    />
</template>
  
<script>
export default {
  props: {
    modelValue: {
      type: String,
      required: true,
    },
  },
  mounted() {
    if (this.$refs.input.hasAttribute('autofocus')) {
      this.$refs.input.focus();
    }
  },
  methods: {
    updateModelValue(event) {
      this.$emit('update:modelValue', event.target.value);
      this.$emit('custom');
    },
  },
};
</script>



<template>
    <div class="w-8/12 mx-auto mt-2 bg-slate-400 rounded px-4 py-3">
        <TextInput 
            :modelValue="client"
            @custom="$emit('filteringByClient', 'client', client)"/>
    </div>
</template>
<script>
    import TextInput from '@/Components/TextInput.vue';
    export default {
        components: {
            TextInput
        },
        data () {
            return {
                client: null,
            }
        }
    }
</script>
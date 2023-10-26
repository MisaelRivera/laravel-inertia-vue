<template>
    <div class="w-8/12 mx-auto my-4 bg-blue-200 rounded px-4 py-3">
        <div class="w-3/12">
            <CustomInput 
                v-model="client"
                text="Filtro cliente"
                @custom="$emit('filteringByClient', 'client', client)"/>
        </div>
    </div>
</template>
<script>
    import CustomInput from '@/Components/shared/CustomInput.vue';
    export default {
        props: {
            clientProp: {
                type: String,
                default: ''
            }
        },
        components: {
            CustomInput
        },
        data () {
            return {
                client: this.clientProp,
            }
        }
    }
</script>
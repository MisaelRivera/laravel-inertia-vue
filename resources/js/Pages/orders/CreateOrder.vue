<template>
    <AuthenticatedLayout>
        <div class="w-8/12 mx-auto mt-3">
            <CreateTitle 
                title="Crear Orden"
                ownLink="/orders/create"
                backLink="/dashboard"/>
            <form class="px-4 py-2 bg-white rounded">
                <p>Ultimo folio: MFQ-{{ lastOrder.folio }} | {{ lastOrder.fecha_recepcion }} | {{ lastOrder.hora_recepcion }}</p>
                <p>Cliente: <div class="w-6 h-6 rounded-full inline-block" :class="{'bg-blue-500': aguas, 'bg-yellow-500': !aguas}"></div> {{ lastOrder.cliente.cliente }}</p>
                <div class="grid grid-cols-4 gap-6">
                    <CustomInput
                        text="Folio"
                        id="folio"
                        v-model="form.folio"
                        type="number"/>
                    <CustomInput
                        text="Número de cotizacion"
                        id="numero-cotizacion"
                        v-model="form.numeroCotizacion"/>
                    <CustomInput
                        text="Número de muestras"
                        id="numero-muestras"
                        type="number"
                        v-model="form.numeroMuestras"/>
                    <CustomSelect 
                        text="Aguas o alimentos"
                        :value="form.aguasAlimentos">
                        <option value="Aguas">Aguas</option>
                        <option value="Alimentos">Alimentos</option>
                    </CustomSelect>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import CustomInput from '@/Components/shared/CustomInput.vue'; 
    import CustomSelect from '@/Components/shared/CustomSelect.vue'; 
    import CreateTitle from '@/Components/shared/CreateTitle.vue';
    export default {
        components: {
            AuthenticatedLayout,
            Head,
            CustomInput,
            CreateTitle,
            CustomSelect,
        },

        props: {
            lastOrder: {
                type: Object,
                required: true,
            },

            aguas: {
                type: Boolean,
            },
        },

        data () {
            return {
                form: {
                    folio: '',
                    numeroCotizacion: '',
                    numeroMuestras: '',
                    aguasAlimentos: '',
                }
            };
        }
    };
</script>
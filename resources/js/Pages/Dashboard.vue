<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="w-11/12 mx-auto mt-3">
            <div class="w-8/12 mx-auto">
                <Link href="/test">Test</Link>
                <IndexTitle 
                     title="Ordenes"
                     ownLink="/dashboard"
                     addLink="/orders/create"/>
            </div>
            <IndexFilters 
                @filtering-by-client="filter"
                :client-prop="filters.client"/>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Folio</th>
                        <th scope="col" class="px-4 py-3">No.</th>
                        <th scope="col" class="px-4 py-3">
                            <button>
                                <i class="fas fa-arrow-down"></i>
                            </button>
                        </th>
                        <th scope="col" class="px-4 py-3"></th>
                            <th scope="col" class="px-4 py-3">Fecha de recepcion</th>
                            <th scope="col" class="px-4 py-3">Hora de recepcion</th>
                            <th scope="col" class="px-4 py-3">
                                Cliente
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Cesavedac
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Supervisanr
                            </th>
                            <th scope="col" class="px-4 py-3">
                                H. C.
                            </th>
                            <th scope="col" class="px-4 py-3">
                                C. C.
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Croquis
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Fecha resultados analistas
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Fecha resultados clientes
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Reporte entregado
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Desecho de muestras
                            </th>
                            <th scope="col" class="px-4 py-3">
                                PDF
                            </th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        class="border-b dark:border-gray-700" 
                        v-for="order in orders"
                        :key="order.id">
                        <td scope="row"
                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <Dropdown
                                align="center"
                                width="96">
                                <template #trigger>
                                    <button>
                                        MFQ-{{ order.folio }}
                                    </button>
                                </template> 
                                <template #content>
                                    <template v-for="muestra in order.muestras" :key="muestra.id">
                                        <ul class="list-none max-w-full" style="white-space: normal; word-wrap: break-word;">
                                            <li class="px-3 py-1 font-black max-w-full">
                                                MFQ-{{ order.folio }}-{{ muestra.numero_muestra }}
                                            </li>
                                            <li class="px-3 py-1 max-w-full">
                                               <span class="font-black">Identificacion de la muestra:</span>
                                               {{ muestra.identificacion_muestra ?  muestra.identificacion_muestra:muestra.identificacion_muestra_relacion.identificacion_muestra }} 
                                            </li>
                                            <li class="px-3 py-1 max-w-full">
                                                <span class="font-black">Caracteriticas: </span>
                                                {{ muestra.caracteristicas }}
                                            </li>
                                            <li class="px-3 py-1 max-w-full">
                                                <span class="font-black">Muestreador: </span>
                                                {{ muestra.muestreador }}
                                            </li>
                                            <li class="px-3 py-1 max-w-full" v-if="order.aguas_alimentos === 'Aguas'">
                                                <span class="font-black">pH: </span>
                                                {{ muestra.pH }}
                                            </li>
                                            <li class="px-3 py-1 max-w-full">
                                                <span class="font-black">Parametros: </span>
                                                {{ muestra.parametros }}
                                            </li>
                                            <li class="px-3 py-1 max-w-full" v-if="order.aguas_alimentos === 'Aguas'">
                                                <span class="font-black">Cloro: </span>
                                                {{ muestra.cloro }}
                                            </li>
                                            <li class="px-3 py-1 max-w-full" v-if="order.aguas_alimentos === 'Aguas'">
                                                <span class="font-black">Valor cloro: </span>
                                                {{ muestra.valor_cloro }}
                                            </li>
                                        </ul>
                                    </template>
                                </template>
                            </Dropdown>
                        </td>
                        <td class="px-4 py-3">
                            {{ order.numero_muestras }}
                        </td>
                        <td class="px-4 py-3">
                            <template v-if="order.aguas_alimentos === 'Aguas'">
                                <div class="w-6 h-6 bg-blue-500 rounded-full">

                                </div>
                            </template>
                            <template v-else>
                                <div class="w-6 h-6 bg-yellow-500 rounded-full">

                                </div>
                            </template>
                        </td>
                        <td class="px-4 py-3">
                            <Link :href="`/orders/${order.id}/show`">
                                <i class="fas fa-eye text-blue-500"></i>
                            </Link>
                        </td>
                        <td class="px-4 py-3">
                            {{ order.fecha_recepcion }}
                        </td>
                        <td class="px-4 py-3">
                            {{ order.hora_recepcion ? order.hora_recepcion.substr(0, 5):'' }}
                        </td>
                        <td class="px-4 py-3">
                            {{ order.cliente.cliente }}
                        </td>
                        <td class="px-4 py-3">
                            <CircleSwitch
                                v-if="order.cesavedac === 1"
                                :value="order.reporte_cesavedac_entregado"
                                :key="order.id"
                                url="/orders/toggle-cesavedac"
                                :orderId="order.id"/>
                        </td>
                        <td class="px-4 py-3">
                            <CircleSwitch
                                v-if="order.supervision !== false"
                                :value="order.supervision"
                                :key="order.id"
                                url="/orders/toggle-supervision"
                                :orderId="order.id"/>
                        </td>
                        <td class="px-4 py-3">
                            <CircleSwitch
                                v-if="order.siralab"
                                :value="order.siralab.hoja_campo"
                                :key="order.id"
                                url="/orders/toggle-hoja-campo"
                                :orderId="order.id"/>
                        </td>
                        <td class="px-4 py-3">
                            <CircleSwitch
                                v-if="order.siralab"
                                :value="order.siralab.cadena_custodia"
                                :key="order.id"
                                url="/orders/toggle-cadena-custodia"
                                :orderId="order.id"/>
                        </td>
                        <td class="px-4 py-3">
                            <CircleSwitch
                                v-if="order.siralab"
                                :value="order.siralab.croquis"
                                :key="order.id"
                                url="/orders/toggle-croquis"
                                :orderId="order.id"/>
                        </td>
                        <td class="px-4 py-3">
                            {{ addDaysWithoutSundays(order.fecha_recepcion, 8) }}
                        </td>
                        <td class="px-4 py-3">
                            {{ addDaysWithoutSundays(order.fecha_recepcion, 10) }}
                        </td>
                        <td class="px-4 py-3">
                            <CircleSwitch
                                :value="order.reporte_entregado"
                                :key="order.id"
                                url="/orders/toggle-reporte-entregado"
                                :orderId="order.id"/>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center mt-8">
                <Pagination 
                    :items="ordersProp"
                    :page="page"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import CircleSwitch from '@/Components/shared/CircleSwitch.vue';
import Pagination from '@/Components/shared/Pagination.vue';
import { Head, Link } from '@inertiajs/vue3';
import { addDaysWithoutSundays } from '@/helpers';
import IndexFilters from '@/Components/shared/IndexFilters.vue';
import IndexTitle from '@/Components/shared/IndexTitle.vue';
export default {
  components: {
    AuthenticatedLayout,
    Dropdown,
    Head,
    Pagination,
    IndexFilters,
    Link,
    CircleSwitch,
    IndexTitle,
},
  props: {
    ordersProp: {
      required: true,
    },
    page: {
        type: String
    }
  },

  mounted() {
    
  },

  data () {
    return {
        orders: this.ordersProp.data,
        filters: {
            client: '',
            folio: '',
            cesavedac: false
        }
    }
  },

  methods: {
    addDaysWithoutSundays (date, days) {
        return addDaysWithoutSundays(date, days);
    },

    async filter (filterType, filterValue) {
        this.filters[filterType] = filterValue;
        const orders = await axios.post('/orders/filter', this.filters);
        this.orders = orders.data.data;
    }
  },
};
</script>
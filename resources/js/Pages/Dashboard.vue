<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
        <div class="w-11/12 mx-auto">
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
                        v-for="order in orders.data"
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
                                    <template v-for="muestra in order.muestras">
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
                                <div class="w-8 h-8 bg-blue-500 rounded-full">

                                </div>
                            </template>
                            <template v-else>
                                <div class="w-8 h-8 bg-yellow-500 rounded-full">

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
                            {{ order.hora_recepcion.substr(0, 5) }}
                        </td>
                        <td class="px-4 py-3">
                            {{ order.cliente.cliente }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { Head, Link } from '@inertiajs/vue3';
export default {
  components: {
    AuthenticatedLayout,
    Dropdown,
    Head,
    Link
  },
  props: {
    orders: {
      required: true,
    },
  },
  methods: {
    printKeys(item, folio) {
      let values = '';
      Object.keys(item).forEach((key) => {
        console.log(`Folio: ${folio}, ${key}: ${item[key]}`);
        if (item[key] && key == 'identificacion_muestra') {
          values = item[key];
        }
      });
      return values;
    },
  },
};
</script>
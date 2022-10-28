<template>

    <Head title="Shipments" />

    <BreezeCustomerAuthLayout>
        <template #header> Shipments </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">
            <div class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-center w-12 bg-blue-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                        </path>
                    </svg>
                </div>

                <div class="flex justify-between mx-3 px-4 py-2 w-full">
                    <span class="font-semibold text-blue-500">Info</span>
                    <div class="flex justify-between w-1/2">
                        <p class="text-sm text-gray-600 px-4 py-2">
                            <BreezeButtonLink :href="this.route('admin.shipments.create')" class="h-10">New Shipment
                            </BreezeButtonLink>
                        </p>
                        <form class="mx-3 px-4 py-2 inline-flex" @submit.prevent="submit">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                for="file_input">
                                <input @input="
                                    form.manifest = $event.target.files[0]
                                "
                                    class="border-2 border-gray-600 cursor-pointer duration-300 font-medium h-10 hover:bg-gray-300 px-4 py-1 rounded-l-lg text-black text-sm transition"
                                    id="file_input" type="file" />
                            </label>
                            <div>

                                <button
                                    class="bg-indigo-600 border-y-indigo-600 border-y-2 duration-300 font-medium h-10 hover:bg-gray-600 px-4 rounded-r-lg text-1xl text-white transition">
                                    IMPORT
                                </button>
                                  <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-full mb-8 overflow-hidden border rounded-lg shadow-xs">
                <div class="p-4 flex">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="search" v-model="params.search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for items" />
                    </div>
                    <div class="px-4">
                        <select v-model="params.statusfilter"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option :value="{}" disabled>
                                Placeholder text
                            </option>
                            <option v-for="status in statuses" :key="status.id" :value="status.id">
                                {{ status.text }}
                            </option>
                        </select>
                    </div>
                    <div class="px-4">
                        <!-- <button
                            v-if="checked.length > 0"
                                    class="bg-indigo-600 border-y-indigo-600 border-y-2 duration-300 font-medium h-10 hover:bg-gray-600 px-4 rounded-r-lg text-1xl text-white transition">
                                    IMPORT
                                </button> -->
                    </div>
                </div>
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                <th class="px-4 py-3">
                                    <BreezeCheckbox name="shipment_id" />
                                </th>

                                <th class="px-4 py-3">
                                    <span class="inline-flex" @click="sort('shipment_number')">
                                        Shipment ID
                                        <svg v-if="
                                            params.field ===
                                            'shipment_number' &&
                                            params.direction === 'asc'
                                        " xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        <svg v-if="
                                            params.field ===
                                            'shipment_number' &&
                                            params.direction === 'desc'
                                        " xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </th>
                                <th class="px-4 py-3">EDD</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Weight</th>
                                <th class="px-4 py-3">Tracking Number</th>
                                <th class="px-4 py-3 inline-flex" @click="sort('created_at')">
                                    Created
                                    <svg v-if="
                                        params.field === 'created_at' &&
                                        params.direction === 'asc'
                                    " xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <svg v-if="
                                        params.field === 'created_at' &&
                                        params.direction === 'desc'
                                    " xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </th>
                                <th class="px-4 py-3">Rate</th>
                                <th class="px-4 py-3">Shipper</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            <tr v-for="shipment in shipments.data" :key="shipment.id" class="text-gray-700">
                                <td class="px-3 py-2">
                                    <BreezeCheckbox  v-model="shipment.selected" />
                                </td>
                                <td class="px-3 py-2">
                                    {{ shipment.id }}
                                    {{ shipment.shipment_number }}
                                </td>
                                <td class="px-3 py-2">{{ shipment.date }}</td>
                                <td class="px-3 py-2">
                                    {{ shipment.states_name }}
                                </td>
                                <td class="px-3 py-2">{{ shipment.weight }}</td>
                                <td class="px-3 py-2">
                                    {{ shipment.tracking_number }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ shipment.created_at }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ shipment.rate_weight }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ shipment.courier }}
                                </td>
                                <td class="px-3 py-2 flex">
                                    <Link
                                        class="text-md px-6 py-2 rounded-md bg-green-500 text-indigo-50 font-semibold cursor-pointer"
                                        :href="
                                            '/admin/shipments/' +
                                            shipment.id +
                                            '/edit'
                                        ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path
                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                    </svg>
                                    </Link>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
                    <Pagination :links="shipments.links" />
                </div>
            </div>
        </div>
    </BreezeCustomerAuthLayout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import BreezeButtonLink from "@/Components/ButtonLink.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeCustomerAuthLayout from '@/Pages/Customers/CLayouts/CustomerAuth.vue';
import Pagination from "@/Components/Pagination.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";

export default {
    components: {
        BreezeCustomerAuthLayout,
        Pagination,
        Link,
        BreezeCheckbox,
        BreezeButtonLink,
        Head,
    },

    props: {
        shipments: Object,
        statuses: Array,
        filters: Object,
    },
    setup() {
        const form = useForm({
            manifest: null,
        });



        return {
            destroy,
            form,
            submit,
        };
    },
    data() {
        return {
            params: {
                search: this.filters.search,
                statusfilter: this.filters.statusfilter,
                field: this.filters.field,
                direction: this.filters.direction,
            },

        };
    },

    methods: {
        sort(field) {
            this.params.field = field;
            this.params.direction =
                this.params.direction === "asc" ? "desc" : "asc";
        },
        import() {
            this.form.post(route("admin.excel.import"));
        },
        // selectebulk(id){
        //     console.log(id);
        //     this.$inertia.post(route("admin.shipments.bulkupdate", id));
        // }
    },
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);

                this.$inertia.get(this.route("admin.shipments.index"), params, {
                    replace: true,
                    preserveState: true,
                });
            }, 150),
            deep: true,
        },
    },
};
</script>

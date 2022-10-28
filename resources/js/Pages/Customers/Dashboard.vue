<template>
    <Head title="Dashboard" />

    <BreezeCustomerAuthLayout>
        <template #header> Dashboard </template>

        <div class="p-4 flex justify-between bg-white rounded-lg shadow-xs">
            <h1 class="text-3xl">Welcome {{ $page.props.auth.user.username }}!</h1>
            <h1 class="text-3xl">Welcome {{ $page.props.auth.user.shipmentid }}!</h1>
        </div>

        <div class="p-4 bg-white rounded-lg shadow-xs">
            <div
                v-show="$page.props.flash.success"
                class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md"
            >
                <div class="flex items-center justify-center w-12 bg-green-500">
                    <svg
                        class="w-6 h-6 text-white fill-current"
                        viewBox="0 0 40 40"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"
                        ></path>
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-green-500"
                            >Success</span
                        >
                        <p class="text-sm text-gray-600">
                            {{ $page.props.flash.success }}
                        </p>
                    </div>
                </div>
            </div>

            <BreezeValidationErrors class="mb-4" />
            <div
                class="w-full mb-2 overflow-hidden border rounded-lg shadow-xs"
            >
                <h1 class="p-2 text-2xl">Name: {{ customer.firstname }} {{ customer.lastname }}</h1>
            </div>
            <div class="flex items-center py-5">
                <div class="mx-auto container align-middle">
                    <div class="grid grid-cols-3 gap-2">
                        <div
                            class="shadow rounded-lg py-3 px-5 bg-white"
                            v-for="status in shipmentstatus"
                            :key="status.id"
                        >
                            <div
                                class="flex flex-row justify-between items-center"
                            >
                                <div>
                                    <h6 class="text-2xl">{{ status.name }}</h6>
                                    <h4
                                        class="text-black text-4xl font-bold text-left"
                                    >
                                        {{ status.shipments_count }}
                                    </h4>
                                </div>
                                <div>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-12 w-12"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="#14B8A6"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full mb-8 overflow-hidden border rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50"
                        >
                            <th class="px-4 py-3">
                                <!-- <BreezeCheckbox name="shipment_id"  /> -->
                            </th>

                            <th class="px-4 py-3">Shipment ID</th>
                            <th class="px-4 py-3">EDD</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Weight</th>
                            <th class="px-4 py-3">Tracking Number</th>
                            <th class="px-4 py-3">Created</th>
                            <th class="px-4 py-3">Rate</th>
                            <th class="px-4 py-3">Shipper</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        <tr
                            v-for="ship_package in packages.data"
                            :key="ship_package.id"
                            class="text-gray-700"
                        >
                            <td class="px-3 py-2">
                                <!-- <BreezeCheckbox name="ship_package_id" v-model="ship_package.id" /> -->
                            </td>
                            <td class="px-3 py-2">
                                {{ ship_package.shipment_number }}
                            </td>
                            <td class="px-3 py-2">{{ ship_package.date }}</td>
                            <td class="px-3 py-2">
                                {{ ship_package.status.name }}
                            </td>
                            <td class="px-3 py-2">{{ ship_package.weight }}</td>
                            <td class="px-3 py-2">
                                {{ ship_package.tracking_number }}
                            </td>
                            <td class="px-3 py-2">
                                {{ ship_package.created_at }}
                            </td>
                            <td class="px-3 py-2">
                                {{ ship_package.rate.weight }}
                            </td>
                            <td class="px-3 py-2">
                                {{ ship_package.shipcourier.name }}
                            </td>
                            <td class="px-3 py-2">
                                <Link
                                    :href="
                                        '/package/' + ship_package.id + '/show'
                                    "
                                >
                                    edit
                                </Link>

                                <Link
                                    @click="destroy(ship_package.id)"
                                    class="text-red-700"
                                    >Delete</Link
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9"
            >
                <pagination :links="packages.links" />
            </div>
        </div>
    </BreezeCustomerAuthLayout>
</template>

<script>
import BreezeCustomerAuthLayout from "@/Pages/Customers/CLayouts/CustomerAuth.vue";
import BreezeButton from "@/Components/Button.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeCustomerAuthLayout,
        Head,
        Link,
        BreezeButton,
        BreezeInput,
        Pagination,
        BreezeLabel,
        BreezeValidationErrors,
    },
    props: {
        customer: Object,
        packages: Object,
        shipmentstatus: Array,
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route("customers.destroy", id));
        },
        submit() {
            this.form.put(route("customers.update", this.customer.id));
        },
    },
};
</script>

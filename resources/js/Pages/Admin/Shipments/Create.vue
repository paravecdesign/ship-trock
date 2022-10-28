<template>
    <Head title="My profile" />

    <BreezeAuthenticatedLayout>
        <template  #header>
    <div class="flex justify-between">
            <div>Shipment
            </div>

    </div>

        </template>


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
                <div
                class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md"
            >
                <div class="flex items-center justify-center w-12 bg-blue-500">
                    <svg
                        class="w-6 h-6 text-white fill-current"
                        viewBox="0 0 40 40"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"
                        ></path>
                    </svg>
                </div>

                <div class="flex justify-between mx-3 px-4 py-2 w-full">
                    <span class="font-semibold text-blue-500">Info</span>
                    <p class="text-sm text-gray-600">
                        <BreezeButtonLink :href="route('admin.shipments.index')"
                            >Back to List</BreezeButtonLink
                        >
                    </p>
                </div>
            </div>

            <BreezeValidationErrors class="mb-4" />

            <form @submit.prevent="submit">
                <div class="grid grid-cols-8 gap-2">
                    <div class="col-span-2 mt-4">
                        <label>Processing Status:</label>
                        <select
                            class="block w-full mt-1 text-xs"
                            v-model="form.status_id"
                        >
                            <option
                                v-for="status in statuses"
                                :key="status.id"
                                :value="status.id"
                            >
                                {{ status.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-span-2 mt-4">
                        <label>Estimated Delivery Date</label>
                        <input
                            class="block w-full mt-1 text-xs"
                            type="date"
                            v-model="form.date"
                        />
                    </div>
                    <div class="col-span-2 mt-4">
                        <label>Shipper:</label>

                        <select
                            class="block w-full mt-1 text-xs"
                            v-model="form.shipper_id"
                        >
                            <option
                                v-for="shipper in shippers"
                                :key="shipper.id"
                                :value="shipper.id"
                            >
                                {{ shipper.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-span-2 mt-4">
                        <label>Item Cost</label>
                        <input
                            class="block w-full mt-1 text-xs"
                            type="text"
                            v-model="form.itemcost"
                        />
                    </div>
                    <div class="col-span-3 mt-4">
                        <label>Customers List</label>
                          <Select2 v-model="form.customer_id" :options="customers" :settings="{ width: '100%', height: '100px'}" />

                    </div>

                    <div class="col-span-2 mt-4">
                        <div class="col-span-1 mt-4">
                            <label>Carriers:</label>
                            <select
                                class="block w-full mt-1 text-xs"
                                v-model="form.carrier_id"
                            >
                                <option
                                    v-for="courier in carriers"
                                    :key="courier.id"
                                    :value="courier.id"
                                >
                                    {{ courier.name }}
                                </option>
                            </select>
                        </div>
                        <div class="col-span-1 mt-4">
                            <label>Freight:</label>
                            <input
                                class="block w-full mt-1 text-xs" readonly
                                type="number"
                                v-model="form.freight"
                            />
                        </div>
                    </div>
                    <div class="col-span-2 mt-4">
                        <div class="col-span-1 mt-4">
                            <label>Weight</label>
                            <input
                                class="block w-full mt-1 text-xs" step="0.01"
                                type="number"
                                v-model="form.weight"
                            />
                        </div>
                        <div class="col-span-1 mt-4">
                            <BreezeLabel for="email" value="Volume" />

                            <input
                                class="block w-full mt-1 text-xs"
                                type="number"
                                v-model="form.volume"
                            />
                        </div>
                        <div class="col-span-1 mt-4">
                            <BreezeLabel for="email" value="Tracking Number" />

                            <input
                                class="block w-full mt-1 text-xs"
                                type="text"
                                v-model="form.tracking_number"
                            />
                        </div>
                    </div>

                    <BreezeButton
                        class="block w-full mt-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Create Shipment
                    </BreezeButton>
                </div>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>

import BreezeButton from "@/Components/Button.vue";
import BreezeButtonLink from "@/Components/ButtonLink.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
import Select2 from 'vue3-select2-component';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeButtonLink,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Select2,
    },

    setup(props) {
        const form = useForm({
            _method: 'post',
            date: "",
            tracking_number: "",
            status_id: "",
            shipper_id: "",
            customer_id: "",
            carrier_id: "",
            itemcost: "",
            weight: "",
            volume: "",
        });

        return { form };
    },
    props: {
        statuses: Object,
        shippers: Object,
        customers: Object,
        rates: Object,
        carriers: Object,
    },
    methods: {
        submit() {
            this.form.post(route("admin.shipments.store"));
        },
    },
};
</script>

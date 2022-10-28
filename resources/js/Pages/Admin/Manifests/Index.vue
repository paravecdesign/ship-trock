<template>
    <Head title="Customers" />

    <BreezeAuthenticatedLayout>
        <template #header> Shipments </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">
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

                <div class="flex justify-between w-full px-4 py-2 mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-blue-500">Info</span>

                    </div>
                    <div>

                      <p class="text-sm text-gray-600">
                            <Link :href="'/admin/manifests/create'">Create</link>
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="w-full mb-8 overflow-hidden border rounded-lg shadow-xs"
            >
            	<div class="p-4">
			<label for="table-search" class="sr-only">Search</label>
			<div class="relative mt-1">
				<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
					<svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
						xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd"
							d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
							clip-rule="evenodd"></path>
					</svg>
				</div>
				<input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
        </div>
			</div>
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50"
                            >
                                <th class="px-4 py-3">ShipmentID</th>
                                <th class="px-4 py-3">x</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            <tr
                                v-for="shipment in shipments"
                                :key="shipment.id"
                                class="text-gray-700"
                            >>
                                <td class="px-4 py-3 text-sm">


                                    <!-- <Link
                                    :href="route('admin.customers.edit',customer.id)" >
                                        edit
                                    </Link> -->
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <Link
                                        @click="destroy(shipment.id)"
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
                    <!-- <pagination :links="customers.links" /> -->
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head } from "@inertiajs/inertia-vue3";
export default {
  components: {
    BreezeAuthenticatedLayout,
    Pagination,
    Link,
    Head,
  },

  props: {
    shipments: Object,
  },
  methods: {
    destroy(id) {
      this.$inertia.delete(route("shipments.destroy", id));
    },
  },
};
</script>

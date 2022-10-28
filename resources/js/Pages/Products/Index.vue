<template>
  <BreezeAuthenticatedLayout>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Products</h1>
    <div class="mb-6 flex justify-between items-center">
      <BreezeButtonLink class="px-6 py-3 rounded bg-indigo-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:bg-orange-400 focus:bg-orange-400" :href="route('admin.products.create')">
        <span>Create</span>
        <span class="hidden md:inline">Products</span>
      </BreezeButtonLink>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">ID</th>
        </tr>
        <tr v-for="products in products.data" :key="products.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">

              {{ products.product_name }}

          </td>
          <td class="border-t">
            <Link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('admin.products.edit', products.id)">
              EDit

            </Link>
          </td>
        </tr>
        <tr v-if="products.data.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No products found.</td>
        </tr>
      </table>
    </div>

    <div v-if="products.links.length > 3">
      <div class="flex flex-wrap -mb-1">
        <template v-for="(link, key) in products.links">
          <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
          <BreezeButtonLink v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
        </template>
      </div>
    </div>
  </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import {
    Link
} from "@inertiajs/inertia-vue3";
import BreezeButtonLink from "@/Components/ButtonLink.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Pagination from "@/Components/Pagination.vue";
import {
    Head
} from "@inertiajs/inertia-vue3";
import {
    Inertia
} from "@inertiajs/inertia";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Pagination,
        Link,
        BreezeCheckbox,
        BreezeButtonLink,
        Head,
    },
  metaInfo: { title: 'products' },
  props: {
    products: Object,
  },
}
</script>

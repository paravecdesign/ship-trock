<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('products')">Products</inertia-link>
      <span class="text-indigo-400 font-medium"> / </span>
      {{ products.title }}
    </h1>
  </div>
</template>

<script>
import BreezeButton from "@/Components/Button.vue";
import BreezeButtonLink from "@/Components/ButtonLink.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";

export default {
      components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeButtonLink,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },
  metaInfo() {
    return { title: this.products.title }
  },
  props: {
    products: Object,
  },
}
</script>

<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('duties')">Duty</inertia-link>
      <span class="text-indigo-400 font-medium"> / </span>
      {{ duty.title }}
    </h1>
  </div>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";

export default {

  metaInfo() {
    return { title: this.duty.title }
  },
  props: {
    duty: Object,
  },
}
</script>

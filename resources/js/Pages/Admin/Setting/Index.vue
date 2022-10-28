<template>
  <Head title="Setting" />

  <BreezeAuthenticatedLayout>
    <div class="vd jd tto vv oq ar ri">
      <!-- Page header -->
      <div class="ry">
        <!-- Title -->
        <h1 class="gg zj text-slate-800 font-bold">Account Settings ✨</h1>
      </div>
      <div class="bg-white grid grid-cols-6 rounded shadow-lg shadow-sm">
        <div class="pl-10">
       <BreezeSettingSidebar />
        </div>
        <!-- ... -->
        <div class="space-y-8 pt-10 col-span-5">09</div>
      </div>
      <br />
    </div>
  </BreezeAuthenticatedLayout>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import BreezeButtonLink from "@/Components/ButtonLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";

import { Head } from "@inertiajs/inertia-vue3";

export default {
  components: {
    BreezeAuthenticatedLayout,
    Link,
    BreezeNavLink,
    BreezeButtonLink,
    Head,
  },
};
</script>

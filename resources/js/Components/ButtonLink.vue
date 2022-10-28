<template>
    <Link
        :href="href"
        class="border-2 border-gray-600 text-black px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-600 transition duration-300"
    >
        <slot />
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },

    props: ["href"],
};
</script>

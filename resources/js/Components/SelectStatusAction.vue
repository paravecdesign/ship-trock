<template lang="">
    <div class="inline-flex p-3">
        <div class="px-4">
            <select
                v-model="actionId"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >

                <option
                    v-for="(action, index) in statuses"
                    :key="action.id"
                    :value="action.id"
                >
                    {{ action.name }}
                </option>
            </select>
        </div>
        <BreezeButton
            @click="$emit('execute', actionId)"
            class="block w-full h-10"

        >
            Apply
        </BreezeButton>
    </div>
</template>
<script>
import BreezeButton from "@/Components/Button.vue";
export default {
    components: {
        BreezeButton,
    },

    data() {
        return {
            actionId: null,
        };
    },
    props: {
        statuses: Array,
    },
};
</script>

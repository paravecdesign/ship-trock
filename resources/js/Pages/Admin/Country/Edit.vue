<template>
    <Head title="Country edit" />

    <BreezeAuthenticatedLayout>
        <div class="vd jd tto vv oq ar ri">
            <!-- Page header -->
            <div class="ry">
                <!-- Title -->
                <h1 class="zj text-slate-800 font-bold">
                    <div class="flex items-center space-x-3">
                        <svg
                            class="h-6 w-6 stroke-sky-500 group-hover:stroke-white"
                            fill="none"
                            viewBox="0 0 24 24"
                        ></svg>
                        <h3
                            class="text-slate-900 group-hover:text-white text-sm font-semibold"
                        >
                            Shipping Country ✨
                        </h3>
                        <Notification />
                    </div>
                </h1>
            </div>
            <div
                class="bg-white grid grid-cols-6 mt-4 rounded shadow-lg shadow-sm pb-9"
            >
                <div class="pl-10">
                    <BreezeSettingSidebar />
                </div>
                <!-- ... -->
                <div class="space-y-8 pt-10 col-span-5">
                    <div class="grid grid-cols-3">
                        <div class="col-span-1">
                            <div class="rounded-md border mr-5">
                                <h3 class="text-gray-600 p-3">Country</h3>
                                <div class="border">
                                    <form @submit.prevent="submit">
                                        <div class="mt-4 p-3">
                                            <BreezeLabel
                                                for="name"
                                                value="Country"
                                            />
                                            <input
                                                class="block w-full mt-1 text-xs"
                                                type="text"
                                                v-model="form.name"
                                            />
                                            <p
                                                class="text-xs italic text-red-500"
                                            >
                                                {{ form.errors.name }}
                                            </p>
                                        </div>

                                        <div class="mt-4 p-3">
                                            <BreezeLabel
                                                for="sortname"
                                                value="Sort Name"
                                            />
                                            <input
                                                class="block w-full mt-1 text-xs"
                                                type="text"
                                                v-model="form.sortname"
                                            />
                                            <p
                                                class="text-xs italic text-red-500"
                                            >
                                                {{ form.errors.sortname }}
                                            </p>
                                        </div>

                                        <div class="mt-4 p-3">
                                            <BreezeLabel
                                                for="phonecode"
                                                value="Phone Code"
                                            />
                                            <input
                                                class="block w-full mt-1 text-xs"
                                                type="text"
                                                v-model="form.phonecode"
                                            />
                                            <p
                                                class="text-xs italic text-red-500"
                                            >
                                                {{ form.errors.phonecode }}
                                            </p>
                                        </div>

                                        <div class="mt-4 p-3">
                                            <BreezeButton
                                                class="block w-full mt-4"
                                                :class="{
                                                    'opacity-25':
                                                        form.processing,
                                                }"
                                                :disabled="form.processing"
                                            >
                                                Create Country
                                            </BreezeButton>
                                        </div>
                                    </form>
                                </div>
                                <div class="rounded-md border mr-5">
                                    <h3 class="text-gray-600 p-3">States</h3>

                                    <table
                                        class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700"
                                    >
                                        <tr
                                            class="hover:bg-gray-100 dark:hover:bg-gray-700"
                                            v-for="state in country.states"
                                            :key="state.id"
                                        >
                                            <td
                                                class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                            >
                                                {{ state.id }}
                                            </td>
                                            <td>{{ state.name }}</td>
                                            <td>
                                                <Link
                                                :href="'/admin/setting/states/list/' + state.id"

                                                    class="border-2 border-purple-600 text-black px-4 py-2 rounded-md text-1xl font-medium hover:bg-purple-600 transition duration-300"
                                                >
                                                    View
                                                </Link>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="rounded-md border mr-5">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50"
                                        >
                                            <th class="px-4 py-3">
                                                Country ID
                                            </th>
                                            <th class="px-4 py-3">name</th>
                                            <th class="px-4 py-3">Sort Name</th>
                                            <th class="px-4 py-3">
                                                Phone Code
                                            </th>
                                            <th class="px-4 py-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y">
                                        <tr
                                            v-for="country in countries.data"
                                            :key="country.id"
                                            class="text-gray-700"
                                        >
                                            <td class="px-3 py-2">
                                                {{ country.id }}
                                            </td>
                                            <td class="px-3 py-2">
                                                {{ country.name }}
                                            </td>
                                            <td class="px-3 py-2">
                                                {{ country.sortname }}
                                            </td>
                                            <td class="px-3 py-2">
                                                {{ country.phonecode }}
                                            </td>

                                            <td class="px-3 py-2 flex">
                                                <Link
                                                    class="text-md px-6 py-2 rounded-md bg-green-500 text-indigo-50 font-semibold cursor-pointer"
                                                    @click="edit(country.id)"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-pencil"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"
                                                        />
                                                    </svg>
                                                </Link>
                                                <Link
                                                    @click="destroy(country.id)"
                                                    class="text-md px-6 py-2 rounded-md bg-red-500 text-indigo-50 font-semibold cursor-pointer"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-trash"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                                                        />
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                                                        />
                                                    </svg>
                                                </Link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-end pr-4 pt-4">
                                <pagination :links="countries.links" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeButton from "@/Components/Button.vue";
import BreezeButtonLink from "@/Components/ButtonLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";
import Notification from "@/Components/Notification.vue";
import BreezeSettingSidebar from "@/Layouts/settings-sidebar.vue";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Link,
        Pagination,
        BreezeNavLink,
        BreezeButton,
        BreezeInput,
        Notification,
        BreezeLabel,
        BreezeButtonLink,
        BreezeSettingSidebar,
        Head,
    },
    setup(props) {
        const form = useForm({
            _method: "put",
            name: props.country.name,
            sortname: props.country.sortname,
            phonecode: props.country.phonecode,
        });

        return { form };
    },
    props: {
        country: Object,
        states: Array,
        countries: Object,
        errors: Object,
    },
    methods: {
        manage(id) {
            this.$inertia.get(route("admin.setting.states.edit", id), {
                onSuccess: () => this.form.reset(),
            });
        },
        edit(id) {
            this.$inertia.get(route("admin.setting.countries.edit", id), {
                onSuccess: () => this.form.reset(),
            });
        },
        submit() {
            this.form.put(
                route("admin.setting.countries.update", this.country.id),
                {
                    onSuccess: () => this.form.reset(),
                }
            );
        },
        destroy(id) {
            this.$inertia.delete(route("admin.setting.countries.destroy", id));
        },
    },
};
</script>

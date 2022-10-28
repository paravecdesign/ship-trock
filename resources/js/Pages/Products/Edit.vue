<template>
    <BreezeAuthenticatedLayout>
        <h1 class="mb-8 font-bold text-3xl">
            <Link class="text-indigo-400 hover:text-indigo-600" :href="route('admin.products.index')">Products</Link>
            <span class="text-indigo-400 font-medium"> / </span>{{ form.title }}
        </h1>
        <trashed-message v-if="products.deleted_at" class="mb-6" @restore="restore">
            This products has been deleted.
        </trashed-message>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="update">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <div>
                        <label class="form-label" for="text-input-title">Title:</label>
                        <input v-model="form.title" id="text-input-title" ref="input" class="form-input" type="text" />
                    </div>
                </div>
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
                    <button v-if="!products.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Products</button>
                    <button :disabled="loading" class="flex items-center px-6 py-3 rounded bg-indigo-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:bg-orange-400 focus:bg-orange-400 ml-auto" type="submit">
                      Update Products
                    </button>
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
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";

export default {
        components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        BreezeButtonLink,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },
    metaInfo() {
        return { product_name: this.form.product_name }
    },
    props: {
        products: Object,
    },
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                name: this.products.title,
            }),
        }
    },
    methods: {
        update() {
            this.form.put(this.route('admin.products.update', this.products.id))
        },
        destroy() {
            if (confirm('Are you sure you want to delete this products?')) {
                this.$inertia.delete(this.route('admin.products.destroy', this.products.id))
            }
        },
        restore() {
            if (confirm('Are you sure you want to restore this products?')) {
                this.$inertia.put(this.route('admin.products.restore', this.products.id))
            }
        },
    },
}
</script>

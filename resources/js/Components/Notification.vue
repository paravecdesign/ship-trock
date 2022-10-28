<template>

            <div v-if="$page.props.flash.success && show" class="alert">
                <div class="p-2">
                    <div
                        class="inline-flex items-center bg-white leading-none text-purple-600 rounded-full p-2 shadow text-teal text-sm"
                    >
                        <span
                            class="inline-flex bg-indigo-600 text-white rounded-full h-6 px-3 justify-center items-center"
                            >Success</span
                        >
                        <span class="inline-flex px-2">
                            {{ $page.props.flash.success }}
                        </span>
                    </div>
                </div>
            </div>
            <div v-if="$page.props.flash.error && show" class="alert">
                <div class="p-2">
                    <div
                        class="inline-flex items-center bg-white leading-none text-pink-600 rounded-full p-2 shadow text-teal text-sm"
                    >
                        <span
                            class="inline-flex bg-pink-600 text-white rounded-full h-6 px-3 justify-center items-center"
                            >Deleted</span
                        >
                        <span class="inline-flex px-2">
                            {{ $page.props.flash.error }}
                        </span>
                    </div>
                </div>
            </div>

</template>
<script>
export default {
    data() {
        return {
            show: true
        }
    },
    watch: {
        '$page.props.flash': {
            handler(){
                this.show = true
            },
            deep: true
        },
    },
}
</script>

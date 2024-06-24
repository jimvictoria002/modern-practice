<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";
const { data, url } = defineProps({
    data: {
        type: Object,
        required: true
    },
    url: {
        type: String,
        required: true
    }
});

let pageNumber = ref(1),
    searchTerm = ref(usePage().props.search ?? "");

const pageNumberUpdated = (link) => {
    pageNumber.value = link.url.split("=")[1];
};

let getUrl = computed(() => {
    const setUrl = new URL(url);

    setUrl.searchParams.set("page", pageNumber.value);

    if (searchTerm.value) {
        setUrl.searchParams.set("search", searchTerm.value);
    }

    return setUrl;
});

watch(
    () => getUrl.value,
    (newValue) => {
        router.visit(newValue, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    }
);

const updatePageNumber = (link) => {
    let pageNumber = link.url.split("=")[1];

    router.visit(`?&page=${pageNumber}`, {
        preserveScroll: true,
    });
};
</script>

<style>
@media (max-width:850px) {

    .pag-btn {
        display: none;
    }

    .pag-btn:first-child {
        display: block;
    }

    .pag-btn:last-child {
        display: block;
    }
}
</style>

<template>
    <div class="w-full mx-auto py-6">
        <div class="max-w-none mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden  sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 px-4 py-3 flex items-center justify-between  sm:px-6">
                    <!-- <div class="flex-1 flex justify-between sm:hidden" /> -->
                    <div class=" sm:flex-1 flex lg:flex-row flex-col gap-7 justify-between items-center w-full">
                        <div>
                            <p class="text-sm text-gray-900 dark:text-gray-100">
                                Showing
                                <!-- space -->
                                <span class="font-medium">{{
                                    data.meta.from
                                }}</span>
                                <!-- space -->
                                to
                                <!-- space -->
                                <span class="font-medium">{{
                                    data.meta.to
                                }}</span>
                                <!-- space -->
                                of
                                <!-- space -->
                                <span class="font-medium">{{
                                    data.meta.total
                                }}</span>
                                <!-- space -->
                                results
                            </p>
                        </div>
                        <div class="self-center">
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination">
                                <button v-for="(link, index) in data.meta.links" :key="index"
                                    @click.prevent="pageNumberUpdated(link)" :disabled="link.active || !link.url"
                                    class="pag-btn whitespace-nowrap relative inline-flex items-center px-4 py-2 rounded text-sm font-medium"
                                    :class="{
                                        'z-10 bg-indigo-50 border-indigo-500 text-indigo-600':
                                            link.active,
                                        'bg-white dark:bg-gray-900  text-gray-500 hover:bg-gray-50':
                                            !link.active,
                                            
                                        'bg-white dark:bg-gray-900  text-gray-500 dark:hover:bg-gray-900':
                                            !link.url,
                                    }"
                                    
                                    >
                                    <span v-html="link.label"></span>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

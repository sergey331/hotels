<template>
    <div class="flex justify-end">
        <ul class="pagination bg-white p-2 shadow-sm rounded">
            <li class="pagination-item">
				<span
                    class="rounded-l rounded-sm border border-gray-100 px-3 py-2 cursor-not-allowed no-underline text-gray-600 h-10"
                    v-if="isInFirstPage"
                >&laquo;</span>
                <a
                    v-else
                    @click.prevent="onClickFirstPage"
                    class="rounded-l rounded-sm border-t border-b border-l border-gray-100 px-3 py-2 text-gray-600 hover:bg-gray-100 no-underline"
                    href="#"
                    role="button"
                    rel="prev"
                >
                    &laquo;
                </a>
            </li>

            <li class="pagination-item">
                <button
                    type="button"
                    @click="onClickPreviousPage"
                    :disabled="isInFirstPage"
                    aria-label="Go to previous page"
                    class="rounded-sm border border-gray-100 px-3 py-2 hover:bg-gray-100 text-gray-600 no-underline mx-2 text-sm"
                    :class="{'cursor-not-allowed': isInFirstPage}"
                >Previous
                </button>
            </li>

            <li
                v-for="page in pages"
                class="pagination-item"
                :key="page.name"
            >
				<span
                    class="rounded-sm border border-blue-100 px-3 py-2 bg-blue-100 no-underline text-blue-500 cursor-not-allowed mx-2"
                    v-if="isPageActive(page.name)"
                >{{ page.name }}</span>
                <a
                    class="rounded-sm border border-gray-100 px-3 py-2 hover:bg-gray-100 text-gray-600 no-underline mx-2"
                    href="#"
                    v-else
                    @click.prevent="onClickPage(page.name)"
                    role="button"
                >{{ page.name }}</a>
                <!-- <button
                    type="button"
                    @click="onClickPage(page.name)"
                    :disabled="page.isDisabled"
                    :class="{ active: isPageActive(page.name) }"
                >{{ page.name }}</button> -->
            </li>

            <li class="pagination-item">
                <button
                    type="button"
                    @click="onClickNextPage"
                    :disabled="isInLastPage"
                    aria-label="Go to next page"
                    class="rounded-sm border border-gray-100 px-3 py-2 hover:bg-gray-100 text-gray-600 no-underline mx-2 text-sm"
                    :class="{'cursor-not-allowed': isInLastPage}"
                >Next
                </button>
            </li>

            <li class="pagination-item">
                <!-- <button
                    type="button"
                    @click="onClickLastPage"
                    :disabled="isInLastPage"
                    aria-label="Go to last page"
                >Last</button> -->
                <a
                    class="rounded-r rounded-sm border border-gray-100 px-3 py-2 hover:bg-gray-100 text-gray-600 no-underline"
                    href="#"
                    @click.prevent="onClickLastPage"
                    rel="next"
                    role="button"
                    v-if="hasMorePages"
                >&raquo;</a>
                <span
                    class="rounded-r rounded-sm border border-gray-100 px-3 py-2 hover:bg-gray-100 text-gray-600 no-underline cursor-not-allowed"
                    v-else
                >&raquo;</span>
            </li>
        </ul>
    </div>
</template>

<script setup>
    defineProps({
        maxVisibleButtons: {
            type: Number,
            required: false,
            default: 3
        },

        totalPages: {
            type: Number,
            required: true
        },

        total: {
            type: Number,
            required: true
        },

        perPage: {
            type: Number,
            required: true
        },

        currentPage: {
            type: Number,
            required: true
        },

        hasMorePages: {
            type: Boolean,
            required: true
        }
    })
</script>

<style>
.pagination {
    display: inline-block;
}

.page-item {
    display: inline;
}

.page-link {
    cursor: pointer;
    padding: 0.5rem 0.75rem;
    border: 1px solid #ddd;
    background-color: #fff;
    color: #333;
    transition: background-color 0.3s ease;
}

.page-link:hover {
    background-color: #f0f0f0;
}

.active .page-link {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.disabled .page-link {
    cursor: not-allowed;
    color: #868e96;
}
</style>



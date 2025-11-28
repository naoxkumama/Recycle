<template>
    <div class="pagination">
        <button :disabled="!pagination.prev_page_url" @click="navigate(pagination.prev_page_url)">前へ</button>
        <span>{{ pagination.current_page }} / {{ pagination.last_page }}</span>
        <button :disabled="!pagination.next_page_url" @click="navigate(pagination.next_page_url)">次へ</button>
    </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    pagination: {
        current_page: number,
        last_page: number,
        prev_page_url: string | null,
        next_page_url: string | null
    }
}>()

const emits = defineEmits(['navigate']);

const navigate = (url: string | null) => {
    if (!url) return;
    router.visit(url);
    emits('navigate', url);
}
</script>

<style scoped>
.pagination {
    margin-top: 1.5rem;
    display: flex;
    justify-content:center;
    align-items: center;
    gap: 0.5rem;
}

.pagination button {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    background-color: #3498db;
    color: white;
    border: none;
    cursor: pointer;
    transition: background 0.3s;
}

.pagination button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

.pagination button:not(:disabled):hover {
    background-color: #2980b9;
}
</style>
<template>
    <div class="search-container">
        <div class="search-group" v-for="group in visibleGroups" :key="group.label">
            <template v-for="field in group.fields" :key="field.key">
                <label v-if="field.type === 'text'">
                    {{ field.label}}
                    <input v-model="form[field.key]"
                    type="text"
                    class="search-input">
                </label>

                <div v-else-if="field.type === 'dateRange'" class="date-range">
                    <label>{{ field.label }}</label>
                    <input
                    v-model="form[field.key + '_from']"
                    type="date"
                    class="search-input"
                    />
                    <span>～</span>
                    <input
                    v-model="form[field.key +'_to']"
                    type="date"
                    class="search-input"
                    />
                </div>
            </template>
        </div>
        <div class="search-buttons">
            <button @click="searchData" class="search-btn">検索</button>
            <button @click="resetSearch" class="reset-btn">リセット</button>
        </div>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { reactive } from 'vue'

const props = defineProps({
    filters: Object,
    groups: {
        type: Array,
        required: true,
    },
    searchUrl: {
        type: String,
        required: true,
    }
})

const form = reactive ({ ...(props.filters || {}) })

const visibleGroups = props.groups

const searchData = () => {
    router.get(props.searchUrl, form, {
        preserveState: true,
        replace: true,
    })
}

const resetSearch = () => {
Object.keys(form).forEach((key) => (form[key] = ''))
    searchData()
}

</script>

<style scoped>
.search-container {
    background: #dadada;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px 15px 1px 15px;
    margin-bottom: 14px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.search-group {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 8px;
}

.search-group + .search-group {
    margin-top: 12px;
}

.search-group label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: bold;
    font-size: 0.9rem;
    color: #444;
    margin-right: 4px;
}

.date-range {
    display: flex;
    align-items: center;
    gap: 4px;
    white-space: nowrap;
}

.date-range label {
    margin-right: 4px;
    font-weight: bold;
}

.date-range span {
    font-weight: bold;
    color: #555;
}

.search-input {
    width: 140px;
    padding: 4px 6px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 0.85rem;
    transition: border-color 0.2s, bow-shadow 0.2s;
}

.search-input:focus {
    border-color: #0078d7;
    box-shadow: 0 0 4px rgba(0, 120, 215, 0.3);
    outline: none;
}

.search-buttons {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 8px;
}

.search-btn {
    background-color: #0078d7;
    color: white;
    border: none;
    font-size: 0.85rem;
    border-radius: 4px;
    padding: 4px 10px;
    cursor: pointer;
    transition: background 0.3s, transform 0.1s;
}

.search-btn:hover {
    background-color: #005ea8;
    transform: translateY(-1px);
}

.reset-btn {
    background-color: #e6f6f6;
    color: #333;
    border: 1px solid #ccc;
    padding: 4px 14px;
    font-size: 0.85rem;
    border-radius:4px;
    cursor: pointer;
    transition: background 0.3s, transform 0.1s;
}

.reset-btn:hover {
    background-color : #e8e8e8;
    transform: translateY(-1px);
}
</style>
<template>
    <div class="table-wrapper">
        <table v-if="data.length" class="table">
            <thead>
                <tr>
                    <th v-for="(col, index) in columns"
                        :key="index"
                        :class="{ sortable: col.sortable, active: sort.field === col.field }"
                        @click="col.sortable && sortData(col.field)"
                        >
                        {{ col.label }}
                        <span v-if="col.sortable">
                            <span v-if="sort.field === col.field">
                                {{ sort.order === 'asc' ? '▲' : '▼' }}
                            </span>
                            <span v-else class="inactive">⇅</span>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, rowIndex) in data" :key="rowIndex">
                    <td v-for="(col, colIndex) in columns"
                        :key="colIndex"
                        :class="{ 'nowrap': col.field ==='name' || col.field === 'created_at' }"
                    >
                        {{ formatCell(row, col) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <p v-else>{{ emptyMessage}}</p>
    </div>
</template>

<script setup lang="ts">
import { useServerSortable } from '../composables/useServerSortable';
import { defineProps } from 'vue';

const props = defineProps<{
    data: Array<Record<string, any>>,
    columns: Array<{ label: string, field: string, type?: string }>,
    emptyMessage?: string
}>()

const { sort, sortData } = useServerSortable(props.data);

const formatCell = (row: Record<string, any>, col: { field: string, type?: string}) => {
    const value = row[col.field];
    if (!value) return '-';
    if (col.type === 'date'){
        return new Date(value).toLocaleString('ja-JP');
    }
    return value;
}

const emptyMessage = props.emptyMessage || 'データがありません';
</script>

<style scoped>
td {
    white-space: normal;
    word-break: break-word;
}

td.nowrap {
    white-space: nowrap !important;
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 0.5rem;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
}

.table th,
.table td {
    border: 1px solid #ddd;
    padding: 0.35rem 0.6rem;
    font-size: 0.75rem;
    text-align: center;
}

.table th {
    background-color: #2e86c1;
    color :white;
    font-weight: bold;
    white-space: nowrap;
}

.table td {
    border: 1px solid #ddd;
    padding: 0.35rem 0.6rem;
    font-size: 0.75rem;
    text-align: center;
    white-space: normal;
    word-break: break-word;
}

table tbody tr:nth-child(odd) {
    background-color: #f1f1f1
}

table tbody tr:nth-child(even) {
    background-color: #ffffff
}

.sortable {
    cursor: pointer;
    user-select: none;
    transition: background-color 0.2s;
}

.sortable:hover {
    background-color: #5dade2;
}

.sortable .inactive {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.8em;
    margin-left: 4px;
}

.active span {
    color: #fff;
}
</style>
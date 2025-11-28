import { ref, computed } from 'vue';

export function useSortable(data: Array<Record<string, any>>) {
    const sort = ref<{ field: string; order: 'asc' | 'desc'}>
    ({
        field: '',
        order: 'asc',
    })

    const toggleSort = (field: string) => {
        if (sort.value.field === field) {
            sort.value.order = sort.value.order === 'asc' ? 'desc' : 'asc'
        } else {
            sort.value.field = field
            sort.value.order = 'asc'
        }
    }

    const sortedData = computed(() => {
        const dataCopy = [...data]
        const { field, order } = sort.value
        if (!field) return dataCopy

        return dataCopy.sort((a, b) => {
            const aVal = a[field]
            const bVal = b[field]

            if (aVal == null && bVal == null) return 0
            if (aVal == null) return order === 'asc' ? -1 : 1
            if (bVal == null) return order === 'asc' ? 1 : -1

            if (typeof aVal === 'string' && aVal.match(/^\d{4}-\d{2}-\d{2}/)) {
                return order === 'asc'
                    ? new Date(aVal).getTime() - new Date(bVal).getTime()
                    : new Date(bVal).getTime() - new Date(aVal).getTime()
            }

            if (aVal < bVal) return order === 'asc' ? -1 : 1
            if (aVal > bVal) return order === 'asc' ? 1: -1
            return 0
        })
    })
    return { sort, toggleSort, sortedData };
}
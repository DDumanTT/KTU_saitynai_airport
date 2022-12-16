<template>
  <div>
    <h1 class="va-h1">Cities</h1>
    <va-data-table
      :items="(items as DataTableItem[])"
      :loading="loading"
      :columns="columns"
      striped
      class="crud-table"
    >
      <template #headerAppend>
        <tr class="crud-table__slot">
          <th v-for="item in createItem" :key="item.key" class="pa-1">
            <va-input
              v-model="item.value"
              :disabled="!item.editable"
              :placeholder="item.key"
            />
          </th>
          <th>
            <va-button :disabled="!areFieldsFilled" block @click="handleAdd"
              >Add</va-button
            >
          </th>
        </tr>
      </template>
      <template #cell(actions)="{ rowIndex }">
        <va-button preset="plain" icon="edit" @click="handleEdit(rowIndex)" />
        <va-button preset="plain" icon="delete" @click="handleDelete(rowIndex)" />
      </template>
    </va-data-table>
    <template v-if="editedItem">
      <va-modal
        class="crud-modal"
        :model-value="!!editedItem"
        title="Edit city"
        size="small"
        @ok="editItem"
        @cancel="resetEditedItem"
      >
        <va-input
          v-for="key in Object.keys(editedItem)"
          :key="key"
          v-model="editedItem[key]"
          class="my-3"
          :label="key"
        />
      </va-modal>
      <va-modal v-model="showDeleteModal">
        Are you sure you want to delete this city?
      </va-modal>
    </template>
  </div>
</template>

<script setup lang="ts">
import { DataTableColumnSource, DataTableItem, VaDataTable } from "vuestic-ui";

const columns: DataTableColumnSource[] = [
  { key: "id" },
  { key: "name" },
  { key: "country" },
  { key: "created_at" },
  { key: "updated_at" },
  { key: "actions" },
];

const createItem = ref<TableAddItem[]>([
  { key: "id", editable: false, value: "" },
  { key: "name", editable: true, value: "" },
  { key: "country", editable: true, value: "" },
  { key: "created_at", editable: false, value: "" },
  { key: "updated_at", editable: false, value: "" },
]);

const editableFields = computed(() => {
  const res: Record<string, string> = {};
  createItem.value
    .filter((item) => item.editable)
    .forEach((item) => (res[item.key] = item.value));
  return res;
});

const areFieldsFilled = computed(() =>
  Object.values(editableFields.value).every((item) => item !== "")
);

const loading = ref(true);
const showDeleteModal = ref(false);

const items = useState<City[]>("cities", () => []);
const editedItem = useState<Record<string, string> | null>("city", () => null);

async function handleAdd() {
  const response = await useAuthApi<City>("/api/cities", "post", editableFields.value);
  items.value.push(response);
}

function handleEdit(index: number) {
  const item = items.value[index];
  editedItem.value = {
    ...editableFields.value,
    ...usePick(item, Object.keys(editableFields.value)),
  } as Record<string, string>;
}

function editItem() {}

function resetEditedItem() {
  editedItem.value = null;
}

function handleDelete(index: number) {
  showDeleteModal.value = true;
}

onMounted(async () => {
  items.value = await useAuthApi("/api/cities", "get");
  loading.value = false;
});
</script>

<style scoped lang="scss">
.crud-table {
  --va-form-element-default-width: 0;

  .va-input {
    display: block;
  }

  &__slot {
    th {
      vertical-align: middle;
    }
  }
}

.crud-modal {
  .va-input {
    display: block;
  }
}
</style>

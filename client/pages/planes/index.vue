<template>
  <div>
    <h1 class="va-h1">Planes</h1>
    <va-data-table
      :items="formatItems"
      :loading="loading"
      :columns="columns"
      striped
      class="crud-table"
    >
      <template #headerAppend>
        <tr class="crud-table__slot">
          <th v-for="item in createItem" :key="item.key" class="pa-1">
            <va-select
              v-if="item.key === 'airline_id'"
              v-model="item.value"
              :options="airlinesSelect"
              placeholder="city"
              value-by="value"
            />
            <va-input
              v-else
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
      <template #cell(created_at)="{ value }">
        {{ formatDate(value) }}
      </template>
      <template #cell(updated_at)="{ value }">
        {{ formatDate(value) }}
      </template>
      <template #cell(actions)="{ rowData }">
        <va-button preset="plain" icon="edit" @click="handleEdit(rowData)" />
        <va-button preset="plain" icon="delete" @click="handleDelete(rowData)" />
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
        <template v-for="key in Object.keys(editedItem)" :key="key">
          <div class="my-3">
            <va-select
              v-if="key === 'airline_id'"
              v-model="editedItem[key]"
              :options="airlinesSelect"
              :label="key"
              value-by="value"
            />
            <va-input v-else v-model="editedItem[key]" :label="key" />
          </div>
        </template>
      </va-modal>
    </template>
    <va-modal v-model="showDeleteModal" @ok="deleteItem">
      Are you sure you want to delete this plane?
    </va-modal>
  </div>
</template>

<script setup lang="ts">
import { DataTableColumnSource, DataTableItem, VaDataTable } from "vuestic-ui";

definePageMeta({
  middleware: ["auth"],
});

const { init: showToast } = useToast();

const columns: DataTableColumnSource[] = [
  { key: "id" },
  { key: "model" },
  { key: "seats" },
  { key: "airline" },
  { key: "created_at" },
  { key: "updated_at" },
  { key: "actions" },
];

const createItem = ref<TableAddItem[]>([
  { key: "id", editable: false, value: "" },
  { key: "model", editable: true, value: "" },
  { key: "seats", editable: true, value: "" },
  { key: "airline_id", editable: true, value: "" },
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

const items = useState<Plane[]>("planes", () => []);
const airlinesSelect = useState<SelectOptions[]>("planes_airlines", () => []);
const editedItem = ref<Record<string, string> | null>(null);
const editedItemId = ref<number | null>(null);
const deleteItemId = ref<number | null>(null);

const formatItems = computed(() => {
  return items.value.map((item) => ({
    ...item,
    airline: item.airline?.name,
  })) as DataTableItem[];
});

async function handleAdd() {
  try {
    const response = await useAuthApi<Plane>("/api/planes", "post", editableFields.value);
    items.value.push(response);
    createItem.value.forEach((item) => {
      item.value = "";
    });
  } catch (err) {
    if (err instanceof Error) showToast({ message: err.message, color: "danger" });
  }
}

function handleEdit(item: Plane) {
  editedItemId.value = item.id;
  editedItem.value = {
    ...editableFields.value,
    ...usePick(item, Object.keys(editableFields.value)),
  } as Record<string, string>;
}

async function editItem() {
  try {
    const response = await useAuthApi<Plane>(
      `/api/planes/${editedItemId.value}`,
      "put",
      editedItem.value
    );
    if (!editedItemId.value) throw new Error("Invalid item id");
    const index = items.value.findIndex((item) => item.id === editedItemId.value);
    items.value[index] = response;
    resetEditedItem();
  } catch (err) {
    if (err instanceof Error) showToast({ message: err.message, color: "danger" });
  }
}

function resetEditedItem() {
  editedItemId.value = null;
  editedItem.value = null;
}

function handleDelete(item: Plane) {
  showDeleteModal.value = true;
  deleteItemId.value = item.id;
}

async function deleteItem() {
  await useAuthApi(`/api/planes/${deleteItemId.value}`, "delete");
  items.value = items.value.filter((item) => item.id !== deleteItemId.value);
  showDeleteModal.value = false;
  deleteItemId.value = null;
}

function formatDate(value: Date) {
  const date = new Date(value);
  return date.toLocaleString();
}

onMounted(async () => {
  items.value = await useAuthApi<Plane[]>("/api/planes", "get");
  airlinesSelect.value = (await useAuthApi<Airline[]>("/api/airlines", "get")).map(
    (item) => ({
      text: item.name,
      value: item.id,
      key: item.id,
    })
  );
  loading.value = false;
});
</script>

<style scoped lang="scss">
.crud-table {
  --va-form-element-default-width: 0;

  .va-input,
  .va-select {
    width: 100%;
    text-align: start;
    font-weight: normal;
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

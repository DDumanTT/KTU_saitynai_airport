<template>
  <div class="grid">
    <va-card v-for="item in props.items" :key="item.id">
      <va-card-title class="top">
        <span>
          {{ item.departure?.city?.country }}
          <p class="subtitle">
            {{ formatTime(item.departure_time) }}
          </p>
        </span>
        <va-icon name="flight" rotation="90" />
        <span>
          {{ item.arrival?.city?.country }}
          <p class="subtitle">
            {{ formatTime(item.arrival_time) }}
          </p>
        </span>
      </va-card-title>
      <va-card-content class="content mt-3">
        <div class="content__item">
          <p>Flight</p>
          <p>{{ item.code.toUpperCase() }}</p>
        </div>
        <div class="content__item">
          <p>Gate</p>
          <p>{{ item.gate.toUpperCase() }}</p>
        </div>
        <div class="content__item">
          <p>Duration</p>
          <p>{{ item.duration }}</p>
        </div>
        <div class="content__item">
          <p>Price</p>
          <p>{{ item.price }}</p>
        </div>
      </va-card-content>
    </va-card>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{ items: Flight[]; loading?: boolean }>();

function formatTime(date: Date) {
  const d = new Date(date);
  const hours = d.getHours().toString().padStart(2, "0");
  const mins = d.getMinutes().toString().padStart(2, "0");
  return `${hours}:${mins}`;
}
</script>

<style scoped lang="scss">
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 1rem;
}

.top {
  background: var(--va-primary);
  filter: brightness(80%);
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 1rem;
  font-size: 1rem;
  color: var(--va-text-inverted);
}

.subtitle {
  font-size: 0.75rem;
}

.content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;

  &__item {
    p {
      margin-bottom: 0.5rem;
    }
  }
}
</style>

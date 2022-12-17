<template>
  <div>
    <div>
      <div class="hero-image mb-4">
        <div class="hero-text py-5">
          <div>
            <h1 class="va-h1 mb-4" style="text-align: center">
              Where would you like to fly?
            </h1>
            <va-form class="search">
              <div class="row justify-center va-spacing-x-1">
                <va-input v-model="form.departure" label="Departure">
                  <template #prependInner>
                    <va-icon name="flight_takeoff" />
                  </template>
                </va-input>
                <va-input v-model="form.arrival" label="Arrival">
                  <template #prependInner>
                    <va-icon name="flight_land" />
                  </template>
                </va-input>
              </div>
              <va-button
                size="large"
                icon="arrow_forward"
                round
                class="mt-5"
                @click="handleSearch"
                >SEARCH</va-button
              >
            </va-form>
          </div>
        </div>
      </div>
    </div>
    <FlightsGrid :items="searchResult" :loading="loading" />
  </div>
</template>

<script setup lang="ts">
const form = ref({
  departure: "",
  arrival: "",
});

const loading = ref(false);

const searchResult = useState<Flight[]>("searchResult", () => []);

async function handleSearch() {
  loading.value = true;
  const response = await useApi<Flight[]>(
    `/api/flights?${new URLSearchParams(form.value)}`,
    "get"
  );
  loading.value = false;
  searchResult.value = response;
}
</script>

<style scoped>
.main {
  height: 100%;
}

.hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
    url("/img/clouds.jpg");

  height: 50%;

  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  width: 100%;
}

.search {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

input {
  background-color: white;
}
</style>

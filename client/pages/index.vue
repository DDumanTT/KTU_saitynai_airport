<template>
  <div class="main">
    <div class="hero-image">
      <div class="hero-text">
        <div>
          <h1 class="va-h1" style="text-align: center; margin-bottom: 5rem">
            Where would you like to fly?
          </h1>
          <va-form ref="form" tag="form" class="search">
            <va-input label="Departure" />
            <va-input label="Arrival" />
            <va-input label="" />
          </va-form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts"></script>

<style scoped>
.main {
  height: 100%;
}

.hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
    url("/img/clouds.jpg");

  height: 100%;

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
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

input {
  background-color: white;
}
</style>

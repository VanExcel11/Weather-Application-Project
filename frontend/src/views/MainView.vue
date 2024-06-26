<template>
  <div class="h-full w-full relative background-img">
    <!-- Main content  -->
    <div
      v-if="store.isWeatherLoading"
      class="w-full h-full flex flex-col items-center justify-center -mt-20 absolute inset-x-0 top-0 lg:max-w-lg lg:mx-auto"
    >
      <p class="text-white text-3xl ml-2">Loading...</p>
    </div>
    <div
      v-else
      class="w-full h-full flex flex-col items-center justify-center -mt-20 absolute inset-x-0 top-0 lg:max-w-lg lg:mx-auto"
    >
      <!-- Main content -->
      <!-- placed in a component file to minimize code redundancy and make it easier to test -->
      <MainContent />
    </div>
    <!-- footer  -->
    <!-- Should have made component for this but I am out of time :( -->
    <div
      class="absolute inset-x-0 bottom-0 w-full bg-black bg-opacity-80 rounded-t-xl z-100 lg:max-w-lg lg:mx-auto"
    >
    <!-- Toggle the component in and out -->
      <div
        @click="Toggle = !Toggle"
        class="w-full absolute flex justify-end -mt-12"
      >
        <p
          v-if="!Toggle && store.isLocationLoading == false"
          :class="{ 'animate-bounce ': !store.isLocationLoading }"
          class="rounded-full bg-black bg-opacity-60 p-2 border border-white border-opacity-60 mr-3"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="size-6 text-red-500"
          >
            <path
              fill-rule="evenodd"
              d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
              clip-rule="evenodd"
            />
          </svg>
        </p>
        <p
          v-else
          class="rounded-full bg-black bg-opacity-60 p-2 mr-3 border border-white border-opacity-60"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="3"
            stroke="currentColor"
            class="size-6 text-white"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="m19.5 8.25-7.5 7.5-7.5-7.5"
            />
          </svg>
        </p>
      </div>
      <div v-if="Toggle && !store.isLocationLoading" class="text-white">
        <div class="p-5">
          <h1 class="text-xl whitespace-nowrap mb-5">
            <span class="text-white text-xl">{{
              store.weatherData.location.name
            }}</span>
            <span class="text-white text-xl ml-2">{{
              store.weatherData.location.country
            }}</span>
          </h1>
          <p class="text-sm">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus
            voluptates inventore, aspernatur itaque laborum impedit saepe beatae
            nesciunt fuga unde expedita et veniam ut qui alias in vitae optio.
            Architecto?
          </p>
        </div>
        <div class="px-5">
          <h1 class="text-lg">Relevant Places</h1>
        </div>

        <!-- categories  -->
        <!-- Select a category to filter: -->
        <div class="px-5">
          <div>
            <h1 class="text-base">Categories</h1>
          </div>
          <div class="flex gap-2 overflow-x-auto custom-scrollbar mt-2">
            <div
              v-for="category in uniqueCategories"
              :key="category.id"
              @click="filterByCategory(category.id)"
              class="bg-black bg-opacity-40 rounded-xl py-2 px-3 text-sm text-center whitespace-nowrap hover:bg-opacity-85 cursor-pointer"
            >
              <p>{{ category.name }}</p>
            </div>
          </div>
        </div>
        <!-- filtered content  -->
        <div
          class="rounded m-5 p-3 flex flex-col h-64 overflow-y-auto custom-scroll"
        >
          <div v-for="result in filteredResults" :key="result.fsq_id">
            <div
              v-if="filteredResults.length > 0"
              class="bg-black bg-opacity-40 hover:bg-opacity-90 rounded-xl py-2 px-3 my-2 text-sm text-start border border-white border-opacity-30"
            >
              <p class="text-base font-semibold mb-2">
                {{ result.location.name }}
              </p>
              <p class="text-sm">{{ result.location.address }}</p>
              <p class="text-sm">
                {{ result.location.locality }},
                <span>{{ result.location.postcode }}</span>
              </p>
              <img
                class="w-10 bg-red-900"
                :src="`${result.location.icon.prefix}${result.location.icon.suffix}`"
                alt=""
              />
            </div>
          </div>
        </div>
      </div>

      <!-- search component  -->
      <div class="flex flex-between items-center p-5">
        <div class="flex justify-center w-3/4 h-full">
          <input
            v-model="searchCity"
            class="w-full border h-full px-3 py-2 rounded focus:outline-black focus:outline-1 focus:ring-0 focus:border-0"
            type="text"
            placeholder="Search Location"
          />
        </div>
        <div class="flex justify-center w-1/4 h-full">
          <button
            @click="SearchCity(searchCity)"
            class="rounded-full p-3 bg-black bg-opacity-60 text-white border border-opacity-40 border-white hover:bg-opacity-90"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-6"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref, computed } from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { useWeatherAndLocationStore } from "@/stores/weatherAndLocation";

// components
import MainContent from "../components/MainContent.vue";

// constants and variables
const store = useWeatherAndLocationStore();
const date = ref();
const selectedForecast = ref("hourly");

const Toggle = ref(false);
const selectedCategory = ref(null);

// methods

// Method to search for city
const SearchCity = (city) => {
  store.fetchWeather(city);
};

// get unique categories 
const uniqueCategories = computed(() => {
  const categories = new Map();
  store.locationData.results.forEach((result) => {
    result.categories.forEach((category) => {
      if (!categories.has(category.id)) {
        categories.set(category.id, category);
      }
    });
  });
  return Array.from(categories.values());
});

// set selected category 
const filteredResults = computed(() => {
  if (!selectedCategory.value) {
    return store.locationData.results;
  }
  return store.locationData.results.filter((result) =>
    result.categories.some((category) => category.id === selectedCategory.value)
  );
});
// filter the result of the selected category 

function filterByCategory(categoryId) {
  selectedCategory.value = categoryId;
}

// load the fetchWeather function when the page is loaded 
onMounted(() => {
  store.fetchWeather();
});
</script>

<style>
.background-img {
  background-image: url("@/assets/images/wallpaper.jpg");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 100vh;
  width: 100vw;
  overflow: hidden;
}
.custom-scrollbar::-webkit-scrollbar {
  display: none;
}
</style>

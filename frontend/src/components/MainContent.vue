<template>
  <div v-if="store.isWeatherLoading">
    <p class="text-white text-xl ml-2">Loading...</p>
  </div>
  <div v-else class="w-full">
    <div class="flex justify-center items-center">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        class="size-6 text-white"
      >
        <path
          fill-rule="evenodd"
          d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
          clip-rule="evenodd"
        />
      </svg>
      <p>
        <span class="text-white text-xl ml-2">{{
          store.weatherData.location.name
        }}</span>
        <span class="text-white text-xl ml-2">{{
          store.weatherData.location.country
        }}</span>
      </p>
    </div>
    <div class="mt-5 text-center">
      <p class="flex flex-col">
        <span class="text-white text-6xl font-semibold"
          >{{
            (store.weatherData.weather.temperature - 273.15).toFixed(2)
          }}
          °C</span
        >
        <span class="text-white text-sm mt-2">
          Feels like
          {{ (store.weatherData.weather.feels_like - 273.15).toFixed(2) }} °C
        </span>
      </p>
      <p class="flex items-center justify-center mt-2">
        <img
          :src="
            'https://openweathermap.org/img/wn/' +
            store.weatherData.weather.icon +
            '@2x.png'
          "
          class="w-12"
          alt="Weather Icon"
        />

        <span class="text-white">{{
          store.weatherData.weather.description.toUpperCase()
        }}</span>
      </p>

      <div class="flex">
        <div class="w-1/2 flex justify-end">
          <img src="@/assets/icons/sunrise.png" class="w-6" alt="" />
          <p class="text-white text-sm mx-3">
            {{ store.weatherData.sunrise }} AM
          </p>
        </div>
        <div class="w-1/2 flex justify-start">
          <img src="@/assets/icons/sunset.png" class="w-6" alt="" />
          <p class="text-white text-sm mx-3">
            {{ store.weatherData.sunset }} PM
          </p>
        </div>
      </div>
    </div>
    <div class="w-full p-10 text-white">
      <div class="flex justify-between gap-5 py-5">
        <div class="w-1/2 flex flex-col items-start md:items-center">
          <div class="flex gap-2">
            <img src="@/assets/icons/high-temperature.png" class="w-8" alt="" />
            <span class="text-xs">Temperature</span>
          </div>

          <p class="mt-2 text-base font-semibold">
            {{ (store.weatherData.weather.temp_min - 273.15).toFixed(2) }} °C -
            {{ (store.weatherData.weather.temp_max - 273.15).toFixed(2) }} °C
          </p>
        </div>
        <div class="w-1/2 flex flex-col items-start md:items-center">
          <div class="flex gap-2">
            <img src="@/assets/icons/windy (1).png" class="w-8" alt="" />
            <span class="text-xs">Visibility</span>
          </div>
          <p class="mt-2 text-base font-semibold">
            {{ store.weatherData.weather.visibility }}%
          </p>
        </div>
      </div>
      <div class="flex justify-between gap-5 py-5">
        <div class="w-1/2 flex flex-col items-start md:items-center">
          <div class="flex gap-2">
            <img src="@/assets/icons/humidity.png" class="w-7" alt="" />
            <span class="text-xs">Humidity</span>
          </div>
          <p class="mt-2 text-base font-semibold">
            {{ store.weatherData.weather.humidity }}%
          </p>
        </div>
        <div class="w-1/2 flex flex-col items-start md:items-center">
          <div class="flex gap-2">
            <img src="@/assets/icons/wind.png" class="w-8" alt="" />
            <span class="text-xs">Wind</span>
          </div>

          <p class="mt-2 text-base font-semibold">
            {{ store.weatherData.weather.wind.speed }}%
          </p>
        </div>
      </div>
      <div class="flex justify-between gap-5 py-5">
        <div class="w-1/2 flex flex-col items-start md:items-center">
          <div class="flex gap-2">
            <img src="@/assets/icons/rainy-day.png" class="w-8" alt="" />
            <span class="text-xs">Gust</span>
          </div>
          <p class="mt-2 text-base font-semibold">
            {{ store.weatherData.weather.wind.gust }} mph
          </p>
        </div>
        <div class="w-1/2 flex flex-col items-start md:items-center">
          <div class="flex gap-2">
            <img src="@/assets/icons/cloudy-day.png" class="w-8" alt="" />
            <span class="text-xs">Clouds</span>
          </div>

          <p class="mt-2 text-base font-semibold">
            {{ store.weatherData.weather.clouds }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { onMounted } from "vue";
import { useWeatherAndLocationStore } from "@/stores/weatherAndLocation";
const store = useWeatherAndLocationStore();
</script>

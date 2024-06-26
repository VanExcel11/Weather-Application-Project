import { defineStore } from "pinia";
import axios from "axios";
import { info } from "autoprefixer";

export const useWeatherAndLocationStore = defineStore("weatherAndLocation", {
  state: () => ({
    Data: [],
    weatherData: null,
    locationData: null,
    viewWeather: {},
    isWeatherLoading: true,
    isLocationLoading: true,
    error: null,
  }),

  actions: {
    // fetch weather from api
    // should pass city name in parameters
    async fetchWeather(city) {
      this.isWeatherLoading = true;
      try {
        const response = await axios
          .get(`http://127.0.0.1:8000/api/v1/weather`, {
            params: {
              q: city,
            },
          })
          .then((response) => {
            this.weatherData = response.data.data;
            this.isWeatherLoading = false;
            this.fetchLocation();
            this.error = null;
          });
      } catch (error) {
        this.error = error.message;
      } finally {
        this.isWeatherLoading = false;
      }
    },

    // fetch location from api
    // should pass city longitude and latitude in parameters

    async fetchLocation() {
      this.isLocationLoading = true;

      try {
        const response = await axios
          .get(`http://127.0.0.1:8000/api/v1/location`, {
            params: {
              ll: `${this.weatherData.location.coordinates.latitude},${this.weatherData.location.coordinates.longitude}`,
            },
          })
          .then((response) => {
            this.locationData = response.data.data;
            this.isLocationLoading = false;
            this.error = null;
          });
      } catch (error) {
        this.error = error.message;
      } finally {
        this.isLocationLoading = false;
      }
    },
  },

  getters: {},
});

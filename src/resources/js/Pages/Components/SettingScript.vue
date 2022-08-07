<template>
  <h1 class="mb-3 font-normal text-gray-700">Выберите валюты, курсы которых необходимо получать с ЦБ:</h1>
  <div class="space-y-5 columns-2">
    <div v-for="currency in data.currencies" :key="currency.Valute" class="relative flex items-start">
      <div class="flex items-center h-5">
        <input :name="currency.Name" :value="currency.Valute" v-model="data.selected" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
      </div>
      <div class="ml-3 text-sm">
        <label :for="currency.Name" class="font-medium text-gray-700">{{ currency.Valute }}</label>
        <p class="text-gray-500">{{ currency.Name }}</p>
      </div>
    </div>
  </div>
  <button
    type="button"
    class="mb-10 inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    @click.prevent="save"
  >
    Применить
    <SaveIcon class="ml-2 -mr-0.5 h-4 w-4" aria-hidden="true" />
  </button>
</template>

<script setup>
import { onMounted, reactive, inject } from '@vue/runtime-core';
import axios from 'axios';
import { SaveIcon } from '@heroicons/vue/solid'

const $toast = inject('$toast')

const data = reactive({
    currencies: null,
    selected: []
})

function save() {
    axios.post('/api/settings/script', {
      currencyIds: data.selected
    })
      .then(response => {
          $toast.info("Настройки успешно применены!")
      });
}

onMounted(() => {
    axios.get('/api/settings/script')
        .then(response => {
            data.currencies = response.data;
            response.data.forEach(function(item) {
                if(item.request) data.selected.push(item.Valute)
            });
        })
})
</script>

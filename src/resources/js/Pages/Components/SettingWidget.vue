<template>
  <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
        <div class="my-1">
            <label for="frequency" class="block text-sm font-medium text-gray-700">Частота обновления данных в виджете (мин):</label>
            <div class="flex items-center">
                <div class="mt-1 relative rounded-md shadow-sm ">
                    <input v-model="data.frequency" max="60" type="number" min="0" name="frequency" id="frequency" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md max-w-[85%]" placeholder="0" />
                </div>
                <button
                    type="button"
                    class="my-3 inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    @click.prevent="saveRefresh"
                >
                  Сохранить
                  <SaveIcon class="ml-2 -mr-0.5 h-4 w-4" aria-hidden="true" />
                </button>
            </div>
            <p v-show="data.error.show" class="text-red-800">{{ data.error.message }}</p>
        </div>
  </div>
  <h1 class="mb-3 font-normal text-gray-700">Выберите валюты, курсы которых необходимо отображать в виджете:</h1>
  <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
    <div v-for="currency in data.currencies" :key="currency.id" class="relative flex items-start">
      <div class="flex items-center h-5">
        <input :name="currency.name" :value="currency.id" v-model="data.selected" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
      </div>
      <div class="ml-3 text-sm">
        <label :for="currency.name" class="font-medium text-gray-700">{{ currency.valute_id }}</label>
        <p class="text-gray-500">{{ currency.name }}</p>
      </div>
    </div>
  </div>
  <button
    type="button"
    class="my-3 inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
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
import Input from '../Elements/Input.vue'

const $toast = inject('$toast')

const data = reactive({
    currencies: null,
    selected: [],
    frequency: 0,
    error: {
        message: null,
        show: false
    }
})

function save() {
    axios.post('/api/settings/widget', {
      currencyIds: data.selected
    })
        .then(response => {
            $toast.info("Настройки успешно применены!")
        });
}

function saveRefresh()
{
    data.error.show = false
    axios.post('/api/settings/widget/frequency', {
      frequency: data.frequency
    })
        .then(response => {
            $toast.info('Сохранение прошло успешно!')
        })
        .catch((error) => {
            data.error.message = error.response.data?.message
            data.error.show = true
        });;
}

onMounted(() => {
    axios.get('/api/settings/widget')
        .then(response => {
            data.currencies = response.data.currencies;
            data.frequency = response.data.frequency;
            response.data.currencies.forEach(function(item) {
                if(item.view) data.selected.push(item.id)
            });
        })
})
</script>

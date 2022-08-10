<template>
  <h1 class="mb-3 font-normal text-gray-700">Изменения курсов валют в ЦБ:</h1>
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
  <div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-10">
            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
            <div v-for="feature in features" :key="feature.name" class="relative">
                <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                    <component :is="feature.icon" class="h-6 w-6" aria-hidden="true" />
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">{{ feature.name }}</p>
                </dt>
                <dd class="mt-2 ml-16 text-base text-gray-500">
                {{ feature.description }}
                </dd>
            </div>
            </dl>
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
import { onMounted, reactive } from 'vue';
import axios from 'axios';
import { AnnotationIcon, GlobeAltIcon, LightningBoltIcon, ScaleIcon } from '@heroicons/vue/outline'

const features = [
  {
    name: 'Competitive exchange rates',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: GlobeAltIcon,
  },
  {
    name: 'No hidden fees',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: ScaleIcon,
  },
  {
    name: 'Transfers are instant',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: LightningBoltIcon,
  },
  {
    name: 'Mobile notifications',
    description:
      'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.',
    icon: AnnotationIcon,
  },
]

const data = reactive({
    currencies: null
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
    axios.get('/api/currencies')
        .then(response => {
            data.currencies = response.data;
        })
})
</script>

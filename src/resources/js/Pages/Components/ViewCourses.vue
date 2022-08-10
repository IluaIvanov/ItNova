<template>
  <div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mt-10">
        <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
          <div v-for="currency in data.currencies" :key="currency.id" class="relative">
            <dt>
              <div class="flex items-center justify-center h-20">
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Курс: {{ currency.last_course.value }}</p>
                <ChevronUpIcon v-if="currency.last_course.change" class="ml-2 -mr-0.5 h-10 w-10 text-green-800" aria-hidden="true" />
                <ChevronDownIcon v-else class="ml-2 -mr-0.5 h-10 w-10 text-red-800" aria-hidden="true" />
              </div>
                              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Дата последнего обновления: {{ new Date(currency.last_course.date * 1000).toLocaleString() }}</p>
              <p class="ml-16 text-lg leading-6 font-medium text-gray-900">{{ currency.name }}</p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500">
              Номинал: {{ currency.nominal }}
            </dd>
            <dd class="mt-2 ml-16 text-base text-gray-500">
              ID валюты: {{ currency.valute_id }}
            </dd>
            <dd class="mt-2 ml-16 text-base text-gray-500">
              Код: {{ currency.char_code }}
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </div>
</template>

<script setup>
import { AnnotationIcon, GlobeAltIcon, LightningBoltIcon, ScaleIcon } from '@heroicons/vue/solid'
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/solid'
import { onMounted, reactive } from 'vue';
import axios from 'axios';

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

function getFormatDate() {

}

onMounted(() => {
    axios.get('/api/currencies')
        .then(response => {
            data.currencies = response.data;
        })
})

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
</script>

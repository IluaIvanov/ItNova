<template>
  <div>
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
      <div class="flex flex-col flex-grow pt-5 bg-indigo-700 overflow-y-auto">
        <div class="mt-5 flex-1 flex flex-col">
          <nav class="flex-1 px-2 pb-4 space-y-1">
            <router-link v-for="item in navigation"
                :key="item.name"
                :to="item.href"
                :class="[$route.path == item.href ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-600', 'group flex items-center px-2 py-2 text-sm font-medium rounded-md']"
            >
                <component :is="item.icon" class="mr-3 flex-shrink-0 h-6 w-6 text-indigo-300" aria-hidden="true" />
                {{ item.name }}
            </router-link>
          </nav>
        </div>
      </div>
    </div>
    <div class="md:pl-64 flex flex-col flex-1">
      <main>
        <div class="py-6">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="py-4">
              <div class="rounded-lg h-80">
                <router-view> </router-view>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import {
  HomeIcon,
  AdjustmentsIcon,
  CogIcon
} from '@heroicons/vue/outline'

const navigation = [
  { name: 'Главная', href: '/', icon: HomeIcon, current: true },
  { name: 'Настройки виджета', href: '/settings/widget', icon: AdjustmentsIcon, current: false },
  { name: 'Настройки скрипта', href: '/settings/script', icon: CogIcon, current: false }
]
</script>

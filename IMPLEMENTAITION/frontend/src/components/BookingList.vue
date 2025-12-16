<template>
  <div
    class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default"
  >
    <table class="w-full text-sm text-left rtl:text-right text-body">
      <thead class="bg-neutral-secondary-soft border-b border-default">
        <tr>
          <th class="px-6 py-3 font-medium">Serial No.</th>
          <th class="px-6 py-3 font-medium">Customer Name</th>
          <th class="px-6 py-3 font-medium">Yacht Name</th>
          <th class="px-6 py-3 font-medium">Start Date</th>
          <th class="px-6 py-3 font-medium">End Date</th>
          <th class="px-6 py-3 font-medium">Price</th>
          <th class="px-6 py-3 font-medium">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(b, index) in bookings"
          :key="b.id"
          class="odd:bg-neutral-primary even:bg-neutral-secondary-soft border-b border-default"
        >
          <td class="px-6 py-4">{{ index + 1 }}</td>
          <th class="px-6 py-4 font-medium text-heading whitespace-nowrap">
            {{ b.customer_name }}
          </th>
          <td class="px-6 py-4">{{ b.yacht_name }}</td>
          <td class="px-6 py-4">{{ b.start_date }}</td>
          <td class="px-6 py-4">{{ b.end_date }}</td>
          <td class="px-6 py-4">${{ b.price }}</td>
          <td class="px-6 py-4">
            <button
              @click="$emit('delete-booking', b.id)"
              class="bg-red-600 hover:bg-red-900 text-white font-semibold px-4 py-2 rounded cursor-pointer"
            >
              Delete
            </button>
          </td>
        </tr>
        <tr v-if="bookings.length === 0">
          <td colspan="7" class="text-center py-4 text-gray-500 font-medium">
            No record found
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
defineProps({
  bookings: Array,
});
</script>

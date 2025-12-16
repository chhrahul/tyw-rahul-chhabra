<template>
  <div class="min-h-screen bg-gray-100 pl-64 pr-64 p-10">
    <h1 class="text-4xl font-bold text-center mb-6">Mini Booking App</h1>
    <div class="flex items-center justify-between mb-6">
      <!-- Date Filters -->
      <div class="flex items-center gap-4">
        <div>
          <label for="start-date" class="font-medium mr-2">Start Date:</label>
          <input
            id="start-date"
            type="date"
            v-model="filters.start_date"
            class="border p-2 rounded uppercase"
          />
        </div>
        <div>
          <label for="end-date" class="font-medium mr-2">End Date:</label>
          <input
            id="end-date"
            type="date"
            v-model="filters.end_date"
            class="border p-2 rounded uppercase"
          />
        </div>
        <!-- Clear Filter Button -->
        <button
          @click="clearFilters"
          class="bg-gray-400 text-white font-semibold px-4 py-2 rounded hover:bg-gray-500"
        >
          Clear Filter
        </button>
      </div>

      <!-- Add Booking Button -->
      <div class="text-right">
        <button
          @click="showModal = true"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded"
        >
          Add Booking
        </button>
      </div>
    </div>

    <!-- Booking List Table -->
    <BookingList :bookings="filteredBookings" @delete-booking="deleteBooking" />

    <!-- Add Booking Modal -->
    <div
      v-if="showModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
    >
      <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <button
          @click="showModal = false"
          class="absolute top-2 right-2 text-gray-500 hover:text-gray-800"
        >
          ✕
        </button>
        <BookingForm @booking-added="handleBookingAdded" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import axios from "axios";
import BookingForm from "./components/BookingForm.vue";
import BookingList from "./components/BookingList.vue";
import { useToast } from "vue-toastification";

const showModal = ref(false);
const bookings = ref([]);
const toast = useToast();

const filters = ref({
  start_date: "",
  end_date: "",
});

const filteredBookings = ref([]);

// Fetch bookings from Backend Api
const fetchBookings = async () => {
  try {
    const res = await axios.get("http://127.0.0.1:8000/api/bookings");
    bookings.value = res.data;
    filteredBookings.value = res.data;
  } catch (err) {
    console.error("Failed to fetch bookings:", err);
  }
};

// Watch filters and update filtered Bookings automatically
watch(
  () => [filters.value.start_date, filters.value.end_date],
  () => {
    filteredBookings.value = bookings.value.filter((b) => {
      const startMatch = filters.value.start_date
        ? b.start_date >= filters.value.start_date
        : true;
      const endMatch = filters.value.end_date
        ? b.end_date <= filters.value.end_date
        : true;
      return startMatch && endMatch;
    });
  }
);

// filters clear
const clearFilters = () => {
  filters.value.start_date = "";
  filters.value.end_date = "";
  filteredBookings.value = bookings.value;
};

// handle booking modal and update list
const handleBookingAdded = () => {
  fetchBookings();
  showModal.value = false;
};

// handle booking delete

const deleteBooking = async (id) => {
  if (!confirm("Are you sure you want to delete this booking?")) return;
  try {
    await axios.delete(`http://127.0.0.1:8000/api/bookings/${id}`);
    fetchBookings();
    toast.success("Booking deleted successfully!");
  } catch (err) {
    toast.error("Failed to delete booking");
  }
};



// Initial fetch
fetchBookings();
</script>

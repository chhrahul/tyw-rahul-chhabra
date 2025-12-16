<template>
  <form class="space-y-4" @submit.prevent="submit">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">
      Add New Booking
    </h2>

    <!-- Customer Name -->
    <div>
      <label class="block mb-1 font-medium text-gray-700">Customer Name <span class="text-red-600">*</span></label>
      <input
        v-model="form.customer_name"
        type="text"
        @input="clearError('customer_name')"
        placeholder="Enter Customer Name"
        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
      <p v-if="errors.customer_name" class="text-red-500 text-sm mt-1">
        {{ errors.customer_name[0] }}
      </p>
    </div>

    <!-- Yacht Name -->
    <div>
      <label class="block mb-1 font-medium text-gray-700">Yacht Name <span class="text-red-600">*</span></label>
      <input
        v-model="form.yacht_name"
        type="text"
        placeholder="Enter Yacht Name"
        @input="clearError('yacht_name')"
        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
      <p v-if="errors.yacht_name" class="text-red-500 text-sm mt-1">
        {{ errors.yacht_name[0] }}
      </p>
    </div>

    <!-- Start Date and End Date -->
    <div>
      <label class="block mb-1 font-medium text-gray-700">Start Date <span class="text-red-600">*</span></label>
      <input
        type="date"
        v-model="form.start_date"
        @input="clearError('start_date')"
        class="border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
      <p v-if="errors.start_date" class="text-red-500 text-sm mt-1">
        {{ errors.start_date[0] }}
      </p>
    </div>

    <div>
      <label class="block mb-1 font-medium text-gray-700">End Date <span class="text-red-600">*</span></label>
      <input
        type="date"
        v-model="form.end_date"
        @input="clearError('end_date')"
        class="border border-gray-300 rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
      <p v-if="errors.end_date" class="text-red-500 text-sm mt-1">
        {{ errors.end_date[0] }}
      </p>
    </div>

    <!-- Price -->
    <div>
      <label class="block mb-1 font-medium text-gray-700">Price <span class="text-red-600">*</span></label>
      <input
        type="number"
        v-model="form.price"
        placeholder="Enter Price"
        @input="clearError('price')"
        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
      <p v-if="errors.price" class="text-red-500 text-sm mt-1">
        {{ errors.price[0] }}
      </p>
    </div>

    <!-- Submit Button -->
    <button
      type="submit"
      class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition duration-200 mt-2"
    >
      Add Booking
    </button>

    <p v-if="error" class="text-red-500 text-sm text-center mt-2">
      {{ error }}
    </p>
  </form>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";

const emit = defineEmits(["booking-added"]);

const form = ref({
  customer_name: "",
  yacht_name: "",
  start_date: "",
  end_date: "",
  price: "",
});

const error = ref(null);
const errors = ref({});
const toast = useToast();

// Clear validation error on input
const clearError = (field) => {
  if (errors.value[field]) delete errors.value[field];
};

// Submit form
const submit = async () => {
  error.value = null;
  errors.value = {};

  try {
    await axios.post("http://127.0.0.1:8000/api/bookings", form.value);

    // Clear form after success
    form.value = {
      customer_name: "",
      yacht_name: "",
      start_date: "",
      end_date: "",
      price: "",
    };
    emit("booking-added");
     toast.success("Booking added successfully!");
  } catch (err) {
    if (err.response) {
      if (err.response.status === 422 && err.response.data.errors) {
        errors.value = err.response.data.errors;
      } else {
        toast.error("Failed to add booking");
      }
    } else {
      error.value = "Network or server error";
    }
  }
};
</script>

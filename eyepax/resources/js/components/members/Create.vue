<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k"
             class="bg-gray-800 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>

    <form class="space-y-6" @submit.prevent="saveMember">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label class="block text-sm font-medium text-gray-700" for="full_name">Full Name</label>
                <div class="mt-1">
                    <input id="full_name" v-model="form.full_name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="full_name"
                           type="text">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                <div class="mt-1">
                    <input id="email" v-model="form.email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="email"
                           type="text">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="telephone">Telephone</label>
                <div class="mt-1">
                    <input id="telephone" v-model="form.telephone" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="telephone"
                           type="text">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="joined_date">Joined Date</label>
                <div class="mt-1">
                    <input id="joined_date" v-model="form.joined_date" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="joined_date"
                           type="text">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="current_route">Current Route</label>
                <div class="mt-1">
                    <input id="current_route" v-model="form.current_route" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="current_route"
                           type="text">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="comments">Comments</label>
                <div class="mt-1">
                    <input id="comments" v-model="form.comments" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="comments"
                           type="text">
                </div>
            </div>
        </div>

        <button class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                type="submit">
            Create
        </button>
    </form>
</template>

<script setup>
import {reactive} from "vue";
import useMembers from "../../composables/members";

const form = reactive({
    'full_name': '',
    'email': '',
    'telephone': '',
    'joined_date': '',
    'current_route': '',
    'comments': '',
})
const {errors, storeMember} = useMembers()
const saveMember = async () => {
    await storeMember({...form});
}
</script>

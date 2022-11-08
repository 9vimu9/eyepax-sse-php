<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="bg-red-400 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>

    <form class="space-y-6" v-on:submit.prevent="saveMember">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Name</label>
                <div class="mt-1">
                    <input type="text" name="full_name" id="full_name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="member.full_name">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                    <input type="text" name="email" id="email"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="member.email">
                </div>
            </div>

            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Telephone</label>
                <div class="mt-1">
                    <input type="text" name="telephone" id="telephone"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="member.telephone">
                </div>
            </div>

            <div>
                <label for="joined_date" class="block text-sm font-medium text-gray-700">joined Date</label>
                <div class="mt-1">
                    <input type="text" name="joined_date" id="joined_date"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="member.joined_date">
                </div>
            </div>

            <div>
                <label for="current_route" class="block text-sm font-medium text-gray-700">Current Route</label>
                <div class="mt-1">
                    <input type="text" name="current_route" id="current_route"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="member.current_route">
                </div>
            </div>

            <div>
                <label for="comments" class="block text-sm font-medium text-gray-700">Comments</label>
                <div class="mt-1">
                    <input type="text" name="comments" id="comments"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="member.comments">
                </div>
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Save
        </button>
    </form>
</template>

<script setup>
import useMembers from "../../composables/members";

import { onMounted } from "vue";

const { errors, member, getMember, updateMember } = useMembers()
const props = defineProps({
    id: {
        required: true,
        type: String
    }
})

onMounted(getMember(props.id))

const saveMember = async () => {
    await updateMember(props.id)
}
</script>

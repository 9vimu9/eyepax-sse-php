<template>
    <p class="text-xl font-thin tracking-wider leading-4 text-left text-gray-500 uppercase">Sales Team</p>
    <div class="flex place-content-end mb-4">
        <div
            class="inline-flex items-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            <router-link :to="{ name: 'members.create' }" class="text-sm font-medium">Add Member</router-link>
        </div>
    </div>
    <div class="overflow-y-auto overflow-x-auto min-w-full max-h-screen overflow-y-auto  align-middle sm:rounded-md">


        <table class="min-w-full border divide-y divide-gray-200 overflow-auto">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Full Name</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Email</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Telephone</span>
                </th>

                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Current Route</span>
                </th>

                <th class="px-6 py-3 bg-gray-50"></th>
                <th class="px-6 py-3 bg-gray-50"></th>
                <th class="px-6 py-3 bg-gray-50"></th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
            <template v-for="item in members" :key="item.id">
                <tr class="bg-white">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.full_name }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.email }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.telephone }}
                    </td>

                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.current_route }}
                    </td>

                    <td class="px-4 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            View
                        </button>
                    </td>
                    <td class=" py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <router-link :to="{ name: 'members.edit', params: { id: item.id } }"
                                     class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit
                        </router-link>
                    </td>

                    <td class="px-4 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap flex space-x-4">
                        <button
                            class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            @click="deleteMember(item.id)">
                            Delete
                        </button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import useMembers from "../../composables/members";
import {onMounted} from "vue";

const {members, getMembers, destroyMember} = useMembers()
onMounted(getMembers)
const deleteMember = async (id) => {
    if (!window.confirm('Are you sure?')) {
        return
    }
    await destroyMember(id);
    await getMembers();
}
</script>

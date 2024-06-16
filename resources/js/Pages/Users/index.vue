<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { parseISO, format } from 'date-fns';

defineProps({
    users: {
        type: Object
    }
});

const formatDate = (dateString) => {
    const date = parseISO(dateString);
    return format(date, 'MMMM dd, yyyy | h:mma').replace(/^0/, '');
}

// console.log(formatDate('2024-06-16T13:20:24.000000Z'))

</script>

<template>

    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center w-full">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Users</h2>
                <!-- <Link :href="route('register')"
                    class="rounded-md px-3  md:pr-10 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white/80 dark:hover:text-white/50 dark:focus-visible:ring-white text-sm md:text-md">
                Register new user
                </Link> -->
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg pb-20">
                    <div class="p-6 pb-0 text-gray-900 dark:text-gray-100">Users list</div>
                    <div class=" flex flex-col px-6">
                        <div class="flex justify-end w-full pr-2 md:pr-5 my-4">
                            <NavLink :href="route('register')"
                                over-ride="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ">
                                Register new user
                            </NavLink>
                        </div>

                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div
                                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                    <table class="min-w-full divide-y ">
                                        <thead class="bg-gray-900">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-100 sm:pl-6">
                                                    ID
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-100 sm:pl-6">
                                                    Firstname
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-100 sm:pl-6">
                                                    Middlename
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-100">
                                                    Lastname
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-100">
                                                    Email
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-100">
                                                    Created At
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                            </tr>
                                        </thead>
                                        <tbody class=" ">
                                            <tr v-for="user in users" :key="user.id">
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 py-4 pl-4 pr-3 text-sm font-medium text-gray-100 sm:pl-6">
                                                    {{ user.id }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 py-4 pl-4 pr-3 text-sm font-medium text-gray-200/90 sm:pl-6">
                                                    {{ user.firstname }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 px-3 py-4 text-sm text-gray-200/90">
                                                    {{ user.middlename ? user.middlename : '' }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 px-3 py-4 text-sm text-gray-200/90">
                                                    {{ user.lastname }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 px-3 py-4 text-sm text-gray-200/90">
                                                    {{ user.email }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 px-3 py-4 text-sm text-gray-200/90">
                                                    {{
                                                        formatDate(user.created_at)
                                                    }}
                                                </td>

                                                <td
                                                    class="relative whitespace-nowrap bg-gray-900/40 py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    <Link href="#"
                                                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ">
                                                    Edit
                                                    </Link>
                                                    <DangerButton class="ms-3"
                                                        :class="{ 'relative spinner !text-transparent': false }">
                                                        Delete
                                                    </DangerButton>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <Pagination :data="students" :pageNumberUpdated="pageNumberUpdated" /> -->

                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>

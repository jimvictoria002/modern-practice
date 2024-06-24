<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage, useForm } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Swal from 'sweetalert2';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    drinks: {
        type: Object,
        required: true
    }
})


const { props } = usePage();

const successMessage = props.flash.success;

if (successMessage) {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: successMessage,
        showConfirmButton: true,
    });
}


const confirmDelete = (drink_id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Call the delete method here
            deleteUser(drink_id);
        }
    });
};

const deleteForm = useForm({});

const deleteUser = (drink_id) => {

    deleteForm.delete(route("drinks.destroy", drink_id), {
        preserveScroll: true,
        onSuccess: () => {
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: 'User deleted successfully',
                showConfirmButton: true,
            });
        },
        onError: () => {
            Swal.fire(
                'Error!',
                'There was a problem deleting the user.',
                'error'
            );
        }
    });

};


</script>

<template>

    <Head title="Drinks" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center w-full">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Drinks</h2>
                <!-- <Link :href="route('register')"
                    class="rounded-md px-3  md:pr-10 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white/80 dark:hover:text-white/50 dark:focus-visible:ring-white text-sm md:text-md">
                Register new user
                </Link> -->
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                    <div class=" flex flex-col px-6">
                        <div class="flex flex-col md:flex-row justify-between items-start w-full pr-2 md:pr-5 my-4 p-3">
                            <div class=" pb-0 text-gray-900 dark:text-gray-100">Drinks list</div>

                            <NavLink :href="route('drinks.create')"
                                over-ride="inline-flex items-center self-end px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ">
                                Add new drink
                            </NavLink>
                        </div>

                        <div v-if="drinks.data.length" class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
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
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-100 sm:pl-6">
                                                    Description
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-100">
                                                    Price
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-100">
                                                    Created At
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                            </tr>
                                        </thead>
                                        <tbody class=" ">
                                            <tr v-for="drink in drinks.data" :key="drink.id">
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 py-4 pl-4 pr-3 text-sm font-medium text-gray-100 sm:pl-6">
                                                    {{ drink.id }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 py-4 pl-4 pr-3 text-sm font-medium text-gray-200/90 sm:pl-6">
                                                    {{ drink.name }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 px-3 py-4 text-sm text-gray-200/90">
                                                    {{ drink.description }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 px-3 py-4 text-sm text-gray-200/90">
                                                    {{ drink.price }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap bg-gray-900/40 px-3 py-4 text-sm text-gray-200/90">
                                                    {{
                                                        drink.created_at_formatted
                                                    }}
                                                </td>

                                                <td
                                                    class="relative whitespace-nowrap bg-gray-900/40 py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    <Link :href="route(
                                                        'drinks.edit',
                                                        drink.id
                                                    )"
                                                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ">
                                                    Edit
                                                    </Link>
                                                    <DangerButton class="ms-3"
                                                        :class="{ 'relative spinner !text-transparent': false }"
                                                        @click="confirmDelete(drink.id)">
                                                        Delete
                                                    </DangerButton>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div v-else class="p-6 pb-0 text-gray-900 dark:text-gray-100">No active user</div>

                        <Pagination :data="drinks" :url="route('drinks.index')" />

                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>

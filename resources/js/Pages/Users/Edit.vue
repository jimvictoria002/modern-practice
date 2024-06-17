<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    user: {
        type: Object,
        required: true
    }
})

const user = usePage().props.user;

const form = useForm({
    firstname: user.firstname,
    middlename: user.middlename ? user.middlename : '',
    lastname: user.lastname,
    email: user.email
});



const submit = () => {
    form.put(route('users.update', user.id), {
        preserveScroll: true,
        onSuccess: () => form.reset()

    });
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit user</h2>
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 pb-20">
            <div class="w-full  px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

                <Head title="Register" />

                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Edit user here</h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Please use this form to edit a user account. If a email address is change it is required for
                        verification again to
                        complete the registration process.
                    </p>
                </header>

                <form @submit.prevent="submit" class="mt-6">
                    <div class="flex w-full md:flex-row flex-col gap-[3%] gap-y-6">
                        <div class="w-full">
                            <InputLabel for="firstname" value="Firstname" />

                            <TextInput id="firstname" type="text" class="mt-1 block w-full" v-model="form.firstname"
                                required autofocus autocomplete="firstname" />

                            <InputError class="mt-2" :message="form.errors.firstname" />
                        </div>

                        <div class="w-full">
                            <InputLabel for="middlename" value="Middlename" :is-required="false" />

                            <TextInput id="middlename" type="text" class="mt-1 block w-full" v-model="form.middlename"
                                autocomplete="middlename" />

                            <InputError class="mt-2" :message="form.errors.middlename" />
                        </div>


                    </div>


                    <div class="flex w-full md:flex-row flex-col gap-[3%] gap-y-6 mt-6 md:mt-7">
                        <div class="w-full">
                            <InputLabel for="lastname" value="Lastname" />

                            <TextInput id="lastname" type="text" class="mt-1 block w-full" v-model="form.lastname"
                                required autocomplete="lastname" />

                            <InputError class="mt-2" :message="form.errors.lastname" />
                        </div>

                        <div class="w-full">
                            <InputLabel for="email" value="Email" />

                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                autocomplete="username" />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>



                    </div>

                    <p v-if="form.recentlySuccessful" class="text-sm text-green-700 mt-3 text-end">User created.</p>

                    <div class="flex items-center justify-end mt-4">

                        <!-- <Link :href="route('login')"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Already registered?
                    </Link> -->

                        <PrimaryButton class="ms-4" :class="{ 'relative spinner !text-transparent': form.processing }"
                            :disabled="form.processing">
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

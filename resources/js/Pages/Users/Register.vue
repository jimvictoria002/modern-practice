<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    firstname: '',
    middlename: '',
    lastname: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        preserveScroll: true,
        onFinish: () => form.reset('password', 'password_confirmation'),
        onSuccess: () => form.reset()

    });
};
</script>

<template>
    <AuthenticatedLayout >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Register user</h2>
        </template>
        <div class=" flex flex-col sm:justify-center items-center md:my-12  pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 pb-24">
            <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

            <Head title="Register" />

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="firstname" value="Firstname" />

                    <TextInput id="firstname" type="text" class="mt-1 block w-full" v-model="form.firstname" required
                        autofocus autocomplete="firstname" />

                    <InputError class="mt-2" :message="form.errors.firstname" />
                </div>

                <div class="mt-4">
                    <InputLabel for="middlename" value="Middlename" :is-required="false" />

                    <TextInput id="middlename" type="text" class="mt-1 block w-full" v-model="form.middlename"
                        autocomplete="middlename" />

                    <InputError class="mt-2" :message="form.errors.middlename" />
                </div>

                <div class="mt-4">
                    <InputLabel for="lastname" value="Lastname" />

                    <TextInput id="lastname" type="text" class="mt-1 block w-full" v-model="form.lastname" required
                        autocomplete="lastname" />

                    <InputError class="mt-2" :message="form.errors.lastname" />
                </div>


                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <div class="flex justify-between">
                        <InputLabel for="password" value="Password" />
                        <div class="flex">
                            <!-- &#10003; -->
                            <p class="text-indigo-500 text-sm font-semibold text-end mr-2">At least 8 characters</p>
                        </div>
                        
                    </div>

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                    
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" required autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <p v-if="form.recentlySuccessful" class="text-sm text-green-700 mt-3">User created.</p>

                <div class="flex items-center justify-end mt-4">

                    <!-- <Link :href="route('login')"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Already registered?
                    </Link> -->

                    <PrimaryButton 
                        class="ms-4" 
                        :class="{'relative spinner !text-transparent' : form.processing}"
                        :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>

    </AuthenticatedLayout>
</template>

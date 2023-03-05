<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Card from 'primevue/card';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="flex flex-wrap mx-auto sm:px-6 lg:px-8">
                <div class="p-5 w-1/2">
                    <Card>

                        <template #title>
                            Card 1
                        </template>
                        <template #content>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error
                            repudiandae numquam deserunt
                            quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse,
                            cupiditate
                            neque quas!
                        </template>
                        <template #footer>
                            <Button icon="pi pi-check" label="Save" />
                            <Button icon="pi pi-times" label="Cancel" class="p-button-secondary"
                                style="margin-left: .5em" />
                        </template>
                    </Card>
                </div>

                <div class="p-5 w-1/2">
                    <Card>

                        <template #title>
                            Card 2
                        </template>
                        <template #content>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error
                            repudiandae numquam deserunt
                            quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse,
                            cupiditate
                            neque quas!
                        </template>
                        <template #footer>
                            <Button icon="pi pi-check" label="Save" />
                            <Button icon="pi pi-times" label="Cancel" class="p-button-secondary"
                                style="margin-left: .5em" />
                        </template>
                    </Card>
                </div>


                <div class="p-5 w-1/2">
                    <Card>

                        <template #title>
                            Card 3
                        </template>
                        <template #content>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error
                            repudiandae numquam deserunt
                            quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse,
                            cupiditate
                            neque quas!
                        </template>
                        <template #footer>
                            <Button icon="pi pi-check" label="Save" />
                            <Button icon="pi pi-times" label="Cancel" class="p-button-secondary"
                                style="margin-left: .5em" />
                        </template>
                    </Card>
                </div>


                <div class="p-5 w-1/2">
                    <Card>

                        <template #title>
                            Card 4
                        </template>
                        <template #content>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error
                            repudiandae numquam deserunt
                            quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse,
                            cupiditate
                            neque quas!
                        </template>
                        <template #footer>
                            <Button icon="pi pi-check" label="Save" />
                            <Button icon="pi pi-times" label="Cancel" class="p-button-secondary"
                                style="margin-left: .5em" />
                        </template>
                    </Card>
                </div>


        </div>
    </div>
</AppLayout></template>

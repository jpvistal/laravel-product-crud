<template>
    <AppLayout title="Products">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>
        <div class="py-12">
            <div class=" mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <DataTable :value="productData" :paginator="true" :rows="perPage" :rowHover="true" dataKey="id"
                        filterDisplay="menu" v-model:filters="filters" :loading="loading"
                        :globalFilterFields="['name', 'description']">
                        <template #header>
                            <div class="flex justify-between align-items-center">
                                <span class="p-input-icon-left">
                                    <i class="pi pi-search" />
                                    <InputText v-model="filters['global'].value"
                                        placeholder="Search by name, description" />
                                </span>
                                <Button label="Create" class="p-button-raised" @click="createProduct()"></Button>
                            </div>
                        </template>
                        <template #empty>
                            No products present
                        </template>
                        <template #loading>
                            Loading products data. Please wait.
                        </template>
                        <Column v-for="col of columns" :field="col.key" :header="col.label" :key="col.field"
                            :sortable="col.sort" style="min-width: 10rem">
                            <template #filter="{ filterModel }" v-if="col.key == 'category'">
                                <InputText type="text" v-model="filterModel.value" class="p-column-filter"
                                    placeholder="Search by name" />
                            </template>
                        </Column>
                        <Column headerStyle="width: 4rem; text-align: center"
                            bodyStyle="text-align: center; overflow: visible" header="Action">
                            <template #body="{ data }">
                                <div class="flex">
                                    <div class="px-1">
                                        <Button icon="pi pi-pencil" class="p-button-rounded p-button-secondary"
                                            @click="showProduct(data.id)" />
                                    </div>
                                    <div class="px-1">
                                        <Button icon="pi pi-trash" class="p-button-rounded p-button-danger"
                                            @click="destroyProduct(data.id)" />
                                    </div>
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AppLayout>
</template>



<script>
import { defineComponent, ref } from 'vue';
import { FilterMatchMode, FilterOperator } from 'primevue/api';


import AppLayout from '@/Layouts/AppLayout.vue';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import MultiSelect from 'primevue/multiselect';


export default defineComponent({
    components: {

        AppLayout,
        DataTable,
        Column,
        InputText,
        Button,
        MultiSelect
    },

    data() {
        return {
            filters: {
                'global': { value: null, matchMode: FilterMatchMode.CONTAINS },
                'category': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
            },
            perPage: 7,
            columns: null,
            dateOptions: { year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric', seconds: 'numeric', timeZone: 'Asia/Shanghai', hour12: false },
            products: {

            },
            categories: {

            },
        };
    },
    created() {
        this.columns = [
            { key: 'name', label: 'Product', sort: true },
            { key: 'category', label: 'Category', },
            { key: 'description', label: 'Description', },
            { key: 'dataTime', label: 'Date and Time', },

        ];

        this.getProducts();
        this.getCategories();
    },

    methods: {
        async getProducts() {
            try {
                const response = await axios.get('/api/product');
                console.log('getProducts', response.data);


                this.products = response.data;


            } catch (e) {
                console.log(e);
            }
        },

        async getCategories() {
            try {
                const response = await axios.get('/api/category');
                console.log('getCategories', response.data);
                this.categories = response.data;
            } catch (e) {
                console.log(e);
            }
        },

        async destroyProduct(productId) {
            try {
                let url = "/api/product/" + productId;
                const response = await axios.delete(url);
                if (response.data.status === 'success') {
                    this.getProducts();
                }
            } catch (e) {
                console.log(e);
            }
        },

        showProduct(productId) {
            window.location.href = "/products/" + productId;
        },

        createProduct() {
            window.location.href = "/products/create";
        },
    },

    computed: {
        productData() {
            const data = this.products.map((product) => {
                product.category = this.categories.find(o => o.id == product.category_id).name;
                product.dataTime = Intl.DateTimeFormat('en-GB', this.dateOptions)
                    .format(new Date(product.date_time));
                return product;
            });

            return data;
        },
    },
});
</script>

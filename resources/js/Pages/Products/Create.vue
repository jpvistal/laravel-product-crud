<template>
    <AppLayout title="Products">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a product
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <section v-show="step === 'productInfo'">
                        <ProductInfo @next-step="showStep"></ProductInfo>
                    </section>
                    <section v-show="step === 'productImage'">
                        <ProductImage @next-step="showStep"></ProductImage>
                    </section>
                    <section v-show="step === 'productDate'">
                        <ProductDate @next-step="showStep"></ProductDate>
                    </section>
                    <section v-show="step === 'submit'">
                        <div class="text-center pt-8 ont-semibold text-xl text-gray-800">
                            <p>Saving</p><i class="pi pi-spin pi-spinner" style="font-size: 2rem"></i>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { defineComponent, ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ProductInfo from "@/Components/Steps/ProductInfo.vue";
import ProductImage from "@/Components/Steps/ProductImage.vue";
import ProductDate from "@/Components/Steps/ProductDate.vue";

export default defineComponent({
    components: {
        AppLayout,
        ProductInfo,
        ProductImage,
        ProductDate
    },
    data() {
        return {
            step: 'productInfo',
            formData: {
                name: '',
                category: '',
                description: '',
                date: ''
            }

        };
    },
    methods: {
        showStep(event) {
            this.step = event.step;
            this.updateFormData(event, event.step);
        },

        updateFormData(event, step) {
            if (event.name) {
                this.formData.name = event.name;
            }

            if (event.category) {
                this.formData.category = event.category;
            }

            if (event.description) {
                this.formData.description = event.description;
            }

            if (event.date) {
                this.formData.date = event.date;
            }

            if (event.images) {
                console.log('target file', event.target.file);
            }

            if (step == 'submit') {
                this.addProduct(event);
            }
        },

        async addProduct(event) {
            try {
                const response = await axios.post("/api/product", this.formData);
                if (response.data.status === 'success' ) {
                    window.location.href = "/products";
                }
            } catch (e) {
                this.step = 'productInfo';
                console.log(e);
            }
        },
    },
});
</script>

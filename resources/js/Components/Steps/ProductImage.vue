<template>
    <h3 class="font-semibold text-xl text-gray-800 leading-tight pt-4 pb-8">
        Product Image
    </h3>
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload</label>
        <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="multiple_files" type="file" multiple @change="updateImages"
            :class="{ 'border-red-500': validation.images.error }">
        <p class="text-red-500 text-xs italic" v-show="validation.images.error">{{ validation.images.error_message }}</p>
        <div class="multi-image-preview mt-2">
            <div v-for="(image, index) in images">
                <div class="image-preview" :style="{ backgroundImage: `url(${generateImage(image)})` }">
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <div class="flex justify-between align-items-center py-4">
            <Button label="Back" class="p-button-raised" @click="back('productInfo')"></Button>
            <Button label="Next" class="p-button-raised" @click="nextPage('productDate')"></Button>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from "vue";
import Button from 'primevue/button';

export default defineComponent({
    emits: ['next-step'],
    components: {
        Button
    },
    data() {
        return {
            entity: {
                images: null
            },
            images: [],
            validation: {
                images: {
                    error: false,
                    error_message: 'Please upload at least one product image'
                },
            },
        }
    },

    methods: {
        updateImages(event) {
            this.validation.images.error = false
            this.images = Array.from(event.target.files);
        },

        generateImage(file) {
            return URL.createObjectURL(file);
        },

        nextPage(page) {
            let validationRules = [this.validateImages()];
            let validated = validationRules.every(Boolean);

            if (!validated) {
                return;
            }

            this.emitPageData(page)
        },

        back(page){
            this.emitPageData(page)
        },

        emitPageData(page){
            let pageData = {
                step: page,
                images: this.images,
            }

            this.$emit('next-step', pageData);
        },

        validateImages() {
            if (this.images.length <= 0) {
                this.validation.images.error = true;
                return false
            }
            return true;
        }
    },

});
</script>

<style>
.image-preview {
    width: 100%;
    height: 200px;
    background-size: cover;
    background-position: center center;
    position: relative;
    transition: 0.1s;
    cursor: pointer;
}

.multi-image-preview {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 5px;
}

.multi-image-preview .image-preview {
    width: 150px;
    height: 150px;
    background-size: cover;
    background-position: center center;
    position: relative;
    transition: 0.1s;
    cursor: pointer;
}
</style>


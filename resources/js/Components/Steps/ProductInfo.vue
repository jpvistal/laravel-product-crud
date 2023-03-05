<template>
    <h3 class="font-semibold text-xl text-gray-800 leading-tight pt-4 pb-8">
        Product Info
    </h3>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Name
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            :class="{ 'border-red-500': validation.name.error }" @change="validation.name.error = false" v-model="name"
            type="text" placeholder="Name">
        <p class="text-red-500 text-xs italic" v-show="validation.name.error">{{ validation.name.error_message }}</p>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Category
        </label>
        <select
            class="block appearance-none w-full border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            :class="{ 'border-red-500': validation.category.error }" @change="validation.category.error = false;"
            v-model="category">
            <option value="" disabled>Select a category</option>
            <template v-for="category in categories">
                <option :value="category.id">{{ category.name }}</option>
            </template>
        </select>
        <p class="text-red-500 text-xs italic" v-show="validation.category.error">{{ validation.category.error_message }}
        </p>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Description
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            :class="{ 'border-red-500': validation.description.error }" @change="validation.description.error = false"
            v-model="description" type="text" placeholder="Description">
        <p class="text-red-500 text-xs italic" v-show="validation.description.error">{{ validation.description.error_message
        }}</p>
    </div>
    <div class="mb-4">
        <div class="flex justify-end align-items-center py-4">
            <Button label="Next" class="p-button-raised" @click="nextPage()"></Button>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from "vue";
import Button from 'primevue/button';

export default defineComponent({
    props: {
        entity: {
            type: Object,
            default: {
                name: '',
                category: '',
                description: ''
            }
        }
    },
    emits: ['next-step'],
    components: {
        Button

    },
    data() {
        return {
            name: this.entity.name,
            category: this.entity.category_id,
            description: this.entity.description,
            categories: {},

            validation: {
                name: {
                    error: false,
                    error_message: 'Please enter a product name'
                },
                category: {
                    error: false,
                    error_message: 'Please select a category'
                },
                description: {
                    error: false,
                    error_message: 'Please add a product description'
                },
            },
        }
    },
    methods: {
        async getCategories() {
            try {
                const response = await axios.get('/api/category');
                this.categories = response.data;
            } catch (e) {
                console.log(e);
            }
        },

        nextPage() {
            let validationRules = [this.validateName(), this.validateCategory(), this.validateDescription()];
            let validated = validationRules.every(Boolean);

            if (!validated) {
                return;
            }
            let pageData = {
                step: 'productImage',
                name: this.name,
                category: this.category,
                description: this.description
            }

            this.$emit('next-step', pageData);
        },

        validateName() {
            if (this.name == "") {
                this.validation.name.error = true;
                return false
            }
            return true;
        },

        validateCategory() {
            if (this.category == "") {
                this.validation.category.error = true;
                return false
            }
            return true;
        },

        validateDescription() {
            if (this.description == "") {
                this.validation.description.error = true;
                return false
            }
            return true;
        },

    },
    mounted() {
        this.getCategories();
    },

});
</script>


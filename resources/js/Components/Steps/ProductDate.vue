<template>
    <h3 class="font-semibold text-xl text-gray-800 leading-tight pt-4 pb-8">
        Product Date
    </h3>
    <div class="mb-4">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="selectedDate">Pick a date</label>
        <Calendar inputId="time24" v-model="selectedDate" :showTime="true"/>
        <p class="text-red-500 text-xs italic" v-show="validation.selectedDate.error">{{ validation.selectedDate.error_message }}</p>
    </div>
    <div class="mb-4">
        <div class="flex justify-between align-items-center py-4">
            <Button label="Back" class="p-button-raised" @click="back('productImage')"></Button>
            <Button label="Submit" class="p-button-raised" @click="nextPage('submit')"></Button>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from "vue";

import Calendar from 'primevue/calendar';
import Button from 'primevue/button';

export default defineComponent({
    props: {
        entity: {
            type: Object,
            default: {
                date_time: '',
            }
        }
    },
    emits: ['next-step'],
    components: {
        Button,
        Calendar

    },
    data() {
        return {
            validation: {
                selectedDate: {
                    error: false,
                    error_message: 'Please pick a product date'
                },
            },
            selectedDate: this.entity.date_time,
        }

    },
    watch: {
        selectedDate(){
            this.validation.selectedDate.error = false;
        }
    },
    methods: {
        nextPage(page) {
            let validationRules = [this.validateDate()];
            let validated = validationRules.every(Boolean);

            if (!validated) {
                return;
            }

            this.emitPageData(page)
        },

        back(page) {
            this.emitPageData(page)
        },

        emitPageData(page) {
            let pageData = {
                step: page,
                date: this.selectedDate,
            }

            this.$emit('next-step', pageData);
        },

        validateDate() {
            if (this.selectedDate == '') {
                this.validation.selectedDate.error = true;
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


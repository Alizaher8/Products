<script setup>
import { defineEmits,onMounted, ref } from 'vue';

const model = defineModel({
    type: File,
    required: true,

});

const emit = defineEmits();
const selectedPhotos = [];
const input = ref();
const handleFileUpload=  async (type, event) => {
            const file = event.target.files[0];
             console.log(file);
            if (type === "photo") {
                // Handle photo upload
                const reader = new FileReader();
                const promise = new Promise((resolve, reject) => {
                    reader.onload = () => {
                        resolve(reader.result);
                    };
                    reader.onerror = reject;
                });
                reader.readAsDataURL(file);
                const result = await promise;


              const blob =   dataURItoBlob(result);
              emit('imageEvent', blob, result);

               console.log(blob);
            }
        };
const  dataURItoBlob= (dataURI)=> {
            const byteString = atob(dataURI.split(",")[1]);
            const mimeString = dataURI
                .split(",")[0]
                .split(":")[1]
                .split(";")[0];
            const ab = new ArrayBuffer(byteString.length);
            const ia = new Uint8Array(ab);
            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            const blob = new Blob([ab], { type: mimeString });
            return blob;
        };


onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }

});




defineExpose({ focus: () => input.value.focus() });

</script>

<template>
    <input
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
        v-model="model"
        ref="input"
        @change="handleFileUpload('photo',$event)"


    />

</template>

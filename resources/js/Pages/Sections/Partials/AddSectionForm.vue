<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ImageInput from '@/Components/ImageInput.vue';
import {  useForm } from '@inertiajs/vue3';



const form = useForm({
    name: '',
    description: '',
    selectedPhotos:[],
    image: '',
});
const updateImage = async (image, photos) => {

    try {

        // Use the resized image for uploading or display
        form.image = image;
        form.selectedPhotos.push(photos);
    } catch (error) {
        console.error(error);
    }
}

const removePhoto= (index) => {
            form.selectedPhotos.splice(index, 1);
        };
const addSection = () => {

    form.post(route('admin-sections.add'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),

    });
};
</script>


<template>

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add Section</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Add New Section And Give It Image
            </p>
        </header>

        <form @submit.prevent="addSection" class="mt-6 space-y-6"  enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="Section Name" />
                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    class="mt-1 block w-full"
                    autocomplete="name"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="description" value="Section Description" />
                <TextInput
                    id="description"

                    type="textarea"
                    v-model="form.description"
                    class="mt-1 block w-full h-32"

                    required

                />
                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div>
                <InputLabel for="image" value="Section Photo" />
                <ImageInput
                    id="image"
                    type="file"
                    @imageEvent="updateImage"
                    class="mt-1 block w-full "
                    required
                />
                <InputError class="mt-2" :message="form.errors.image" />
                <div class="photo-container">
                    <div v-for="(photo, index) in form.selectedPhotos" :key="index" class="photo-frame">
                        <img :src="photo" alt="Selected photo" />
                        <button @click="removePhoto(index)">Remove</button>
                    </div>
    </div>
            </div>


            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Add</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-red-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
<style scoped>
.photo-container img {
    max-width: 100%;
    max-height: 100%;
}

.photo-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.photo-frame {
    position: relative;
    width: 200px;
    height: 200px;
    overflow: hidden;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.photo-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-frame button {
    position: absolute;
    top: 5px;
    right: 5px;
    padding: 2px 8px;
    background-color: #ff4154;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 12px;
    cursor: pointer;
}

.photo-preview {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.photo-preview-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.photo-preview img {
    max-width: 90%;
    max-height: 80%;
    object-fit: contain;
}

.photo-preview button {
    margin-top: 1rem;
    padding: 0.5rem 1rem;
    background-color: #ff4154;
    color: white;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
}

</style>

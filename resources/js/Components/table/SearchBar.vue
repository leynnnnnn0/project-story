<script setup>
defineProps({
    type: {
        type: String,
        default: "text",
    },
    // v-model is passed with a name of modelValue
    modelValue: {
        type: [String, Number],
        default: "",
    },
});

const emit = defineEmits(["update:modelValue"]);
const updateValue = (event) => {
    emit("update:modelValue", event.target.value);
};
</script>
<template>
    <div class="relative w-full max-w-sm items-center">
        <Input
            :type="type"
            @input="updateValue"
            :value="modelValue"
            class="pl-10"
        />
        <span
            class="absolute start-0 inset-y-0 flex items-center justify-center px-2"
        >
            <MagnifyingGlassIcon class="size-6 text-muted-foreground" />
        </span>
    </div>
</template>

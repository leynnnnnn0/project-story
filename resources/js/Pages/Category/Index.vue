<script setup>
import { ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
let search = ref(usePage().props.search);

const isEditModalVisible = ref(false);
import { useToast } from "primevue/usetoast";
const toast = useToast();
const isLoading = ref(false);

const form = useForm({
    name: null,
    description: null,
    value: null,
});

const targetId = ref(null);

const store = () => {
    form.post(route("categories.update", targetId.value), {
        preserveScroll: true,
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: "Success",
                detail: "Category Details Updated Successfully.",
                life: 5000,
            });
            form.reset();
            isEditModalVisible.value = false;
        },
    });
};

const props = defineProps({
    categories: {
        type: Object,
        required: true,
    },
});

import { throttle } from "lodash";

watch(
    search,
    throttle(function (value) {
        router.get(
            route("categories.index"),
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    }, 500)
);

const editCategoryDetails = (id) => {
    targetId.value = id;
    isEditModalVisible.value = true;
    const data = props.categories.data.find((item) => item.id === id);
    form.name = data.SettingName;
    form.description = data.Description;
    form.value = data.Value;
};

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from "@/components/ui/dialog";
</script>

<template>
    <Layout heading="Categories">
        <TableContainer>
            <TableHeader>
                <SearchBar>
                    <Input
                        class="pl-10"
                        v-model="search"
                        placeholder="Search..."
                    />
                </SearchBar>
            </TableHeader>

            <Table>
                <TableHead>
                    <TH> Id </TH>
                    <TH> Setting Name</TH>
                    <TH> Description</TH>
                    <TH> Value </TH>
                    <TH> Actions </TH>
                </TableHead>
                <TableBody>
                    <tr v-for="category in categories.data">
                        <TD>{{ category.id }}</TD>
                        <TD>{{ category.SettingName }}</TD>
                        <TD>{{ category.Value }}</TD>
                        <TD>{{ category.Description }}</TD>
                        <TD>
                            <Button
                                @click="editCategoryDetails(category.id)"
                                class="text-blue-500"
                                variant="link"
                            >
                                <Pencil />
                            </Button>
                        </TD>
                    </tr>
                </TableBody>
            </Table>

            <div
                v-if="categories.data.length !== 0"
                class="flex items-center justify-end gap-2"
            >
                <Component
                    v-for="link in categories.links"
                    :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    v-html="link.label"
                    class="px-3 py-1 border border-gray-200 text-primary-font font-bold rounded-lg"
                    :class="{
                        'bg-primary text-white': link.active,
                        'hover:bg-primary/50 transition-colors transition-duration duration-300':
                            link.url,
                    }"
                />
            </div>
        </TableContainer>

        <Dialog v-model:open="isEditModalVisible">
            <DialogContent class="sm:max-w-[425px]">
                <DialogHeader>
                    <DialogTitle>Edit Category Details</DialogTitle>
                    <DialogDescription>
                        Input all important fields.
                    </DialogDescription>
                </DialogHeader>
                <div class="space-y-5">
                    <div class="flex flex-col space-y-1">
                        <Label class="text-xs">Category Name</Label>
                        <Input v-model="form.name" />
                        <FormError>{{ form.errors.name }}</FormError>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <Label class="text-xs">Description</Label>
                        <Input v-model="form.description" />
                        <FormError>{{ form.errors.description }}</FormError>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <Label class="text-xs">Value</Label>
                        <Input v-model="form.value" />
                        <FormError>{{ form.errors.value }}</FormError>
                    </div>
                    <div class="flex justify-end">
                        <Button @click="store" class="gap-2">
                            Save Changes
                            <span><Loading v-if="isLoading" /></span>
                        </Button>
                    </div>
                </div>
            </DialogContent>
        </Dialog>
    </Layout>
</template>

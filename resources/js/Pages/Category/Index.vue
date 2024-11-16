<script setup>
import { ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
let search = ref(usePage().props.search);

const props = defineProps({
    categories: {
        type: Object,
        required: true,
    },
});
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
                </TableHead>
                <TableBody>
                    <tr v-for="category in categories.data">
                        <TD>{{ category.id }}</TD>
                        <TD>{{ category.SettingName }}</TD>
                        <TD>{{ category.Value }}</TD>
                        <TD>{{ category.Description }}</TD>
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
    </Layout>
</template>
